<?php


namespace App\AsientoContable\Employees\AccountingSeating;


use App\AsientoContable\Collaborators\Collaborator;
use App\Voucher\Finance\Vouchers\Voucher;
use Illuminate\Database\Eloquent\Model;

class Seating extends Model
{
    protected $guarded = ['id'];

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Collaborator::class,'collaborator_id');
    }

    public static function getNextSeatNumber(int $payroll) : int
    {
        $lastVoucher = Seating::where('customer_id',customerID())
            ->where('file_id',$payroll)
            ->orderBy('nro_asiento', 'desc')
            ->first();

        if (!$lastVoucher)
            $number = 0;
        else
            $number = $lastVoucher->nro_asiento;

        return  intval($number) + 1;
    }
}
