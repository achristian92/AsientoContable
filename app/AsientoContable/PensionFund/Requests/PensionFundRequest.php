<?php


namespace App\AsientoContable\PensionFund\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PensionFundRequest extends FormRequest
{
    public function rules() {
        return [
            'short' => 'required',
            'name' => 'required',
            'account_plan_id' => 'required'
        ];
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
