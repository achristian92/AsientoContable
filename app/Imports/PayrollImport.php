<?php

namespace App\Imports;

use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Customers\Customer;
use App\AsientoContable\PensionFund\PensionFund;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PayrollImport implements ToCollection,WithHeadingRow
{
    private $customer, $month, $file;

    public function __construct(int $customer, Carbon $month, int $file)
    {
        $this->customer = $customer;
        $this->month = $month;
        $this->file = $file;
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $collection)
    {
        $collection->each(function ($row,$key) {
            $row['fec_ing'] = $this->transformDateTime($row['fec_ing'],'d/m/Y');

            $this->validationRow($row, $key);

            $employee = Collaborator::updateOrCreate(
                [
                    'nro_document'  => $row['doc_identidad'],
                    'customer_id' => $this->customer
                ],
                [
                    'full_name' => $row['apellidos_y_nombres'],
                    'code' => $row['cod_trab'],
                    'date_start_work' => $row['fec_ing'],
                ]
            );


            $payroll = $employee->payrolls()->updateOrCreate(
                [
                    'payroll_date'    => $this->month,
                    'collaborator_id' => $employee->id,
                    'customer_id'     => $this->customer
                ],
                [
                    'work_area_id'        => $row['cod_area'],
                    'work_area'           => $row['area_trab'],
                    'position_id'         => $row['cod_cargo'],
                    'position'            => $row['cargo'],
                    'date_entry'          => $row['fec_ing'],
                    'date_termination'    => $row['fecha_cese'],
                    'pension_short'       => $row['fondo_de_pensiones'],
                    'pension'             => $this->name_pension($row),
                    'currency'            => $row['moneda'],
                    'nro_days_worked'     => $row['dias_trabajados'],
                    'nro_hours_worked'    => $row['horas_trabajadas'],
                    'overtime_hours'      => $row['thorasexthors'],
                    'overtime_minutes'    => $row['thorasextmins'],
                    'pdt_days'            => $row['dias_pdt'],
                    'family_allowance'    => $row['asignacion_familiar'],
                    'base_salary'         => $row['remuneracion_basica'],
                    'total_income'        => $row['total_ingresos'],
                    'pension_discount'    => $this->pension_discount($row),
                    'insurance_discount'  => $row['afp_prima_de_seguro'],
                    'commission_discount' => $row['afp_comision_sobre_la_ra'],
                    'fifth_category'      => $row['renta_de_5ta_categoria'],
                    'with_eps'            => $row['eps_empleado'],
                    'total_expense'       => $row['total_egresos'],
                    'esshealth'           => $row['essalud'],
                    'total_contribution'  => $row['total_aport'],
                    'net_pay'             => $row['neto'],
                    'file_id'             => $this->file,
                ]
            );

            $costCode = $this->costSearch($row['centro_costo']);
            if (!empty($costCode)) {
                $syncData = array_map(function ($params) {
                    return [ 'month_payroll' => $this->month ];
                }, array_flip($costCode));

                $payroll->costs()->sync($syncData);
            } else
                $payroll->costs()->detach([]);

        });
    }

    private function validationRow($row, $key)
    {
        $currentRow = $key + 2;

        $messages = [
            'required' => "El campo :attribute es requerido en la fila $currentRow.",
            'unique'   => "El campo :attribute  ya está en uso en la fila $currentRow.",
            'in'       => "El campo :attribute  es inválido en la fila $currentRow.",
            'integer'  => "El campo :attribute  debe ser un número entero en la fila $currentRow.",
        ];

        Validator::make($row->toArray(), [
            'cod_trab'            => 'required',
            'centro_costo'        => [
                'nullable',
                Rule::in(Cost::whereCustomerId($this->customer)->get()->pluck('code')->toArray())
            ],
            'apellidos_y_nombres' => 'required',
            'doc_identidad'       => 'required',
            'fec_ing'             => 'required|date',
            'fondo_de_pensiones'  => [
                'required',
                Rule::in(PensionFund::all()->pluck('short')),
            ],
            'remuneracion_basica' => 'required|integer',
            'dias_trabajados'     => 'required|integer',
            'total_egresos'       => 'required|numeric',
            'essalud'             => 'required|numeric',
            'total_aport'         => 'required|numeric',
            'neto'                => 'required|numeric',
        ], $messages)->validate();
    }

    private function name_pension($row): string
    {
        return PensionFund::where('short',$row['fondo_de_pensiones'])->first()->name;
    }
    private function pension_discount($row): float
    {
        if ($this->hasPensionOnp($row))
            return $row['onp'];
        return $row['afp_aportacion_obligat'];
    }

    private function hasPensionOnp($row): bool
    {
        if (strtolower($row['fondo_de_pensiones']) === 'on')
            return true;
        return false;
    }

    private function transformDateTime(string $value, string $format = 'Y-m-d')
    {
        try {
            return Carbon::instance(Date::excelToDateTimeObject($value))->format($format);
        } catch (\ErrorException $e) {
            return Carbon::createFromFormat($format, $value);
        }
    }

    private function costSearch($code = NULL): array
    {
        if ($code === '' || $code === NULL)
            return [];

        return [Cost::whereCustomerId($this->customer)->whereCode($code)->first()->id];
    }

}
