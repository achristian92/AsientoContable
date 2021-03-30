<?php

namespace App\Imports;

use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\Customers\Customer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Str;

class AccountPlanImport implements ToCollection,WithHeadingRow
{

    private $customer_id;

    public function __construct(int $customer_id)
    {
        $this->customer_id = $customer_id;
    }

    public function headingRow(): int
    {
        return 7;
    }

    public function collection(Collection $collection)
    {
        $collection->each(function ($row,$key) {
            $this->validationRow($row, $key);
            if ($row['analitica'] !== NULL) {
                $code = trim($row['analitica']);
                $parent = substr($row['analitica'],0,3);
                $type = AccountPlan::TYPE_ACCOUNT;
            } elseif ($row['subcuenta'] !== NULL) {
                $code = trim($row['subcuenta']);
                $parent = substr($row['subcuenta'],0,2);
                $type = AccountPlan::TYPE_SUBACCOUNT;
            } elseif ($row['cuenta'] !== NULL) {
                $code = trim($row['cuenta']);
                $parent = 0;
                $type = AccountPlan::TYPE_ROOT;
            }

                AccountPlan::updateOrCreate(
                    [
                        'code' => $code,
                        'customer_id' => $this->customer_id
                    ],
                    [
                        'parent_id' => $parent,
                        'category' => $type,
                        'name' => $row['descripcion'],
                        'type' => strtoupper($row['tipo']),
                        'is_analyzable' => $row['analisis'] === 'SI',
                        'has_center_cost' => $row['c_costos'] === 'SI',
                        'has_center_cost2' => $row['c_costos_2'] === 'SI',
                    ]
                );
        });
    }

    private function validationRow($row, int $key)
    {
        $currentRow = $key + 8;

        $messages = [
            'required'    => "El campo :attribute es requerido en la fila $currentRow.",
            'in'    => "El campo :attribute debe ser 'SI' o 'NO' en la fila $currentRow.",
        ];

        Validator::make($row->toArray(), [
            'descripcion' => 'required',
            'tipo'     => ['required',Rule::in([AccountPlan::TYPE_EXPENSE, AccountPlan::TYPE_PASIVE,AccountPlan::TYPE_ACTIVE])],
            'analisis' => ['required', Rule::in(['SI', 'NO'])],
            'c_costos' => ['required', Rule::in(['SI', 'NO'])],
            'c_costos_2' => ['required', Rule::in(['SI', 'NO'])],
        ], $messages)->validate();

    }

}
