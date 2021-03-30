<?php


namespace App\AsientoContable\Payrolls\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
{
    public function rules() {
        return [
            'file_upload' => 'required|file|mimes:xls,xlsx',
            'month'       => 'required|date'
        ];
    }
    public function messages()
    {
        return [
            'file_upload.required' => "Archivo es obligatorio",
            'file_upload.file' => "Debe ser un excel válido",
            'file_upload.mimes' => "Debe ser un formato de excel válido",
            'month.required' => "Mes de la planilla es obligatorio",
            'month.date' => "Mes de la planilla debe ser una fecha",

        ];
    }
}
