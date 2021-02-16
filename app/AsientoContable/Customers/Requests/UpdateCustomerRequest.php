<?php


namespace App\AsientoContable\Customers\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function rules() {
        return [
            'name' => 'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Nombre de la empresa es obligatorio",
        ];
    }
}
