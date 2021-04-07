<?php


namespace App\AsientoContable\Employees\AccountingSeating\Repositories;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\Employees\AccountingSeating\Seating;
use Prettus\Repository\Eloquent\BaseRepository;

class SeatingRepo extends BaseRepository implements ISeating
{

    public function model(): string
    {
        return Seating::class;
    }

    public function listSeating(int $file, string $orderBy = 'nro_asiento', string $sortBy = 'asc')
    {
        return $this->model::with('employee')
            ->where('file_id',$file)
            ->orderBy($orderBy,$sortBy)
            ->get();
    }

    public function buildSeating(array $employee, array $account, array $costCenter, int $nro_seat,float $exchangeRate,bool $isVariousCost): void
    {

        $isExpense = $account['type'] === AccountPlan::TYPE_EXPENSE;

        if ($isVariousCost)
            $penValue  = (floatval($account['value']) * $costCenter['percentage']) / 100;
        else
            $penValue  = floatval($account['value']);

        $USDValue  = $penValue/$exchangeRate;


        Seating::updateOrCreate(
            [
                'collaborator_id' => $employee['workedID'],
                'file_id'         => $employee['fileID'],
                'customer_id'     => $employee['customerID'],
                'cuenta_contable' => $account['nroAccount'],
                'cost'            => $costCenter['code'],
            ],
            [
                'nro_asiento'     => $nro_seat,
                'sub_diario'      => 7,
                'l_registro'      => 31,
                'fecha_registro'  => $employee['createdAt'],
                'mes'             => $employee['month'],
                'debe'            => $isExpense ? $penValue : 0,
                'haber'           => !$isExpense ? $penValue : 0,
                'moneda'          => 'S',
                'tipo_cambio'     => $exchangeRate,
                'debe_usd'        => $isExpense ? number_format($USDValue,2) : 0,
                'haber_usd'       => !$isExpense ? number_format($USDValue,2) : 0,
                'glosa_asiento'   => 'PL/'.$employee['worked'].'/'.$account['concept'],
                'nro_documento'   => $employee['nroDoc'],
                'doc'             => 'PL',
                'nro_doc'         => 'PL'.(int)$employee['month'].'000'.($nro_seat),
                'fecha_doc'       => $employee['createdAt'],
                'fecha_vencimiento' => '',
                'cost2'           => '',
            ]
        );
    }

    public function listEmployeesGenerated(int $file)
    {
        return $this->model::with('employee')
                            ->where('file_id',$file)
                            ->get()
                            ->unique('collaborator_id')
                            ->transform(function ($value) {
                                return [
                                    'id'     => $value->collaborator_id,
                                    'worked' => $value->employee->full_name,
                                    'nroDoc' => $value->employee->nro_document,
                                    'file'   => $value->file_id
                                ];
                            })->sortBy('worked')->values();
    }
}
