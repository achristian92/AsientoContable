<?php


namespace App\AsientoContable\Collaborators;

use App\AsientoContable\Payrolls\Payroll;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}
