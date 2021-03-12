<?php


namespace App\AsientoContable\Payrolls\Repositories;


use App\AsientoContable\Payrolls\Payroll;
use App\AsientoContable\Payrolls\Transformations\PayrollTransformable;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class PayrollRepo extends BaseRepository implements IPayroll
{
    use PayrollTransformable;

    public function model()
    {
        return Payroll::class;
    }


}
