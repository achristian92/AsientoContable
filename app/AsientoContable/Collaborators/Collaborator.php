<?php


namespace App\AsientoContable\Collaborators;

use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Customers\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function concepts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Concept::class);
    }

}
