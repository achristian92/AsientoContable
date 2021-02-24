<?php

namespace App\Imports;

use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\Customers\Customer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AccountPlanImport implements ToCollection,WithHeadingRow
{

    private $customer_id;

    public function __construct(int $customer_id)
    {
        $this->customer_id = $customer_id;
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $collection)
    {
        $collection->each(function ($row,$key) {
            $this->validationRow($row, $key);
            if ($row['cuenta_analitica'] !== NULL) {
                AccountPlan::updateOrCreate(
                    [
                        'code' => $row['cuenta_analitica'],
                        'customer_id' => $this->customer_id
                    ],
                    [
                        'parent_id' => substr($row['cuenta_analitica'],0,3),
                        'category' => AccountPlan::TYPE_ACCOUNT,
                        'name' => $row['descripcion'],
                        'type' => $row['bal'],
                        'is_analyzable' => $row['analisis'] === 'SI',
                        'has_center_cost' => $row['centro_de_costos'] === 'SI',
                        'has_center_cost2' => $row['centro_de_costos_2'] === 'SI',
                    ]
                );
            }
            elseif ($row['sub_cuenta'] !== NULL) {
                AccountPlan::updateOrCreate(
                    [
                        'code' => $row['sub_cuenta'],
                        'customer_id' => $this->customer_id

                    ],
                    [
                        'parent_id' => substr($row['sub_cuenta'],0,2),
                        'category' => AccountPlan::TYPE_SUBACCOUNT,
                        'name' => $row['descripcion'],
                        'type' => $row['bal'],
                        'is_analyzable' => $row['analisis'] === 'SI',
                        'has_center_cost' => $row['centro_de_costos'] === 'SI',
                        'has_center_cost2' => $row['centro_de_costos_2'] === 'SI',
                    ]
                );
            }
            elseif ($row['cuenta'] !== NULL) {
                AccountPlan::updateOrCreate(
                    [
                        'code' => $row['cuenta'],
                        'customer_id' => $this->customer_id
                    ],
                    [
                        'parent_id' => 0,
                        'category' => AccountPlan::TYPE_ROOT,
                        'name' => $row['descripcion'],
                        'type' => $row['bal'],
                        'is_analyzable' => $row['analisis'] === 'SI',
                        'has_center_cost' => $row['centro_de_costos'] === 'SI',
                        'has_center_cost2' => $row['centro_de_costos_2'] === 'SI',
                    ]
                );
            }

        });
    }

    private function validationRow($row, int $key)
    {
        $currentRow = $key + 2;

        $messages = [
            'required'    => "El campo :attribute es requerido en la fila $currentRow.",
            'in'    => "El campo :attribute debe ser 'SI' o 'NO' en la fila $currentRow.",
        ];

        Validator::make($row->toArray(), [
            'descripcion' => 'required',
            'bal'     => ['required',Rule::in(['GASTO', 'PASIVO'])],
            'analisis' => ['required', Rule::in(['SI', 'NO'])],
            'centro_de_costos' => ['required', Rule::in(['SI', 'NO'])],
            'centro_de_costos_2' => ['required', Rule::in(['SI', 'NO'])],
        ], $messages)->validate();

    }

}
