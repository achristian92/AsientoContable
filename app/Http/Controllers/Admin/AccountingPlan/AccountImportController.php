<?php


namespace App\Http\Controllers\Admin\AccountingPlan;


use App\Http\Controllers\Controller;
use App\Imports\AccountPlanImport;
use App\Imports\CustomersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class AccountImportController extends Controller
{
    public function __invoke(Request $request,$customer_id)
    {
        $request->validate([
            'file_upload' => 'required|file|mimes:xls,xlsx'
        ]);

        $headings = (new HeadingRowImport)->toArray($request->file('file_upload'));

        Excel::import(new AccountPlanImport($customer_id), $request->file('file_upload'));

        return redirect()
               ->route('admin.customers.accounting-plan.index',$customer_id)
               ->with('message','Información cargada');

    }

}
