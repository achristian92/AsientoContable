<?php


namespace App\AsientoContable\PensionFund\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PensionFundRequest extends FormRequest
{
    public function rules() {
        $rules = [
            'code' => 'required|unique:pension_fund',
            'short' => 'required|unique:pension_fund',
            'name' => 'required',
        ];

        if ($this->isMethod('PUT')) {
            $rules['code'] = 'required|unique:pension_fund,code,'.$this->segment(3);
            $rules['short'] = 'required|unique:pension_fund,short,'.$this->segment(3);
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'code.required' => "Código  es obligatorio",
            'code.unique' => "El código ya está en uso.",
            'short.required' => "Abreviatura es obligatorio",
            'short.unique' => "Abreviatura ya está en uso.",
            'name.required' => "Nombre es obligatorio",
        ];
    }

}
