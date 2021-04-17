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
        $headers = BaseHeader::all()->toArray();
        $pensions = BasePension::all()->toArray();
        Excel::import(new CustomersImport($headers,$pensions), $request->file('file_upload'));
        $url = $this->handleUploadedDocument($request->file('file_upload'),'import');
        history(History::IMPORT_TYPE,"Importó clientes",$url);

        return redirect()->route('admin.customers.index')->with('message','Información cargada');

    }

}
