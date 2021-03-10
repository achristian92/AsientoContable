<?php


namespace App\AsientoContable\Payrolls\Transformations;


use App\AsientoContable\AccountPlan\AccountPlan;
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

    public function transformPaybleDetail(Payroll $payroll,$account)
    {
        $payrollMonth = Carbon::parse($payroll->payroll_date);
        $model = new Payroll();
        $model->id             = $payroll->id;
        $model->customer       = $payroll->customer_id;
        $model->file           = $payroll->file_id;
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

        $model->has_household  = $payroll->family_allowance ? 'Si - S/'. number_format($payroll->family_allowance,2) : 'No';
        $model->household_amount  = $payroll->family_allowance ? 'S/'.number_format($payroll->family_allowance,2) : '';

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

        $concepts = collect([
            'salary'    => $this->calculateSalary($payroll,$account),
            'family'    => $this->calculateAssignFamily($payroll,$account),
            'pension'   => $this->calculatePension($payroll,$account),
            '5cat'      => $this->calculate5Cat($payroll,$account),
            'eps'       => $this->calculateEPS($payroll,$account),
            'essalud_g' => $this->calculatehealthExpense($payroll,$account),
            'total_pay' => $this->calculateNetToPay($payroll,$account),
            'essalud_p' => $this->calculatehealthPasive($payroll,$account),
        ]);

        $model->concepts = $concepts;
        $model->totalExpense = $concepts->where('type','GASTO')->pluck('raw_amount')->sum();
        $model->totalPasive = $concepts->where('type','PASIVO')->pluck('raw_amount')->sum();

        return $model;
    }

    private function calculateSalary($payroll, $account): array
    {
        $data = $account->firstWhere('import_slug','remuneracion_basicag');
        return [
            'code' => $data->code,
            'name' => $data->name,
            'amount' => number_format($payroll->base_salary,2),
            'raw_amount' => (float)$payroll->base_salary,
            'type' => $data->type
        ];
    }

    private function calculateAssignFamily($payroll, $account): array
    {
        $data = $account->firstWhere('import_slug','asignacion_familiarg');
        return [
            'code' => $data->code,
            'name' => $data->name,
            'amount' => number_format($payroll->family_allowance,2),
            'raw_amount' => (float)$payroll->family_allowance,
            'type' => $data->type
        ];
    }

    private function calculatePension($payroll,$accounts):array
    {
        $data = $accounts->firstWhere('import_slug',$this->searchPensionName($payroll->pension_short));
        if ($payroll->short_pension === 'ON') {
            return [
                'code' => $data->code,
                'name' => $data->name,
                'amount' => $payroll->pension_discount,
                'raw_amount' => (float)$payroll->pension_discount,
                'type' => $data->type
            ];
        }
        $total = $payroll->pension_discount + $payroll->insurance_discount + $payroll->commission_discount;
        return [
            'code' => $data->code,
            'name' => $data->name,
            'amount' => number_format($total,2),
            'raw_amount' => (float)$total,
            'type' => $data->type
        ];
    }

    private function calculate5Cat($payroll, $account): array
    {
        $data = $account->firstWhere('import_slug','renta_de_5ta_categoriap');
        return [
            'code' => $data->code,
            'name' => $data->name,
            'amount' => number_format($payroll->fifth_category,2),
            'raw_amount' => (float)$payroll->fifth_category,
            'type' => $data->type
        ];
    }

    private function calculateEPS($payroll, $account): array
    {
        $data = $account->firstWhere('import_slug','eps_empleadog');
        return [
            'code' => $data->code,
            'name' => $data->name,
            'amount' => number_format($payroll->with_eps,2),
            'raw_amount' => (float)$payroll->with_eps,
            'type' => $data->type
        ];
    }

    private function calculatehealthExpense($payroll, $account): array
    {
        $data = $account->firstWhere('import_slug','essaludg');
        return [
            'code' => $data->code,
            'name' => $data->name,
            'amount' => number_format($payroll->esshealth,2),
            'raw_amount' => (float)$payroll->esshealth,
            'type' => $data->type
        ];
    }

    private function calculateNetToPay($payroll, $account): array
    {
        $data = $account->firstWhere('import_slug','sueldop');
        return [
            'code' => $data->code,
            'name' => $data->name,
            'amount' => number_format($payroll->net_pay,2),
            'raw_amount' => (float)$payroll->net_pay,
            'type' => $data->type
        ];
    }

    private function calculatehealthPasive($payroll, $account): array
    {
        $data = $account->firstWhere('import_slug','essaludp');
        return [
            'code' => $data->code,
            'name' => $data->name,
            'amount' => number_format($payroll->esshealth,2),
            'raw_amount' => (float)$payroll->esshealth,
            'type' => $data->type
        ];
    }

    private function searchPensionName($short_name): string
    {
        switch ($short_name) {
            case "IN":
                return "in_afp_integra";
                break;
            case "HA":
                return "ha_afp_habitat";
                break;
            case "PR":
                return "pr_afp_profuturo";
                break;
            case "PM":
                return "pm_afp_prima";
                break;
            default :
                return 'onpp';
                break;
        }
    }

}
