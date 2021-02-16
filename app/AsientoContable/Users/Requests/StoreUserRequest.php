<?php


namespace App\AsientoContable\Users\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function rules() {
        return [
            'name' => 'required',
            'email' => 'required|email',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Nombre es obligatorio",
            'email.required' => "Correo es obligatorio",
            'email.email'   => "Formato del correo incorrecto",
        ];
    }
}
