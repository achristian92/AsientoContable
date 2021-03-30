<?php


namespace App\AsientoContable\PensionFund;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\PensionFund\Presenters\PensionFundPresenter;
use Illuminate\Database\Eloquent\Model;

class PensionFund extends Model
{
    protected $table = 'pension_fund';

    protected $guarded = ['id'];

    public function account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AccountPlan::class,'account_plan_id');
    }

    public function present(): PensionFundPresenter
    {
        return new PensionFundPresenter($this);
    }
}
