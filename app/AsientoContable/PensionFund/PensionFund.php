<?php


namespace App\AsientoContable\PensionFund;


use App\AsientoContable\PensionFund\Presenters\PensionFundPresenter;
use Illuminate\Database\Eloquent\Model;

class PensionFund extends Model
{
    protected $table = 'pension_fund';

    protected $guarded = ['id'];

    public function present(): PensionFundPresenter
    {
        return new PensionFundPresenter($this);
    }
}
