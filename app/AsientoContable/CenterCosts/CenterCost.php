<?php


namespace App\AsientoContable\CenterCosts;


use Illuminate\Database\Eloquent\Model;

class CenterCost extends Model
{
    protected $table = 'center_cost';

    protected $guarded = ['id'];

    const TYPE_CUSTOMER = 'customer';
    const TYPE_EMPLOYEE = 'employee';

}
