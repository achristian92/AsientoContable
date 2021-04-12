<?php


namespace App\Http\Controllers\Admin\CostCenter;

use App\AsientoContable\Tools\FileExcelRequest;
use App\AsientoContable\Tools\UploadableTrait;
use App\Imports\CostCenter2Import;
use App\Models\History;
use Maatwebsite\Excel\Facades\Excel;

class CenterCost2ImportController
{
    use UploadableTrait;

    public function __invoke(FileExcelRequest $request,$customer_id)
    {
        Excel::import(new CostCenter2Import($customer_id), $request->file('file_upload'));

        $url = $this->handleUploadedDocument($request->file('file_upload'),'import');
        history(History::IMPORT_TYPE,"Importó centro de costo nro: 2",$url);

        return redirect()
            ->route('admin.customers.cost-center2.index',$customer_id)
            ->with('message','Información cargada');

    }

}
