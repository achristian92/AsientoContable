<?php


namespace App\AsientoContable\Headers\Requests;


use Illuminate\Foundation\Http\FormRequest;

class HeaderRequest extends FormRequest
{
    public function rules() {
        $rules = [
            'name' => 'required|max:255',
        ];

        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => "La cabecera es obligatorio",
            'name.max' => "La cabecera debe contener máximo 255 caracteres",
        ];
    }
}
