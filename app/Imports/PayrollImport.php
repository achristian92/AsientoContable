<?php

namespace App\Imports;

use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\ConceptAccounts\ConceptAccount;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Headers\Header;
use App\AsientoContable\PensionFund\PensionFund;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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

            /*$this->validationRow($row, $key);*/
            $employee = Collaborator::updateOrCreate(
                [
                    'nro_document' => $row[slug(Concept::NRO_DOC)],
                    'customer_id'  => $this->customer
                ],
                [
                    'full_name'       => $row[slug(Concept::FULL_NAME)],
                    'code'            => $row[slug(Concept::CODE)],
                    'date_start_work' => $this->transformDateTime($row[slug(Concept::DATE_ENTRY)]),
                ]
            );

            if(!$this->hasPensionOnp($row))
                $this->ConceptAccount(Concept::AFP_CONTRIBUTION, $this->pensionAccount($row), $this->totalAFP($row), $employee);

            $row->each(function ($item,$row) use ($employee) {
                $header = Header::where('slug',$row)
                                ->where('customer_id',$this->customer)
                                ->first();
                if($header) {
                    if ($header->account_plan_id) {
                        $this->ConceptAccount($header->name,$header->account,$item,$employee);
                    }

                    Concept::updateOrCreate(
                        [
                            'header'          => $header->name,
                            'payroll_date'    => $this->month,
                            'collaborator_id' => $employee->id,
                            'customer_id'     => $this->customer,
                            'file_id'         => $this->file
                        ],
                        [
                            'value' => trim($item),
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
            'cod_trabajador'      => 'required',
            'centro_costo'        => [
                'nullable',
                Rule::in(Cost::whereCustomerId($this->customer)->get()->pluck('code')->toArray())
            ],
            'apellidos_y_nombres' => 'required',
            'doc_identidad'       => 'required',
            'fec_ingreso'         => 'required|date',
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

    private function pensionAccount($row)
    {
        $pension = PensionFund::where('customer_id',$this->customer)
                            ->where('short',($row[slug(Concept::PENSION_SHORT)]))
                            ->first();
        return $pension->account;

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
    private function costSearch($code = NULL): array
    {
        if ($code === '' || $code === NULL)
            return [];

        return [Cost::whereCustomerId($this->customer)->whereCode($code)->first()->id];
    }

    private function transformDateTime(string $value, string $format = 'd/m/Y')
    {
        if (!$value)
            return '';

        try {
            return Carbon::instance(Date::excelToDateTimeObject($value))->format($format);
        } catch (\ErrorException $e) {
            return Carbon::createFromFormat($format, $value);
        }
    }

    private function totalAFP(Collection $row): float
    {
        $contribution = floatval($row[slug(Concept::AFP_CONTRIBUTION)]);
        $sure = floatval($row[slug(Concept::AFP_SURE_PRIME)]);
        $commission = floatval($row[slug(Concept::AFP_COMISSION)]);
        return $contribution + $sure + $commission;
    }

    private function ConceptAccount(string $header,$account,$value,Collaborator $employee)
    {
        ConceptAccount::updateOrCreate(
            [
                'header'          => $header,
                'payroll_date'    => $this->month,
                'collaborator_id' => $employee->id,
                'customer_id'     => $this->customer,
                'file_id'         => $this->file
            ],
            [
                'account' => json_encode($account),
                'value'   => trim($value)
            ]
        );
    }
}
