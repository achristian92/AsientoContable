<?php


namespace App\Imports;


use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements  ToCollection,WithHeadingRow,WithValidation
{
    public function collection(Collection $rows)
    {
        $rows->each(function ($row) {

            $user = User::updateOrCreate(
                [
                    'nro_document' => $row['nro_doc'],
                    'email'        => $row['email'],
                ],
                [
                    'name'         => $row['nombres'],
                    'last_name'    => $row['apellidos'],
                    'password'     => $row['password'],
                    'raw_password' => $row['crudo_password'],
                ]
            );

            $user->assignRole('Usuario');


        });

    }

    public function headingRow(): int
    {
        return 1;
    }

    public function rules(): array
    {
        return [
            '*.nombres'        => 'required',
            '*.apellidos'      => 'required',
            '*.email'          => 'required|email',
            '*.password'       => 'required',
            '*.crudo_password' => 'required',
            '*.nro_doc'        => 'required',
        ];
    }
}
