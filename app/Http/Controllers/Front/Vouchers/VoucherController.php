<?php


namespace App\Http\Controllers\Front\Vouchers;


use App\AsientoContable\CenterCosts\Repositories\ICenterCost;
use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\Customers\Repositories\ICustomer;
use App\AsientoContable\Files\Repositories\IFile;
use App\AsientoContable\Headers\Header;
use App\AsientoContable\Headers\Repositories\IHeader;
use App\AsientoContable\PensionFund\Repositories\IPensionFund;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class VoucherController extends Controller
{
    private $headerRepo,$pensionRepo,$costCenterRepo,$fileRepo,$customerRepo;

    public function __construct(ICustomer $ICustomer,IFile $IFile,IHeader $IHeader,IPensionFund $IPensionFund,ICenterCost $ICenterCost)
    {
        $this->customerRepo = $ICustomer;
        $this->fileRepo = $IFile;
        $this->headerRepo = $IHeader;
        $this->pensionRepo = $IPensionFund;
        $this->costCenterRepo = $ICenterCost;
    }

    public function __invoke(int $customer, int $file, int $employee)
    {

        $headerIncome = $this->fileRepo->listHeaderNamesByType($file,Header::TYPE_INCOME);
        $headerExpense = $this->fileRepo->listHeaderNamesByType($file,Header::TYPE_EXPENSE);
        $headerContribution = $this->fileRepo->listHeaderNamesByType($file,Header::TYPE_CONTRIBUTION);

        $data = Collaborator::with(['concepts'=> function($query) use ($file) {
            return $query->where('file_id',$file);
        }])->find($employee);

        $income = $data->concepts->whereIn('header',$headerIncome)
            ->filter(function ($concept) {
                return $concept->value;
            });
        $expense = $data->concepts->whereIn('header',$headerExpense)
            ->filter(function ($concept) {
                return $concept->value;
            });
        $contribution = $data->concepts->whereIn('header',$headerContribution)
            ->filter(function ($concept) {
                return $concept->value;
            });

        $codeCostCenter = $data->concepts->firstWhere('header',Concept::COSTCENTER)->value;
        $codePension = $data->concepts->firstWhere('header',Concept::PENSION_SHORT)->value;
        $model = new Collaborator();
        $model->code = $data->code;
        $model->worked = $data->full_name;
        $model->docType = $data->type_document ?? '-';
        $model->nroDoc = $data->nro_document;
        $model->admission = $data->date_start_work;
        $model->termination = $data->concepts->firstWhere('header',Concept::DATE_TERMINATION)->value ?? '-';
        $model->type = 'Empleado';
        $model->area = $data->concepts->firstWhere('header',Concept::CODAREA)->value;
        $model->costCenter = $codeCostCenter ? $this->costCenterRepo->findCostCenterByCode($codeCostCenter,$customer)->name : '-Distribuidos-';
        $model->position = $data->concepts->firstWhere('header',Concept::NAMEAREA)->value ?? '-';
        $model->pension = $this->pensionRepo->findPensionByShort($codePension,$customer)->name;
        $model->cuspp = $data->cuspp;
        $model->codeCuspp = $data->code_cuspp;
        $model->especial = $data->especial ?? 'Ninguno';
        $model->workedDays = $data->concepts->firstWhere('header',Concept::WORKED_DAYS)->value;
        $model->lcgh = $data->concepts->firstWhere('header',Concept::LCGH)->value ?? '-';
        $model->workedNotDays = $data->concepts->firstWhere('header',Concept::WORKED_NOT_DAYS)->value ?? '-';
        $model->nroVac = $data->concepts->firstWhere('header',Concept::VACATION_DAYS)->value ?? '-';
        $model->workedHours = $data->concepts->firstWhere('header',Concept::WORKED_HOURS)->value ?? '-';
        $model->hoursExt25 = $data->concepts->firstWhere('header',Concept::HOURS_EXT25)->value ?? '-';
        $model->hoursExt35 = $data->concepts->firstWhere('header',Concept::HOURS_EXT35)->value ?? '-';
        $model->remuneration = $data->concepts->firstWhere('header',Concept::BASIC_SALARY)->value ?? '-';
        $model->income = $income;
        $model->expense = $expense;
        $model->contribution = $contribution;
        $model->net = $data->concepts->firstWhere('header',Concept::NETO)->value;

       /* return view('pdf.voucher',[
            'customer' => $this->customerRepo->findCustomerById($customer),
            'payroll' => $this->fileRepo->findFileById($file),
            'data'  => $model
        ]);*/

        $fileModel = $this->fileRepo->findFileById($file);
         $pdf = PDF::loadView('pdf.voucher',[
             'customer' => $this->customerRepo->findCustomerById($customer),
             'payroll' => $fileModel,
             'data'  => $model
         ]);

         $employeeName = strtoupper(slug($data->full_name,'-'));
         $month = strtoupper($fileModel->name);
         $fileName = "BOLETA-$month-$employeeName.pdf";
         return $pdf->download($fileName);
    }

}
