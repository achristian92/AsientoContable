<?php


namespace App\AsientoContable\Customers\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function rules() {
        $rules = [
            'ruc' => 'nullable|unique:customers',
            'name' => 'required|max:255|unique:customers',
        ];
        if ($this->isMethod('PUT')) {
            $rules['ruc'] = 'required|unique:customers,ruc,'.$this->segment(3);
            $rules['name'] = 'required|unique:customers,name,'.$this->segment(3);
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'ruc.required' => "RUC es obligatorio",
            'ruc.unique' => "RUC ya está en uso",
            'name.required' => "Nombre de la empresa es obligatorio",
            'name.unique' => "Nombre de la empresa ya está en uso",
            'name.max' => "Nombre de la empresa debe contener máximo 255 caracteres",
        ];
    }
}
