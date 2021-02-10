<?php


namespace App\Http\Controllers\Admin\AccountingSeat;


use App\Http\Controllers\Controller;

class AccountingSeatController extends Controller
{
    public function index()
    {
        return view('customers.collaborators.accounting-seat.index');
    }
}
