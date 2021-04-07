<?php


namespace App\Http\Controllers\Admin\Customers;


use App\AsientoContable\Tools\FileExcelRequest;
use App\Http\Controllers\Controller;
use App\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;

class CustomerImportController extends Controller
{
    public function __invoke(FileExcelRequest $request)
    {
        
        Excel::import(new CustomersImport, $request->file('file_upload'));

        return redirect()->route('admin.customers.index')->with('message','Información cargada');

    }

}
