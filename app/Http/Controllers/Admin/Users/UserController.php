<?php


namespace App\Http\Controllers\Admin\Users;


use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

}
