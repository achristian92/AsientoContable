<?php


namespace App\Http\Controllers\Admin\AccountingPlan;


use App\AsientoContable\Headers\Header;
use App\Exports\TemplateAccountPlanExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AccountTemplateController extends Controller
{
    public function __invoke()
    {
        $headers = Header::all()->pluck('name');
        return Excel::download(new TemplateAccountPlanExport($headers), 'CuentasContables.xlsx');
    }

}
