<?php


namespace App\AsientoContable\Employees\CostEmployees\Repositories;


use App\AsientoContable\Employees\CostEmployees\CostEmployee;
use App\AsientoContable\Employees\CostEmployees\Transformations\CostEmployeeTrait;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class CostEmployeeRepo extends BaseRepository implements ICostEmployee
{
    use CostEmployeeTrait;

    public function model(): string
    {
        return CostEmployee::class;
    }

    public function findCostEmployeeById(int $customer_id): CostEmployee
    {
        // TODO: Implement findCostEmployeeById() method.
    }

    public function createCostEmployee(array $data): CostEmployee
    {
        return $this->model::create($data);
    }

    public function updateCostEmployee(array $data, int $id): bool
    {
        // TODO: Implement updateCostEmployee() method.
    }


    public function listCostEmployees(int $employee_id, int $month): Collection
    {
        return $this->model::with('employee','cost')
                    ->where(['collaborator_id' => $employee_id,'month_cost_id' => $month])
                    ->get()
                    ->transform(function ($item) {
                return $this->transformCostEmployee($item);
            });
    }
}
