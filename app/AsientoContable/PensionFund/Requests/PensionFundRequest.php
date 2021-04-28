<?php


namespace App\AsientoContable\PensionFund\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PensionFundRequest extends FormRequest
{
    public function rules() {
        $rules = [
            'account_plan_id' => 'required',
            'name' => 'required',
            'short' => [
                'required',
                Rule::unique('pension_fund')->where(function ($query) {
                    return $query->where('short',$this->short)
                        ->whereCustomerId(customerID());
                })
            ]
        ];

        if ($this->isMethod('PUT')) {
            $rules['short'] = [
                'required',
                Rule::unique('pension_fund')->where(function ($query) {
                    return $query->where('short',$this->short)
                        ->whereCustomerId(customerID());
                })->ignore($this->segment(5))
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'short.required' => "Abreviatura es obligatorio",
            'name.required' => "Nombre es obligatorio",
            'account_plan_id.required' => "Seleccione la cuenta",
        ];
    }

}
