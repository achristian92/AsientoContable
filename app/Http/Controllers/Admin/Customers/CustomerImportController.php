<?php


namespace App\Http\Controllers\Admin\Customers;


use App\AsientoContable\Base\BaseHeader;
use App\AsientoContable\Base\BasePension;
use App\AsientoContable\Tools\FileExcelRequest;
use App\AsientoContable\Tools\UploadableTrait;
use App\Http\Controllers\Controller;
use App\Imports\CustomersImport;
use App\Models\History;
use Maatwebsite\Excel\Facades\Excel;

class CustomerImportController extends Controller
{
    use UploadableTrait;

    public function __invoke(FileExcelRequest $request)
    {
        $time_start = $this->microtime_float();

        $baseHeaders = BaseHeader::all(['name','slug','has_account','is_account_main','is_required','type','order','is_active'])->toArray();

        $basePensions = BasePension::all(['short','name'])->toArray();

        Excel::import(new CustomersImport($baseHeaders,$basePensions), $request->file('file_upload'));

        $url = $this->handleUploadedDocument($request->file('file_upload'),'import');

        $time_end = $this->microtime_float();

        $time = round(($time_end - $time_start),2);

        history(History::IMPORT_TYPE,"Importó clientes en $time sec",$url);

        return redirect()->route('admin.customers.index')->with('message','Información cargada');
    }

}
