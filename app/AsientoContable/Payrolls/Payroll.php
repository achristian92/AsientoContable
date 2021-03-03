<?php


namespace App\AsientoContable\Payrolls;


use App\AsientoContable\Collaborators\Collaborator;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $guarded = ['id'];

    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class);
    }
}
