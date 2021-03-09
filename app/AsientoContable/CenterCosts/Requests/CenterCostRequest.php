<?php


namespace App\AsientoContable\CenterCosts\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CenterCostRequest extends FormRequest
{
    public function rules() {
        $rules = [
            'code' => [
                'required',
                Rule::unique('costs')->where(function ($query) {
                    return $query->whereCode(trim($this->code))
                                 ->whereCustomerId(customerID());
                })
            ],
            'name' => 'required|max:255',
        ];

        if ($this->isMethod('PUT')) {
            $rules['code'] = [
                'required',
                Rule::unique('costs')->where(function ($query) {
                    return $query->whereCode(trim($this->code))
                                 ->whereCustomerId(customerID());
                })->ignore($this->segment(5))
            ];
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'code.required' => "Código  es obligatorio",
            'code.unique' => "El código ya está en uso.",
            'name.required' => "Nombre es obligatorio",
        ];
    }

}
