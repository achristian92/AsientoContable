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
        if ($this->centerCostRepo->listCostsCenter()->count() === 0)
            return back()->with('error','No tienes ningún centro de costo para este cliente');

        if (!$this->headerRepo->isAssignedAccountWithHeaders())
            return back()->with('error','Falta asignar las cuentas contables a algunas cabeceras del excel');

        if (!$this->pensionRepo->isAssignedAccountWithPensions())
            return back()->with('error','Falta asignar las cuentas contables a las pensiones');

        if (!$this->hasEqualsHeaders($request))
            return back()->with('error','Las cabeceras del excel no coinciden con la del cliente');

        if (!$this->canCreateOrUpdate($request))
            return back()->with('error','Planilla cerrada, Se generó todos los asientos contables');

        $file = $this->fileRepo->fileUpdateOrCreate($request);

        Excel::import(new PayrollImport($customer_id,$file), $request->file('file_upload'));

        history(History::IMPORT_TYPE,"Importó Planilla Mensual",$file->url_file);

        return redirect()->route('admin.customers.payrolls.show',[$customer_id,$file->id])
                         ->with('message','Información cargada');
    }

    private function hasEqualsHeaders(Request $request): bool
    {
        $headings = (new HeadingRowImport)->toArray($request->file('file_upload'))[0][0];
        $headerCustomer = $this->headerRepo->listHeaders()->pluck('slug');
        $diff = collect($headings)->diff($headerCustomer);
        return count(($diff->all())) === 0;
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

}
