<?php


namespace App\AsientoContable\CostsCenter2\Repositories;


use App\AsientoContable\CostsCenter2\CostCenter2;
use App\Models\History;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class CenterCost2Repo extends BaseRepository implements ICenterCost2
{

    public function model()
    {
        return CostCenter2::class;
    }

    public function findCostCenter2ById(int $id): CostCenter2
    {
        return $this->model->findOrFail($id);
    }

    public function createCostCenter2(array $data): CostCenter2
    {
        $data['customer_id'] = customerID();
        $cost2 = $this->model->create($data);
        history(History::CREATED_TYPE,"Creó centro de costo2 $cost2->name");
        return $cost2;
    }

    public function updateCostCenter2(array $data, int $id): bool
    {
        $costCenter = $this->findCostCenter2ById($id);
        return $costCenter->update($data);
    }

    public function listCostsCenter2($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        return $this->model::whereCustomerId(customerID())
                    ->orderBy($orderBy,$sortBy)
                    ->get();
    }
}
