<?php


namespace App\AsientoContable\Employees\MonthCosts;


use App\AsientoContable\Employees\CostEmployees\CostEmployee;
use Illuminate\Database\Eloquent\Model;

class MonthCost extends Model
{
    protected $guarded = ['id'];

    public function assigns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CostEmployee::class,'month_cost_id');
    }
}
