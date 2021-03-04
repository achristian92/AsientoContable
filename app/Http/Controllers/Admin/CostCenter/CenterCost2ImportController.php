<?php


namespace App\Http\Controllers\Admin\CostCenter;


use App\AsientoContable\CenterCosts\CenterCost;
use App\Imports\CenterCostImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CenterCost2ImportController
{
    public function __invoke(Request $request,$customer_id)
    {
        $request->validate([
            'file_upload' => 'required|file|mimes:xls,xlsx'
        ]);

        Excel::import(new CenterCostImport($customer_id,CenterCost::TYPE_EMPLOYEE), $request->file('file_upload'));

        return redirect()
            ->route('admin.customers.cost-center2.index',$customer_id)
            ->with('message','Información cargada');

    }

}
