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

    public static function getNextSeatNumber(int $payroll, int $employee, int $customerId) : int
    {
        $employeeSeating = Seating::where('customer_id',$customerId)
            ->where('file_id',$payroll)
            ->where('collaborator_id',$employee)
            ->orderBy('nro_asiento', 'desc')
            ->first();

        if ($employeeSeating)
            return $employeeSeating->nro_asiento;

        $lastNroSeating = Seating::where('customer_id',$customerId)
            ->where('file_id',$payroll)
            ->orderBy('nro_asiento', 'desc')
            ->first();

        if (!$lastNroSeating)
            $number = 0;
        else
            $number = $lastNroSeating->nro_asiento;

        return  intval($number) + 1;
    }
}
