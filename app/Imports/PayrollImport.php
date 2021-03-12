<?php

namespace App\Imports;

use App\AsientoContable\AccountsHeaders\AccountHeader;
use App\AsientoContable\BaseHeaders\BaseHeader;
use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Customers\Customer;
use App\AsientoContable\PensionFund\PensionFund;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Psy\Util\Str;

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

            /*$this->validationRow($row, $key);*/

            $employee = Collaborator::updateOrCreate(
                [
                    'nro_document'  => $row['nro_identidad'],
                    'customer_id' => $this->customer
                ],
                [
                    'full_name' => $row['trabajador'],
                    'code' => $row['codigo'],
                    'date_start_work' => $row['fecha_ingreso'] ?? '',
                ]
            );

            $row->each(function ($item,$row) use ($employee) {
                $headerName = AccountHeader::where('name_slug',$row)
                                ->where('customer_id',$this->customer)
                                ->first();
                if ($headerName) {
                    Concept::updateOrCreate(
                        [
                            'payroll_date' => $this->month,
                            'collaborator_id' => $employee->id,
                            'header_slug' => $row,
                            'customer_id' => $this->customer
                        ],
                        [
                            'header' => $headerName->name,
                            'value' => $item,
                            'file_id' => $this->file
                        ]
                    );
                }
            });

            /*
            $costCode = $this->costSearch($row['centro_costo']);
            if (!empty($costCode)) {
                $syncData = array_map(function ($params) {
                    return [ 'month_payroll' => $this->month ];
                }, array_flip($costCode));

                $payroll->costs()->sync($syncData);
            } else
                $payroll->costs()->detach([]);*/

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
