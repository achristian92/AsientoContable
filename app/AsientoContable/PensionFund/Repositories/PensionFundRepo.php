<?php


namespace App\AsientoContable\PensionFund\Repositories;


use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\PensionFund\PensionFund;
use App\Models\History;
use Prettus\Repository\Eloquent\BaseRepository;

class PensionFundRepo extends BaseRepository implements IPensionFund
{

    public function model(): string
    {
        return PensionFund::class;
    }

    public function listPensionsFund()
    {
        return $this->model::with('account')
                        ->where('customer_id',customerID())
                        ->orderBy('short')
                        ->get();
    }

    public function findPensionById(int $id): PensionFund
    {
        return $this->model->findOrFail($id);
    }

    public function findPensionByShort(string $short,int $customer): PensionFund
    {
        return $this->model::where('customer_id',$customer)
                    ->where('short',$short)
                    ->first();
    }

    public function createPensionFund(array $params)
    {
        $params['customer_id'] = customerID();
        $pension = $this->model::create($params);
        history(History::CREATED_TYPE,"Creó fondo de pension $pension->name");
        return $pension;
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
