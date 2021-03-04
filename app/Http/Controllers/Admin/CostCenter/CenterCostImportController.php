<?php


namespace App\Http\Controllers\Admin\CostCenter;


use App\Http\Controllers\Controller;
use App\Imports\AccountPlanImport;
use App\Imports\CenterCostImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CenterCostImportController extends Controller
{
    public function __invoke(Request $request,$customer_id)
    {
        $request->validate([
            'file_upload' => 'required|file|mimes:xls,xlsx'
        ]);

        Excel::import(new CenterCostImport($customer_id), $request->file('file_upload'));

        return redirect()
            ->route('admin.customers.cost-center.index',$customer_id)
            ->with('message','Información cargada');

    }

}
