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
}
