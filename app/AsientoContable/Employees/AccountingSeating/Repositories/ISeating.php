<?php


namespace App\AsientoContable\Employees\AccountingSeating\Repositories;


interface ISeating
{
    public function listSeating(int $file);

    public function buildSeating(array $employee,array $account, array $costCenter,int $nro_seat,float $exchangeRate,bool $isVariousCost): void;

}
