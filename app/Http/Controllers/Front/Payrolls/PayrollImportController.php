<?php


namespace App\Http\Controllers\Front\Payrolls;


use App\AsientoContable\CenterCosts\Repositories\ICenterCost;
use App\AsientoContable\Files\File;
use App\AsientoContable\Files\Repositories\IFile;
use App\AsientoContable\Files\Requests\FileImportRequest;
use App\AsientoContable\Headers\Repositories\IHeader;
use App\AsientoContable\PensionFund\Repositories\IPensionFund;
use App\AsientoContable\Tools\UploadableTrait;
use App\Exports\EmployeeExport;
use App\Http\Controllers\Controller;
use App\Imports\PayrollImport;
use App\Models\History;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

class PayrollImportController extends Controller
{
    use UploadableTrait;

    private $headerRepo, $pensionRepo, $centerCostRepo,$fileRepo;

    public function __construct(IFile $IFile,ICenterCost $ICenterCost, IHeader $IHeader,IPensionFund $IPensionFund)
    {
        $this->fileRepo = $IFile;
        $this->centerCostRepo = $ICenterCost;
        $this->headerRepo = $IHeader;
        $this->pensionRepo = $IPensionFund;
    }

    public function __invoke(FileImportRequest $request,int $customer_id)
    {
        $url = $this->handleUploadedDocument($request->file('file_upload'),'import');
        history(History::IMPORT_TYPE,"Cargó planilla $request->month",$url);

        $time_start = $this->microtime_float();

        if ($this->centerCostRepo->listCostsCenter()->count() === 0)
            return response()->json([
                'is_correct' => false,
                'msg' => 'No tienes ningún centro de costo para este cliente',
            ]);

        if (!$this->headerRepo->isAssignedAccountWithHeaders())
            return response()->json([
                'is_correct' => false,
                'msg' => 'Falta asignar las cuentas contables a las cabeceras',
            ]);

        if (!$this->pensionRepo->isAssignedAccountWithPensions())
            return response()->json([
                'is_correct' => false,
                'msg' => 'Falta asignar las cuentas contables a las pensiones',
            ]);

        if (!$this->isValidHeaders($request))
            return response()->json([
                'is_correct' => false,
                'msg' => 'Tu excel tiene cabeceras no registras en el sistema',
            ]);

        if (!$this->canCreateOrUpdate($request))
            return response()->json([
                'is_correct' => false,
                'msg' => 'Se generó todos los asientos contables(Estado Cerrado)',
            ]);

        $file = $this->fileRepo->fileUpdateOrCreate($request);
        DB::table('concepts')->where('file_id',$file->id)->delete();
        DB::table('concept_accounts')->where('file_id',$file->id)->delete();
        DB::table('seatings')->where('file_id',$file->id)->delete();
        DB::table('cost_employee')->where('file_id',$file->id)->delete();

        Excel::import(new PayrollImport($customer_id,$file), $request->file('file_upload'));

        $time_end = $this->microtime_float();

        $time = round(($time_end - $time_start),2);

        history(History::IMPORT_TYPE,"Importó Planilla Mensual en $time sec",$file->url_file);

        return response()->json([
            'is_correct' => true,
            'url' => route('admin.customers.payrolls.show',[$customer_id,$file->id]),
            'msg' => 'Información cargada',
        ],201);
    }

    private function isValidHeaders(Request $request): bool
    {
        $fileHeaders = (new HeadingRowImport())->toArray($request->file('file_upload'))[0][0];
        $currentHeaders = $this->headerRepo->listHeaders()->pluck('slug');
        $diff = collect($fileHeaders)->diff($currentHeaders);
        \Log::info("DIFF". $diff);
        \Log::info("DIFF". $diff->count());
        return $diff->count() === 0;
    }

    public function canCreateOrUpdate(Request $request): bool
    {
        $date = Carbon::parse($request->month);
        $file = File::where('month_payroll',$date)->where('customer_id',customerID())->first();
        if ($file)
            if ($file->status === File::STATUS_CLOSE)
                return false;

        return true;
    }

    public function destroy(int $customer_id,int $id)
    {
        $file = File::find($id);
        if ($file->status === 'Cerrado')
            return response()->json([
                'msg' => 'La planilla se encuentra cerrada',
                'url' => route('admin.customers.payrolls.index',$customer_id)
            ]);

        \DB::table('seatings')->where('file_id',$file->id)->delete();
        \DB::table('concepts')->where('file_id',$file->id)->delete();
        \DB::table('concept_accounts')->where('file_id',$file->id)->delete();
        $file->delete();

        return response()->json([
            'msg' => 'La planilla eliminada',
            'url' => route('admin.customers.payrolls.index',$customer_id)
        ]);
    }

}
