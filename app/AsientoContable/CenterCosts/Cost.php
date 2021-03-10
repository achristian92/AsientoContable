<?php


namespace App\AsientoContable\CenterCosts;


use App\AsientoContable\Collaborators\Collaborator;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{

    protected $guarded = ['id'];


    public function collaborators(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Collaborator::class);
    }
}
