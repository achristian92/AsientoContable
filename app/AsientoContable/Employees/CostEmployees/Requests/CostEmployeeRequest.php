<?php


namespace App\AsientoContable\Employees\CostEmployees\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CostEmployeeRequest  extends FormRequest
{
    public function rules(): array
    {
        return [
            'collaborator_id' => 'required',
            'cost_id'         => 'required',
            'percentage'      => 'required|numeric|min:1|max:100',
            'month_cost_id'   => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'collaborator_id.required'  => "Colaborador es requerido",
            'cost_id.required'          => "Centro de costo es requerido",
            'percentage.required'       => "Porcentage es requerido",
            'percentage.numeric'        => "Porcentage debe ser un número",
            'percentage.min'            => "Porcentage debe ser minímo 1",
            'percentage.max'            => "Porcentage debe ser máximo 100",
            'month_cost_id.required'    => "Mes es requerido",
        ];
    }
}
