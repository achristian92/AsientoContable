<?php


namespace App\AsientoContable\Files;


use App\AsientoContable\ConceptAccounts\ConceptAccount;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Employees\AccountingSeating\Seating;
use App\AsientoContable\Employees\CostEmployees\CostEmployee;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = ['id'];

    CONST STATUS_OPEN = 'Abierto';
    CONST STATUS_CLOSE = 'Cerrado';

    public function concepts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Concept::class);
    }

    public function assignments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CostEmployee::class);
    }

    public function seating(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Seating::class);
    }

    public function accountingAccounts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ConceptAccount::class);
    }
}
