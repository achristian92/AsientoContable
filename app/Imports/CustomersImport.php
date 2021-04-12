<?php

namespace App\Imports;

use App\AsientoContable\Base\BaseHeader;
use App\AsientoContable\Base\BasePension;
use App\AsientoContable\Customers\Customer;
use App\AsientoContable\Headers\Header;
use App\AsientoContable\PensionFund\PensionFund;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToCollection,WithHeadingRow
{
    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $collection)
    {
        $collection->each(function ($row,$key) {

                $this->validationRow($row, $key);

                 $customer = Customer::updateOrCreate(
                    [
                        'ruc'  => $row['ruc'],
                    ],
                    [
                        'name' => $row['empresa'],
                        'address' => $row['direccion'],
                    ]
                );

            BaseHeader::all()->each(function ($base) use ($customer) {
                $base['customer_id'] = $customer->id;
                Header::create($base->toArray());
            });

            BasePension::all()->each(function ($pension) use ($customer) {
                $pension['customer_id'] = $customer->id;
                PensionFund::create($pension->toArray());
            });
        });
    }

    private function validationRow($row, int $key)
    {
        $currentRow = $key + 2;

        $messages = [
            'required' => "El campo :attribute es requerido en la fila $currentRow.",
            'unique'   => "El campo :attribute  ya está en uso en la fila $currentRow.",

        ];

        Validator::make($row->toArray(), [
            'empresa' => 'required|unique:customers,name',
            'ruc'     => 'required|numeric|unique:customers',
        ], $messages)->validate();

    }

}
