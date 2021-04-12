<?php


namespace App\AsientoContable\Employees\AccountingSeating\Repositories;


interface ISeating
{
    public function listSeating(int $file, string $orderBy = 'nro_asiento', string $sortBy = 'asc');

    public function buildSeating(array $employee,array $account, array $costCenter,int $nro_seat,float $exchangeRate,bool $isVariousCost): void;

    public function listEmployeesGenerated(int $file);
}
