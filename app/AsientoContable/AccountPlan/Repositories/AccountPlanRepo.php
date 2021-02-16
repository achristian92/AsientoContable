<?php


namespace App\AsientoContable\AccountPlan\Repositories;


use App\AsientoContable\AccountPlan\AccountPlan;
use Prettus\Repository\Eloquent\BaseRepository;

class AccountPlanRepo extends BaseRepository implements IAccountPlan
{

    public function model()
    {
        return AccountPlan::class;
    }
}
