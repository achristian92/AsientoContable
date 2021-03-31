<?php


namespace App\AsientoContable\Files;


use App\AsientoContable\ConceptAccounts\ConceptAccount;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Payrolls\Payroll;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = ['id'];

    public function concepts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Concept::class);
    }

    public function accountingAccounts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ConceptAccount::class);
    }
}
