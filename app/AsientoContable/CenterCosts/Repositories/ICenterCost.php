<?php


namespace App\AsientoContable\CenterCosts\Repositories;


use App\AsientoContable\CenterCosts\CenterCost;
use Illuminate\Support\Collection;

interface ICenterCost
{
    public function finCostCenterById(int $id): CenterCost;

    public function createCostCenter(array $data): CenterCost;

    public function updateCostCenter(array $data, int $id): bool;

    public function listCostsCenter($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc') : Collection;

    public function listCostsCenter2($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc') : Collection;


}
