<?php


namespace App\AsientoContable\Headers;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\Customers\Presenters\CustomerPresenter;
use App\AsientoContable\Employees\AccountingSeating\Seating;
use App\AsientoContable\Headers\Presenters\HeaderPresenter;
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

    public function hasAssignedAccount(): bool
    {
        return !empty($this->account_plan_id);
    }

    public function nroAccount()
    {
        if (!$this->hasAssignedAccount())
            return '';

        return $this->account->code;
    }

    public function bgColorByAccountType(): string
    {
        if (!$this->hasAssignedAccount())
            return '#EBF1DE';

        return $this->account->type === AccountPlan::TYPE_EXPENSE ? '#C5D9F1' : '#F2DCDB';
    }

    public function present(): HeaderPresenter
    {
        return new HeaderPresenter($this);
    }

    public static function getNextOrderNumber() : int
    {
        $lastOrder = Header::where('customer_id',customerID())
            ->orderBy('order', 'desc')
            ->first();

        if (!$lastOrder)
            $number = 0;
        else
            $number = $lastOrder->order;

        return  intval($number) + 10;
    }
}
