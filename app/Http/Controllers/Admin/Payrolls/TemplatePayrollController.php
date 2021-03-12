<?php


namespace App\Http\Controllers\Admin\Payrolls;


use App\AsientoContable\AccountsHeaders\AccountHeader;
use App\Exports\TemplateAccountPlanExport;
use App\Exports\TemplatePayrollExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class TemplatePayrollController extends Controller
{
    public function __invoke(int $customer_id)
    {
        $headers = AccountHeader::where(['customer_id'=>$customer_id,'show'=>true])->orderBy('order')->get()->pluck('name');
        return Excel::download(new TemplatePayrollExport($headers->toArray()), 'PlanillaMensual.xlsx');
    }

}
