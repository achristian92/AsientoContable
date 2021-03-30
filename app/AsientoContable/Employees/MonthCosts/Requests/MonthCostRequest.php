<?php


namespace App\AsientoContable\Employees\MonthCosts\Requests;


use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MonthCostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'month' => ['required',
                Rule::unique('month_costs')->where(function ($query) {
                    return $query->where('month',$this->month)
                        ->whereCustomerId(customerID());
                })]
        ];
    }
    public function messages(): array
    {
        return [
            'month.required' => "Mes de la planilla es obligatorio",
            'month.date_format' => "Mes de la planilla es incorrecto",
            'month.unique' => "Mes de la planilla ya existe",
        ];
    }
}
