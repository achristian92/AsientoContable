<?php


namespace App\AsientoContable\ConceptAccounts;


use App\AsientoContable\Collaborators\Collaborator;
use Illuminate\Database\Eloquent\Model;

class ConceptAccount extends Model
{
    protected $table = 'concept_accounts';

    protected $guarded = ['id'];

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Collaborator::class,'collaborator_id');
    }
}
