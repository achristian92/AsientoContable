<?php


namespace App\Http\Controllers\Admin\Collaborators;


use App\Http\Controllers\Controller;

class CollaboratorController extends Controller
{
    public function index(int $customer_id)
    {
        return view('customers.collaborators.matriz.index');
    }
}
