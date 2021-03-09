<?php


namespace App\Http\Controllers\Admin\CostCenter;


use App\Imports\CostCenter2Import;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CenterCost2ImportController
{
    public function __invoke(Request $request,$customer_id)
    {
        $request->validate([
            'file_upload' => 'required|file|mimes:xls,xlsx'
        ]);

        Excel::import(new CostCenter2Import($customer_id), $request->file('file_upload'));

        return redirect()
            ->route('admin.customers.cost-center2.index',$customer_id)
            ->with('message','Información cargada');

    }

}
