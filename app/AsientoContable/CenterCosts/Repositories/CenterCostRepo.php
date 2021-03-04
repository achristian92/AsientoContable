<?php


namespace App\AsientoContable\CenterCosts\Repositories;


use App\AsientoContable\CenterCosts\CenterCost;
use App\AsientoContable\CenterCosts\Repositories\ICenterCost;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class CenterCostRepo extends BaseRepository implements ICenterCost
{

    public function model()
    {
        return CenterCost::class;
    }

    public function finCostCenterById(int $id): CenterCost
    {
        return $this->model->findOrFail($id);
    }

    public function createCostCenter(array $data): CenterCost
    {
        $data['customer_id'] = customerID();
        return $this->model->create($data);    }

    public function updateCostCenter(array $data, int $id): bool
    {
        $costCenter = $this->finCostCenterById($id);
        return $costCenter->update($data);
    }

    public function listCostsCenter($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        return $this->model->whereType($this->model::TYPE_CUSTOMER)
                           ->whereCustomerId(customerID())
                           ->orderBy($orderBy,$sortBy)
                           ->get();
    }

    public function listCostsCenter2($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        return $this->model->whereType($this->model::TYPE_EMPLOYEE)
                           ->whereCustomerId(customerID())
                           ->orderBy($orderBy,$sortBy)
                           ->get();
    }
}
