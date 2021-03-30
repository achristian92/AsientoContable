<?php


namespace App\AsientoContable\Employees\MonthCosts\Repositories;


use App\AsientoContable\Employees\MonthCosts\MonthCost;
use Illuminate\Support\Collection;

interface IMonthCost
{
    public function findMonthCostById(int $id): MonthCost;

    public function createMonthCost(array $data): MonthCost;

    public function updateMonthCost(array $data, int $id): bool;

    public function listMonthCosts($columns = array('*'), string $orderBy = 'id', string $sortBy = 'desc') : Collection;

    public function listAssigns(int $month_id);

}
