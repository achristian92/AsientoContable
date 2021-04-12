<?php


namespace App\Http\Controllers\Front\AssignCosts;


use App\AsientoContable\Files\File;
use App\AsientoContable\Files\Repositories\IFile;
use App\AsientoContable\Tools\FileExcelRequest;
use App\AsientoContable\Tools\UploadableTrait;
use App\Exports\TemplateCostDistributionExport;
use App\Http\Controllers\Controller;
use App\Imports\CostsDistributionImport;
use App\Models\History;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportAssignCostController extends Controller
{
    use UploadableTrait;

    private $fileRepo;

    public function __construct(IFile $IFile)
    {
        $this->fileRepo = $IFile;
    }

    public function template(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $headers = ['NRO DOCUMENTO','COD CENTRO COSTO','PORCENTAJE'];
        return Excel::download(new TemplateCostDistributionExport($headers), 'DistribucionCostos.xlsx');
    }

    public function import(FileExcelRequest $request,int $customer): \Illuminate\Http\JsonResponse
    {
        if (!$this->isOpenPayroll($request)) {
            return response()->json([
                'status' => false,
                'msg' => 'Planilla cerrada',
            ]);
        }
        Excel::import(new CostsDistributionImport($request->file_id,$customer), $request->file('file_upload'));

        $file = $this->fileRepo->findFileById($request->file_id);
        $url = $this->handleUploadedDocument($request->file('file_upload'),'import');
        history(History::IMPORT_TYPE,"Importó Distribución de costo $file->name",$url);

        return response()->json([
            'status' => true,
            'msg' => 'Información cargada',
        ], 201);
    }
    public function isOpenPayroll(Request $request): bool
    {
        $file = File::find($request->file_id);
        if ($file)
            if ($file->status === File::STATUS_CLOSE)
                return false;

        return true;
    }
}
