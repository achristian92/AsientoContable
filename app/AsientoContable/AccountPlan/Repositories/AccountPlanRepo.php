<?php


namespace App\AsientoContable\AccountPlan\Repositories;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\Tools\NestedsetTrait;
use App\Models\History;
use Prettus\Repository\Eloquent\BaseRepository;

class AccountPlanRepo extends BaseRepository implements IAccountPlan
{
    use NestedsetTrait;

    public function model(): string
    {
        return AccountPlan::class;
    }
    public function findPlanAccountById(int $account_id): AccountPlan
    {
        return $this->model->findOrFail($account_id);
    }

    public function listPlanAccountRoot(string $order = 'code', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->model->whereCustomerId(customerID())
                           ->whereCategory($this->model::TYPE_ROOT)
                           ->orderBy($order,$sort)
                           ->get();
    }

    public function listSubPlanAccountByRoot($code, string $order = 'name', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->model->whereCustomerId(customerID())
                            ->whereParentId($code)
                            ->orderBy($order,$sort)
                            ->get();
    }

    public function createPlanAccount(array $params): AccountPlan
    {
        $params['parent_id'] = self::searchParent($params);
        $params['customer_id'] = customerID();
        $account = $this->model->create($params);
        history(History::CREATED_TYPE,"Creó plan de cuenta $account->code $account->name");

        return $account;
    }

    public function listPlanAccountNested(): array
    {
        $data = $this->model::with('childrenRecursive')->whereCustomerId(customerID())->get()
                ->map(function ($account){
                    return [
                        'id'        => $account['id'],
                        'code'      => $account['code'],
                        'name'      => $account['name'],
                        'type'      => $account['type'],
                        'parent_id' => $account['parent_id'],
                        'children'  => []
                    ];
                })->sortBy('code');

        return $this->buildNestedset($data->toArray());

    }

    public function updatePlanAccount(array $params, int $id)
    {
        $params['parent_id'] = self::searchParent($params);
        $account = $this->findPlanAccountById($id);
        history(History::CREATED_TYPE,"Creó plan de cuenta $account->code $account->name");
        return $account->update($params);
    }

    private function searchParent(array $data)
    {
        $parent = '';
        if ($data['category'] === $this->model::TYPE_ROOT)
            $parent = 0;
        elseif ($data['category'] === $this->model::TYPE_SUBACCOUNT)
            $parent = $data['selectedAccount'];
        else
            $parent = $data['selectedSubAccount'];

        return $parent;
    }

    public function listAccountsAnalitica(array $columns = ['*'], string $order = 'code', string $sort = 'asc')
    {
        return $this->model::where(['customer_id' => customerID(),'category' => $this->model::TYPE_ACCOUNT])
                    ->orderBy($order,$sort)
                    ->get($columns);
    }
}
