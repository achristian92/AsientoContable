<?php


namespace App\Http\Controllers\Admin\Payrolls;


use App\AsientoContable\Files\File;
use App\AsientoContable\Payrolls\Payroll;
use App\Http\Controllers\Controller;

class PayrollController extends Controller
{
    public function index()
    {
        return view('customers.collaborators.monthly-payroll.index',[
            'files' => File::with('payrolls')->whereCustomerId(customerID())->orderBy('id','desc')->get()
        ]);
    }

    public function show(int $customer_id, int $id)
    {
        return view('customers.collaborators.monthly-payroll.show',[
            'file' => File::find($id),
            'payrolls' => Payroll::with('collaborator')->whereFileId($id)->get(),
            'files' => File::with('payrolls')->whereCustomerId(customerID())->orderBy('id','desc')->get()
        ]);
    }

}
