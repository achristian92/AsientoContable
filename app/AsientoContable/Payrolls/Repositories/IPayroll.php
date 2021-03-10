<?php


namespace App\AsientoContable\Payrolls\Repositories;


use Illuminate\Support\Collection;

interface IPayroll
{
    public function listPayrolls(int $file): Collection;

}
