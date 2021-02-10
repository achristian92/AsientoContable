<?php


namespace App\Http\Controllers\Admin\MonthlyPayroll;


use App\Http\Controllers\Controller;

class MonthlyPayrollController extends Controller
{
    public function index()
    {
        return view('customers.collaborators.monthly-payroll.index');
    }

}
