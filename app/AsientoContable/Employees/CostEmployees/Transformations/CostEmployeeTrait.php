<?php


namespace App\AsientoContable\Employees\CostEmployees\Transformations;


use App\AsientoContable\Employees\CostEmployees\CostEmployee;
use Illuminate\Support\Collection;

trait CostEmployeeTrait
{
    public function transformCostEmployee(CostEmployee $costEmployee): CostEmployee
    {
        $model             = new CostEmployee();
        $model->id         = $costEmployee->id;
        $model->employeeID = $costEmployee->collaborator_id;
        $model->worked     = $costEmployee->employee->full_name;
        $model->code       = $costEmployee->cost->code;
        $model->cost       = $costEmployee->cost->name;
        $model->percentage = round($costEmployee->percentage,2);
        return $model;
    }

    public function transformAgroupCostEmployee(Collection $costEmployees): CostEmployee
    {
        $model             = new CostEmployee();
        $model->employeeID = $costEmployees->first()->employeeID;
        $model->worked     = $costEmployees->first()->worked;
        $model->qtyCosts   = $costEmployees->count();
        $model->total      = $costEmployees->sum('percentage');
        $model->totalFormat = number_format($costEmployees->sum('percentage'),2).'%';
        return $model;
    }

}
