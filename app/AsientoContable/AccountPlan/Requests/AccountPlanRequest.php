<?php


namespace App\AsientoContable\AccountPlan\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountPlanRequest extends FormRequest
{
    public function rules() {
        $rules = [
            'code' => [
                'required',
                Rule::unique('account_plan')->where(function ($query) {
                    return $query->whereCode($this->code)
                                 ->whereCustomerId(customerID());
                })
            ],
            'name' => 'required|max:255',
            'type' => 'required',
        ];

        if ($this->isMethod('PUT')) {
            $rules['code'] = [
                'required',
                Rule::unique('account_plan')->where(function ($query) {
                    return $query->whereCode($this->code)
                        ->whereCustomerId(customerID());
                })->ignore($this->segment(5))
            ];
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'code.required' => "Código de la cuenta es obligatorio",
            'code.unique' => "El valor del campo código ya está en uso.",
            'name.required' => "Nombre de la cuenta es obligatorio",
            'type.required' => "Tipo de cuenta es obligatorio",
        ];
    }
}
