<?php


namespace App\Http\Controllers\Admin\CostCenter;


use App\AsientoContable\Tools\FileExcelRequest;
use App\AsientoContable\Tools\UploadableTrait;
use App\Http\Controllers\Controller;
use App\Imports\CenterCostImport;
use App\Models\History;
use Maatwebsite\Excel\Facades\Excel;

class CenterCostImportController extends Controller
{
    use UploadableTrait;

    public function __invoke(FileExcelRequest $request,$customer_id)
    {
        Excel::import(new CenterCostImport($customer_id), $request->file('file_upload'));

        $url = $this->handleUploadedDocument($request->file('file_upload'),'import');
        history(History::IMPORT_TYPE,"Importó centro de costo",$url);

        return redirect()
            ->route('admin.customers.cost-center.index',$customer_id)
            ->with('message','Información cargada');

    }

    public function microtime_float(): float
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

}
