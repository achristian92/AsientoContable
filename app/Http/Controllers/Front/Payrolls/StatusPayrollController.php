<?php


namespace App\Http\Controllers\Front\Payrolls;


use App\AsientoContable\Files\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusPayrollController extends Controller
{
    public function open(Request $request,int $customer)
    {
        $file = File::find($request->file_id);
        $file->status = File::STATUS_OPEN;
        $file->save();

        return response()->json([
            'url' => route('admin.customers.payrolls.show',[$customer,$file->id]),
            'msg' => 'Planilla abierta',
        ],201);
    }

}
