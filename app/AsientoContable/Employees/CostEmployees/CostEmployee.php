<?php


namespace App\AsientoContable\Employees\CostEmployees;


use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\Collaborators\Collaborator;
use Illuminate\Database\Eloquent\Model;

class CostEmployee extends Model
{
    protected $table = 'cost_employee';

    protected $guarded = ['id'];

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Collaborator::class,'collaborator_id');
    }

    public function cost(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cost::class,'cost_id');
    }
}
