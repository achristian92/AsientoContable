<?php


namespace App\AsientoContable\Collaborators;

use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\Customers\Customer;
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

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

}
