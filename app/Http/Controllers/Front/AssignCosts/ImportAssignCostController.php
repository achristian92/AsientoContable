<?php


namespace App\Http\Controllers\Front\AssignCosts;


use App\AsientoContable\Tools\FileExcelRequest;
use App\Exports\TemplateCostDistributionExport;
use App\Http\Controllers\Controller;
use App\Imports\CostsDistributionImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportAssignCostController extends Controller
{
    public function template(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $headers = ['NRO DOCUMENTO','COD CENTRO COSTO','PORCENTAJE'];
        return Excel::download(new TemplateCostDistributionExport($headers), 'DistribucionCostos.xlsx');
    }

    public function import(FileExcelRequest $request,int $customer): \Illuminate\Http\JsonResponse
    {
        Excel::import(new CostsDistributionImport($request->file_id,$customer), $request->file('file_upload'));

        return response()->json([
            'msg' => 'Información cargada',
        ], 201);
    }
}
