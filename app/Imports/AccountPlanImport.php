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
                AccountPlan::updateOrCreate(
                    [
                        'code' => trim($row['analitica']),
                        'customer_id' => $this->customer_id
                    ],
                    [
                        'parent_id' => substr($row['analitica'],0,3),
                        'category' => AccountPlan::TYPE_ACCOUNT,
                        'name' => $row['descripcion'],
                        'type' => $row['tipo'],
                        'is_analyzable' => $row['analisis'] === 'SI',
                        'has_center_cost' => $row['c_costos'] === 'SI',
                        'has_center_cost2' => $row['c_costos_2'] === 'SI',
                        'import' => $row['cabecera_importar'],
                        'import_slug' => Str::slug($row['cabecera_importar'],'_'),
                    ]
                );
            }
            elseif ($row['subcuenta'] !== NULL) {
                AccountPlan::updateOrCreate(
                    [
                        'code' => trim($row['subcuenta']),
                        'customer_id' => $this->customer_id

                    ],
                    [
                        'parent_id' => substr($row['subcuenta'],0,2),
                        'category' => AccountPlan::TYPE_SUBACCOUNT,
                        'name' => $row['descripcion'],
                        'type' => $row['tipo'],
                        'is_analyzable' => $row['analisis'] === 'SI',
                        'has_center_cost' => $row['c_costos'] === 'SI',
                        'has_center_cost2' => $row['c_costos_2'] === 'SI',
                    ]
                );
            }
            elseif ($row['cuenta'] !== NULL) {
                AccountPlan::updateOrCreate(
                    [
                        'code' => trim($row['cuenta']),
                        'customer_id' => $this->customer_id
                    ],
                    [
                        'parent_id' => 0,
                        'category' => AccountPlan::TYPE_ROOT,
                        'name' => $row['descripcion'],
                        'type' => $row['tipo'],
                        'is_analyzable' => $row['analisis'] === 'SI',
                        'has_center_cost' => $row['c_costos'] === 'SI',
                        'has_center_cost2' => $row['c_costos_2'] === 'SI',
                    ]
                );
            }

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
            'tipo'     => ['required',Rule::in(['GASTO', 'PASIVO'])],
            'analisis' => ['required', Rule::in(['SI', 'NO'])],
            'c_costos' => ['required', Rule::in(['SI', 'NO'])],
            'c_costos_2' => ['required', Rule::in(['SI', 'NO'])],
        ], $messages)->validate();

    }

}
