<?php


namespace App\Http\Controllers\Admin\Collaborators;


use App\Http\Controllers\Controller;

class AssignCostController extends Controller
{
    public function index()
    {
        return view('customers.collaborators.assign-costs.index');
    }

}
