<?php


namespace App\AsientoContable\Tools;


use Illuminate\Foundation\Http\FormRequest;

class FileExcelRequest extends FormRequest
{
    public function rules() {
        return [
            'file_upload' => 'required|file|mimes:xls,xlsx',
        ];
    }
    public function messages()
    {
        return [
            'file_upload.required' => "El documento excel es obligatorio",
            'file_upload.file' => "El documento debe ser un archivo",
            'file_upload.mimes' => "El documento debe ser (xlx,xlsx)",
        ];
    }
}
