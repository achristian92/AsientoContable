<?php


namespace App\Http\Controllers\Admin\Payrolls;


use App\AsientoContable\Files\File;
use App\AsientoContable\Payrolls\Payroll;
use App\AsientoContable\Payrolls\Repositories\IPayroll;
use App\Http\Controllers\Controller;

class PayrollController extends Controller
{
    private $payrollRepo;

    public function __construct(IPayroll $IPayroll)
    {
        $this->payrollRepo = $IPayroll;
    }

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
            'payrolls' => $this->payrollRepo->listPayrolls($id),
            'files' => File::with('payrolls')->whereCustomerId(customerID())->orderBy('id','desc')->get()
        ]);
    }

}
