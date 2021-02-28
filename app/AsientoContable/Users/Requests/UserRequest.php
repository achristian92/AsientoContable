<?php


namespace App\AsientoContable\Users\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function rules() {
        $rules = [
                'name' => 'required',
               'email' => 'required|email|unique:users',
        'nro_document' => 'nullable|unique:users',
        ];

        if ($this->isMethod('PUT')) {
            $rules['email'] = 'required|unique:users,email,'.$this->segment(3);
            $rules['nro_document'] = 'required|unique:users,nro_document,'.$this->segment(3);
        }

        return $rules;
    }
    public function messages()
    {
        return [
              'name.required' => "Nombre es obligatorio",
             'email.required' => "Correo es obligatorio",
              'email.email'   => "Formato del correo incorrecto",
             'email.unique'   => "Correo ya está en uso",
        'nro_document.unique' => "Número de documento ya está en uso",
        ];
    }
}
