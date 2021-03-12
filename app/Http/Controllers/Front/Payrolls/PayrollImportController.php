<?php


namespace App\Http\Controllers\Front\Payrolls;


use App\AsientoContable\Files\File;
use App\Http\Controllers\Controller;
use App\Imports\CustomersImport;
use App\Imports\PayrollImport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class PayrollImportController extends Controller
{
    public function __invoke(Request $request,int $customer_id)
    {
        $request->validate([
            'file_upload' => 'required|file|mimes:xls,xlsx',
            'month'       => 'required|date'
        ]);

        $headings = (new HeadingRowImport)->toArray($request->file('file_upload'));

        $date = Carbon::parse($request->month);

        $file = File::updateOrCreate(
            [
                'month_payroll' => $date,
                'customer_id' => customerID()
            ],
            [
                'name' => ucfirst($date->monthName).'-'.$date->year,
                'url_file' => 'file',
                'user_id' => \Auth::id(),
            ]
        );

        Excel::import(new PayrollImport($customer_id,$date,$file->id), $request->file('file_upload'));

        return redirect()->route('admin.customers.payrolls.show',[$customer_id,$file->id])
                         ->with('message','Información cargada');
    }

}
