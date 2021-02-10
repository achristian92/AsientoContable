<?php


namespace App\Http\Controllers\Admin\CostCenter;


use App\Http\Controllers\Controller;

class CostCenterController extends Controller
{
    public function index()
    {
        return view('customers.cost-center.index');
    }

}
