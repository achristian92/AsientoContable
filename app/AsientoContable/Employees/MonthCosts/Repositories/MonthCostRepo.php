<?php


namespace App\AsientoContable\Employees\MonthCosts\Repositories;

use App\AsientoContable\Employees\CostEmployees\Transformations\CostEmployeeTrait;
use App\AsientoContable\Employees\MonthCosts\MonthCost;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class MonthCostRepo extends BaseRepository implements IMonthCost
{
    use CostEmployeeTrait;

    public function model(): string
    {
        return MonthCost::class;
    }

    public function findMonthCostById(int $id): MonthCost
    {
        return $this->model::with('assigns')->findOrFail($id);
    }

    public function createMonthCost(array $data): MonthCost
    {
        $date = Carbon::parse($data['month']);

        return $this->model::create([
            'month'       => $date->format('Y-m'),
            'name'        => ucfirst($date->monthName).'-'.$date->year,
            'customer_id' => customerID()
        ]);
    }

    public function updateMonthCost(array $data, int $id): bool
    {
        $month = $this->findMonthCostById($id);
        return $month->update($data);
    }

    public function listMonthCosts($columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc'): Collection
    {
        return $this->model::whereCustomerId(customerID())
                ->orderBy($orderBy,$sortBy)
                ->get($columns);
    }

    public function listAssigns(int $month_id)
    {
        $month = $this->findMonthCostById($month_id);

        return $month->assigns->transform(function ($item) {
            return $this->transformCostEmployee($item);
        })->groupBy('worked')
            ->transform(function ($collection) {
                return $this->transformAgroupCostEmployee($collection);
            })->values();
    }
}
