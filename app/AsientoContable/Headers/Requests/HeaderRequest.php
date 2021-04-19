<?php


namespace App\AsientoContable\Headers\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HeaderRequest extends FormRequest
{
    public function rules() {
        $rules = [
            'name' => 'required|max:255',
            'order' => 'required|numeric',
            /*'account_plan_id' => [
                'nullable',
                Rule::unique('headers')->where(function ($query) {
                    return $query->where('account_plan_id',$this->account_plan_id)
                        ->whereCustomerId(customerID());
                })
            ]*/
        ];
        /*if ($this->isMethod('PUT')) {
            $rules['account_plan_id'] = [
                'nullable',
                Rule::unique('headers')->where(function ($query) {
                    return $query->where('account_plan_id',$this->account_plan_id)
                        ->whereCustomerId(customerID());
                })->ignore($this->segment(5))
            ];
        }*/

        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => "La cabecera es obligatorio",
            'name.max' => "La cabecera debe contener máximo 255 caracteres",
            'account_plan_id.unique' => 'Cuenta contable ya esta en uso(uno cuenta por cabecera)'
        ];
    }
}
