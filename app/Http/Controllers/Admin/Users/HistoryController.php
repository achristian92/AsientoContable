<?php


namespace App\Http\Controllers\Admin\Users;


use App\Http\Controllers\Controller;
use App\Models\History;

class HistoryController extends Controller
{
    public function __invoke()
    {
        $histories = History::with('user','customer')->latest()->get();
        return view('admin.history.index',compact('histories'));
    }

}
