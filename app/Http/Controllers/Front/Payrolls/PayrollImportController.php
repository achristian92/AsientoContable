<?php


namespace App\Http\Controllers\Front\Payrolls;


use App\AsientoContable\CenterCosts\Repositories\ICenterCost;
use App\AsientoContable\Files\File;
use App\AsientoContable\Headers\Repositories\IHeader;
use App\AsientoContable\Payrolls\Requests\ImportRequest;
use App\AsientoContable\PensionFund\Repositories\IPensionFund;
use App\Http\Controllers\Controller;
use App\Imports\PayrollImport;
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
    private $headerRepo, $pensionRepo, $centerCostRepo;

    public function __construct(ICenterCost $ICenterCost, IHeader $IHeader,IPensionFund $IPensionFund)
    {
        $this->centerCostRepo = $ICenterCost;
        $this->headerRepo = $IHeader;
        $this->pensionRepo = $IPensionFund;
    }

    public function __invoke(ImportRequest $request,int $customer_id)
    {
        if ($this->centerCostRepo->listCostsCenter()->count() === 0)
            return back()->with('error','No tienes ningún centro de costo para este cliente');

        if (!$this->headerRepo->isAssignedAccountWithHeaders())
            return back()->with('error','Falta asignar las cuentas contables a algunas cabeceras del excel');

        if (!$this->pensionRepo->isAssignedAccountWithPensions())
            return back()->with('error','Falta asignar las cuentas contables a las pensiones');

        if (!$this->hasEqualsHeaders($request))
            return back()->with('error','Las cabeceras del excel no coinciden con la del cliente');

        $date = Carbon::parse($request->month);

        $file = File::updateOrCreate(
            [
                'month_payroll' => $date,
                'customer_id' => customerID()
            ],
            [
                'name' => ucfirst($date->monthName).'-'.$date->year,
                'url_file' => 'file',
                'user_id' => \Auth::id(),
            ]
        );

        Excel::import(new PayrollImport($customer_id,$date,$file->id), $request->file('file_upload'));

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

}
