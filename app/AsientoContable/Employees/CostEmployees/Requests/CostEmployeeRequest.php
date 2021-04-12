<?php


namespace App\AsientoContable\Employees\CostEmployees\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CostEmployeeRequest  extends FormRequest
{
    public function rules(): array
    {
        $rules =  [
            'collaborator_id' => 'required',
            'file_id'         => 'required',
        ];

        foreach($this->request->get('costs') as $key => $val) {
            if (!empty($val)) {
                $rules["costs.$key.cost_id"]    = 'required';
                $rules["costs.$key.percentage"] = 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/';
            }
        }
        return $rules;
    }
    public function messages(): array
    {
        $messages = [
            'collaborator_id.required'  => "Colaborador es requerido",
            'file_id.required'          => "ID del file es requerido",
        ];

        foreach($this->request->get('costs') as $key => $val)
        {
            $messages["costs.$key.cost_id.required"]    = 'Centro de costo es requerido (Fila-'.($key+1).')';
            $messages["costs.$key.percentage.required"] = 'Porcentage es requerido (Fila-'.($key+1).')';
            $messages["costs.$key.percentage.regex"]    = 'Porcentage tiene formato incorrecto (Fila-'.($key+1).')';
        }

        return $messages;
    }
}
