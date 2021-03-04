<?php


namespace App\AsientoContable\Files;


use App\AsientoContable\Payrolls\Payroll;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = ['id'];

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}
