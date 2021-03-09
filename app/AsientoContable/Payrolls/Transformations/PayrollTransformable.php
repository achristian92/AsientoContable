<?php


namespace App\AsientoContable\Payrolls\Transformations;


use App\AsientoContable\Payrolls\Payroll;
use Carbon\Carbon;

trait PayrollTransformable
{
    public function transformPaybleShow(Payroll $payroll)
    {
        $model = new Payroll();
        $model->id = $payroll->id;
        $model->names = ucwords(strtolower($payroll->collaborator->full_name));
        $model->work_area = ucwords(strtolower($payroll->work_area)).' | '. ucwords(strtolower($payroll->position));
        $model->pension = ucwords(strtolower($payroll->pension));
        $model->pension_short = $payroll->pension_short;
        $model->has_family_allowance = $payroll->family_allowance ? true : false;
        $model->total_income = '+ S/'.number_format($payroll->total_income,2);
        $model->total_expense = '- S/'.number_format($payroll->total_expense,2);
        $model->total_contribution = 'S/'.number_format($payroll->total_contribution,2);
        $model->net_pay = 'S/'.number_format($payroll->net_pay,2);
        $model->checked = false;
        $model->file_id = $payroll->file_id;
        return $model;
    }

    public function transformPaybleDetail(Payroll $payroll)
    {


        $payrollMonth = Carbon::parse($payroll->payroll_date);
        $model = new Payroll();
        $model->id             = $payroll->id;
        $model->code           = $payroll->collaborator->code;
        $model->employee       = ucwords(strtolower($payroll->collaborator->full_name));
        $model->payroll_month  = 'Planilla '.ucfirst($payrollMonth->monthName).'-'.$payrollMonth->year;
        $model->work_area      = $payroll->work_area;
        $model->position       = $payroll->position;
        $model->document       = $payroll->collaborator->nro_document;
        $model->company        = ucwords(strtolower($payroll->collaborator->customer->name . $payroll->collaborator->customer->ruc));
        $model->work_start     = Carbon::parse($payroll->collaborator->date_start_work)->format('d/m/y');
        $model->work_end       = $payroll->date_termination ?? '--';

        $model->worked_days    = $payroll->nro_days_worked;
        $model->worked_hours   = $payroll->nro_hours_worked;

        $model->has_household  = $payroll->family_allowance ? 'Si' : 'No';
        $model->pension        = $payroll->pension;
        $model->salary         = 'S/'.number_format($payroll->base_salary,2);

        $model->total_income   = 'S/'.number_format($payroll->total_income,2);
        $model->total_expenses = 'S/'.number_format($payroll->total_expense,2);
        $model->contribution   = 'S/'.number_format($payroll->total_contribution,2);
        $model->net            = 'S/'.number_format($payroll->net_pay,2);

        $model->essalud        = 'S/'.number_format($payroll->esshealth,2);
        $model->eps            = 'S/'.number_format($payroll->with_eps,2);
        $model->category5      = 'S/'.number_format($payroll->fifth_category,2);
        $model->afp_discount   = 'S/'.number_format($payroll->pension_discount,2);
        $model->insurance      = 'S/'.number_format($payroll->insurance_discount,2);
        $model->commission     = 'S/'.number_format($payroll->commission_discount,2);

        $center_costs = $payroll->costs()->get()
            ->transform(function ($cost) {
                return [
                    'name' => "($cost->code) " . ucwords(strtolower($cost->name)),
                    'percentage'=> $cost->pivot->percentage
                ];
            });

        $model->costs_center = $center_costs;
        $model->total_percentage = $center_costs->reduce(function ($total, $item) {
            return $total + $item['percentage'];
        }, 0);


        return $model;
    }

}
