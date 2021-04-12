<?php


namespace App\Http\Controllers\Admin\AccountingPlan;


use App\AsientoContable\Tools\FileExcelRequest;
use App\AsientoContable\Tools\UploadableTrait;
use App\Http\Controllers\Controller;
use App\Imports\AccountPlanImport;
use App\Models\History;
use Maatwebsite\Excel\Facades\Excel;

class AccountImportController extends Controller
{
    use UploadableTrait;

    public function __invoke(FileExcelRequest $request,$customer_id)
    {
        Excel::import(new AccountPlanImport($customer_id), $request->file('file_upload'));

        $url = $this->handleUploadedDocument($request->file('file_upload'),'import');
        history(History::IMPORT_TYPE,"Importó plan contable",$url);

        return redirect()
               ->route('admin.customers.accounting-plan.index',$customer_id)
               ->with('message','Información cargada');

    }

}
