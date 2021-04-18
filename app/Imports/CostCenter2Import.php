<?php


namespace App\Imports;

use App\AsientoContable\CostsCenter2\CostCenter2;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CostCenter2Import implements ToCollection,WithHeadingRow
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

            CostCenter2::updateOrCreate(
                [
                    'code'  => trim($row['cod']),
                    'customer_id' => $this->customer_id
                ],
                [
                    'name' => trim($row['descripcion']),
                ]
            );
        });
    }

    private function validationRow($row, int $key)
    {
        $currentRow = $key + 2;

        $messages = [
            'required' => "El campo :attribute es requerido en la fila $currentRow.",
        ];

        Validator::make($row->toArray(), [
            'cod'         => 'required',
            'descripcion' => 'required',
        ], $messages)->validate();

    }
}
