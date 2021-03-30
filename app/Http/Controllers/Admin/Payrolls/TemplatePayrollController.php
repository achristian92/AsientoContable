<?php


namespace App\Http\Controllers\Admin\Payrolls;


use App\AsientoContable\AccountsHeaders\AccountHeader;
use App\AsientoContable\Headers\Repositories\IHeader;
use App\Exports\TemplateAccountPlanExport;
use App\Exports\TemplatePayrollExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class TemplatePayrollController extends Controller
{
    private $headerRepo;

    public function __construct(IHeader $IHeader)
    {
        $this->headerRepo = $IHeader;
    }

    public function __invoke(int $customer_id): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        //$headers = AccountHeader::where(['customer_id'=>$customer_id,'show'=>true])->orderBy('order')->get()->pluck('name');
        $headers = $this->headerRepo->listHeaders()->pluck('name');
        return Excel::download(new TemplatePayrollExport($headers->toArray()), 'PlanillaMensual.xlsx');
    }

}
