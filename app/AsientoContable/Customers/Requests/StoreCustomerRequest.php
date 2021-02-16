<?php


namespace App\AsientoContable\Customers\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function rules() {
        return [
            'name' => 'required|max:255|unique:customers',
            'ruc' => 'nullable|unique:customers',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Nombre de la empresa es obligatorio",
            'name.unique' => "Nombre de la empresa ya está en uso",
            'name.max' => "Nombre de la empresa debe contener máximo 255 caracteres",
        ];
    }

}
