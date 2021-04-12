<?php


namespace App\AsientoContable\CenterCosts\Repositories;


use App\AsientoContable\CenterCosts\Cost;
use Illuminate\Support\Collection;

interface ICenterCost
{
    public function findCostCenterById(int $id): Cost;

    public function findCostCenterByCode(string $code,int $customer): Cost;

    public function createCostCenter(array $data): Cost;

    public function updateCostCenter(array $data, int $id): bool;

    public function listCostsCenter($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc') : Collection;

}
