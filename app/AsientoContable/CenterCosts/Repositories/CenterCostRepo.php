<?php


namespace App\AsientoContable\CenterCosts\Repositories;


use App\AsientoContable\CenterCosts\Cost;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class CenterCostRepo extends BaseRepository implements ICenterCost
{

    public function model(): string
    {
        return Cost::class;
    }

    public function findCostCenterById(int $id): Cost
    {
        return $this->model->findOrFail($id);
    }

    public function findCostCenterByCode(string $code,int $customer): Cost
    {
        return $this->model::where('customer_id',$customer)
                    ->where('code',$code)
                    ->first();
    }

    public function createCostCenter(array $data): Cost
    {
        $data['customer_id'] = customerID();
        return $this->model->create($data);
    }

    public function updateCostCenter(array $data, int $id): bool
    {
        $costCenter = $this->finCostCenterById($id);
        return $costCenter->update($data);
    }

    public function listCostsCenter($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        return $this->model::whereCustomerId(customerID())
                   ->orderBy($orderBy,$sortBy)
                   ->get($columns);
    }



}
