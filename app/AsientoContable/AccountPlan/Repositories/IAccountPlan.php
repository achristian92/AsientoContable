<?php


namespace App\AsientoContable\AccountPlan\Repositories;


use App\AsientoContable\AccountPlan\AccountPlan;

interface IAccountPlan
{
    public function listPlanAccountRoot(string $order = 'code', string $sort = 'asc', array $columns = ['*']);

    public function listSubPlanAccountByRoot($code, string $order = 'name', string $sort = 'asc', array $columns = ['*']);

    public function createPlanAccount(array $params): AccountPlan;

    public function listPlanAccountNested(): array;

    public function findPlanAccountById(int $account_id): AccountPlan;

    public function updatePlanAccount(array $params, int $id);

    public function listAccountsAnalitica(array $columns = ['*'], string $order = 'code', string $sort = 'asc');

}
