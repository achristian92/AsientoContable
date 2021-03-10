<?php


namespace App\AsientoContable\CostsCenter2\Repositories;


use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\CostsCenter2\CostCenter2;
use Illuminate\Support\Collection;

interface ICenterCost2
{
    public function findCostCenter2ById(int $id): CostCenter2;

    public function createCostCenter2(array $data): CostCenter2;

    public function updateCostCenter2(array $data, int $id): bool;

    public function listCostsCenter2($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc') : Collection;


}
