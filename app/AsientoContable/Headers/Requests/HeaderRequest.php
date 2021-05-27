<?php


namespace App\AsientoContable\Headers\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Str;

class HeaderRequest extends FormRequest
{

    public function rules() {
        $rules = [
            'name' => [
                'required',
                'max:30',
                Rule::unique('headers')->where(function ($query) {
                    return $query->where('name',$this->name)
                        ->whereCustomerId(customerID());
                })
            ],
            'order' => 'required|numeric',
        ];
        if ($this->isMethod('PUT')) {


            $rules['name'] = [
                'required',
                'max:30',
                Rule::unique('headers')->where(function ($query) {
                    return $query->where('name',$this->name)
                        ->whereCustomerId(customerID());
                })->ignore($this->segment(5))
            ];
        }

        return $rules;
    }
    public function messages(): array
    {
        return [
            'name.required' => "La cabecera es obligatorio",
            'name.max' => "La cabecera debe contener máximo 255 caracteres",
            'name.unique' => 'Cabecera ya esta en uso',
            'account_plan_id.unique' => 'Cuenta contable ya está en uso de modo principal(selecciona modo secundaria)',
        ];
    }
}
