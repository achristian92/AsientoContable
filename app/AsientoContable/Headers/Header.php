<?php


namespace App\AsientoContable\Headers;


use App\AsientoContable\AccountPlan\AccountPlan;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    CONST TYPE_INCOME = 'Ingreso';
    CONST TYPE_EXPENSE = 'Descuento';
    CONST TYPE_CONTRIBUTION = 'Aportación';

    CONST HEADER_TYPES = [
        self::TYPE_INCOME => self::TYPE_INCOME,
        self::TYPE_EXPENSE => self::TYPE_EXPENSE,
        self::TYPE_CONTRIBUTION => self::TYPE_CONTRIBUTION,
    ];

    public function account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AccountPlan::class,'account_plan_id');
    }
}
