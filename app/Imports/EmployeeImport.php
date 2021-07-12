<?php


namespace App\Imports;

use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Tools\DateTrait;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeeImport implements ToCollection,WithHeadingRow,WithValidation
{
    use DateTrait;

    private $customer;

    public function __construct(int $customer)
    {
        $this->customer = $customer;
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $rows)
    {

        $rows->each(function ($row) {
            $row['fecha_ingreso'] = $this->transformDateTime($row['fecha_ingreso']);

            Collaborator::updateOrCreate(
                [
                    'nro_document'    => $row['nro_doc'],
                    'customer_id'     => $this->customer
                ],
                [
                    'code'            => $row['codigo'],
                    'full_name'       => $row['nombres_completo'],
                    'type_document'   => $row['tipo_doc'],
                    'date_start_work' => $row['fecha_ingreso'],
                    'cuspp'           => $row['cuspp'],
                    'code_cuspp'      => $row['autogenerado'],
                    'especial'        => $row['sit_especial'],
                ]
            );
        });
    }

    public function rules(): array
    {
        return [
            '*.nombres_completo' => 'required',
            '*.codigo'           => 'required',
            '*.nro_doc'          => 'required|numeric',
            '*.fecha_ingreso'    => 'required',
        ];
    }

}
