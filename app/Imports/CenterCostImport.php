<?php


namespace App\Imports;


use App\AsientoContable\CenterCosts\CenterCost;
use App\AsientoContable\Customers\Customer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CenterCostImport implements ToCollection,WithHeadingRow
{
    private $customer_id;
    private $type;

    public function __construct(int $customer_id,string $type = 'customer')
    {
        $this->customer_id = $customer_id;
        $this->type = $type;
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $collection)
    {
        $collection->each(function ($row,$key) {

            $this->validationRow($row, $key);

            CenterCost::updateOrCreate(
                [
                    'code'  => trim($row['cod']),
                    'customer_id' => $this->customer_id
                ],
                [
                    'name' => $row['descripcion'],
                    'type' => $this->type
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
            'cod'     => 'required',
            'descripcion'     => 'required',
        ], $messages)->validate();

    }
}
