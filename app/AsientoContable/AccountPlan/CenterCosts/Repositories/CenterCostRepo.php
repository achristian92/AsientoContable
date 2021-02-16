<?php


namespace App\AsientoContable\AccountPlan\CenterCosts\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;

class CenterCostRepo extends BaseRepository implements ICenterCost
{

    public function model()
    {
        return CenterCostRepo::class;
    }
}
