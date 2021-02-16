<?php


namespace App\Http\Controllers\Admin\Customers;


use App\Http\Controllers\Controller;
use App\Imports\CustomersImport;
use App\Imports\PlanCounterImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerImportController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'file_upload' => 'required|file|mimes:xls,xlsx'
        ]);

        Excel::import(new CustomersImport, $request->file('file_upload'));

        return redirect()->route('admin.customers.index')->with('message','Información cargada');

    }

}
