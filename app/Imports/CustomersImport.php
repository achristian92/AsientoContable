<?php

namespace App\Imports;

use App\AsientoContable\Customers\Customer;
use App\Repositories\Activities\Activity;
use App\Repositories\Tags\Tag;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
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

                 Customer::updateOrCreate(
                    [
                        'ruc'  => $row['ruc'],
                    ],
                    [
                        'name' => $row['empresa'],
                    ]
                );
        });
    }

    private function validationRow($row, int $key)
    {
        $currentRow = $key + 2;

        $messages = [
            'required'    => "El campo :attribute es requerido en la fila $currentRow.",
            'unique'    => "El campo :attribute  ya está en uso en la fila $currentRow.",

        ];

        Validator::make($row->toArray(), [
            'empresa'     => 'required|unique:customers,name',
            'ruc'     => 'required|unique:customers,ruc',
        ], $messages)->validate();

    }

}
