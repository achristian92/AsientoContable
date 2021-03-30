<?php


namespace App\AsientoContable\Headers;


use App\AsientoContable\AccountPlan\AccountPlan;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public function account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AccountPlan::class,'account_plan_id');
    }
}
