<?php


namespace App\Http\Controllers\Admin\Payrolls;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\Headers\Repositories\IHeader;
use App\Exports\TemplatePayrollExport;
use App\Http\Controllers\Controller;
use App\Models\History;
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
        $headers = $this->headerRepo->listHeaders()
                ->transform(function ($header) {
                    return [
                        'name' => $header->name,
                        'nroAccount' => $header->nroAccount(),
                        'bgColor' => $header->bgColorByAccountType()
                    ];
                });

        history(History::EXPORT_TYPE,"Exportó template Planilla");

        return Excel::download(new TemplatePayrollExport($headers->toArray()), 'PlanillaMensual.xlsx');
    }

}
