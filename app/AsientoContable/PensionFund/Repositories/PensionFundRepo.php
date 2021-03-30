<?php


namespace App\AsientoContable\PensionFund\Repositories;


use App\AsientoContable\PensionFund\PensionFund;
use Prettus\Repository\Eloquent\BaseRepository;

class PensionFundRepo extends BaseRepository implements IPensionFund
{

    public function model()
    {
        return PensionFund::class;
    }

    public function listPensionsFund()
    {
        return $this->model::with('account')->orderBy('short')->get();
    }

    public function findPensionById(int $id): PensionFund
    {
        return $this->model->findOrFail($id);
    }

    public function createPensionFund(array $params)
    {
        $params['customer_id'] = customerID();
        return $this->model::create($params);
    }

    public function updatePensionFund(array $params, int $id): bool
    {
        unset($params['short']);
        unset($params['name']);
        $pension = $this->findPensionById($id);
        return $pension->update($params);
    }

    public function isAssignedAccountWithPensions(): bool
    {
        $collection = $this->model::where('customer_id',customerID())->get();

        $filtered = $collection->whereNull('account_plan_id')->count();
        return $filtered === 0;
    }
}
