<?php


namespace App\Http\Controllers\Admin\AccountingPlan;


use App\Http\Controllers\Controller;

class AccountingPlanController extends Controller
{
    public function index()
    {
        return view('customers.accounting-plan.index');
    }

}
