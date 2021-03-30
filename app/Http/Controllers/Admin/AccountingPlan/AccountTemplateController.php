<?php


namespace App\Http\Controllers\Admin\AccountingPlan;


use App\AsientoContable\HeaderAccountingsAccount\HeaderAccount;
use App\Exports\TemplateAccountPlanExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AccountTemplateController extends Controller
{
    public function __invoke()
    {
        return Excel::download(new TemplateAccountPlanExport(), 'CuentasContables.xlsx');
    }

}
