<?php


namespace App\AsientoContable\Employees\CostEmployees\Repositories;


use App\AsientoContable\Employees\CostEmployees\CostEmployee;
use Illuminate\Support\Collection;

interface ICostEmployee
{
    public function findCostEmployeeById(int $customer_id): CostEmployee;

    public function createCostEmployee(array $data): CostEmployee;

    public function updateCostEmployee(array $data, int $id): bool;

    public function listCostEmployees(int $employee_id, int $file_id) : Collection;


}
