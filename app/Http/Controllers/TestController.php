<?php


namespace App\Http\Controllers;

use App\AsientoContable\CenterCosts\Repositories\ICenterCost;
use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Collaborators\Repositories\ICollaborator;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\Concepts\Transformations\ConceptTrait;
use App\AsientoContable\Customers\Repositories\ICustomer;
use App\AsientoContable\Employees\AccountingSeating\Repositories\ISeating;
use App\AsientoContable\Employees\CostEmployees\Repositories\ICostEmployee;
use App\AsientoContable\Files\Repositories\IFile;
use App\AsientoContable\Headers\Header;
use App\AsientoContable\Headers\Repositories\IHeader;
use App\AsientoContable\PensionFund\Repositories\IPensionFund;
use App\AsientoContable\Tools\NestedsetTrait;
use Barryvdh\DomPDF\Facade as PDF;


class TestController extends Controller
{
    use NestedsetTrait,ConceptTrait;

    private $companyRepo,$terms,$userRepo,$conceptRepo,$headerRepo,$costEmployee,$fileRepo,$seatRepo,$employeeRepo;
    private $customerRepo,$costCenterRepo,$pensionRepo;

    public function __construct(IPensionFund $IPensionFund,ICenterCost $ICenterCost,ICustomer $ICustomer,ICollaborator $ICollaborator,ISeating $ISeating,IFile $IFile,IConcept $IConcept,IHeader $IHeader,ICostEmployee $ICostEmployee)
    {
        $this->pensionRepo = $IPensionFund;
        $this->costCenterRepo = $ICenterCost;
        $this->customerRepo = $ICustomer;
        $this->employeeRepo = $ICollaborator;
        $this->seatRepo = $ISeating;
        $this->fileRepo = $IFile;
        $this->conceptRepo = $IConcept;
        $this->headerRepo = $IHeader;
        $this->costEmployee = $ICostEmployee;
    }

    public function __invoke(int $customer)
    {
        $file     = 1;
        $employee = 1;

        $headerIncome = Header::where('customer_id',$customer)->where('type',Header::TYPE_INCOME)->get()->pluck('name');
        $headerExpense = Header::where('customer_id',$customer)->where('type',Header::TYPE_EXPENSE)->get()->pluck('name');
        $headerContribution = Header::where('customer_id',$customer)->where('type',Header::TYPE_CONTRIBUTION)->get()->pluck('name');

        $employee = Collaborator::with(['concepts'=> function($query) use ($file) {
            return $query->where('file_id',$file);
        }])->find($employee);

        $income = $employee->concepts->whereIn('header',$headerIncome)
                    ->filter(function ($concept) {
                        return $concept->value;
                    });
        $expense = $employee->concepts->whereIn('header',$headerExpense)
            ->filter(function ($concept) {
                return $concept->value;
            });
        $contribution = $employee->concepts->whereIn('header',$headerContribution)
            ->filter(function ($concept) {
                return $concept->value;
            });

        $codeCostCenter = $employee->concepts->firstWhere('header',Concept::COSTCENTER);
        $codePension = $employee->concepts->firstWhere('header',Concept::PENSION_SHORT)->value;
        $model = new Collaborator();
        $model->code = $employee->code;
        $model->worked = $employee->full_name;
        $model->docType = $employee->type_document ?? '-';
        $model->nroDoc = $employee->nro_document;
        $model->admission = $employee->date_start_work;
        $model->termination = $employee->concepts->firstWhere('header',Concept::DATE_TERMINATION)->value ?? '-';
        $model->type = 'Empleado';
        $model->area = $employee->concepts->firstWhere('header',Concept::AREA)->value;
        $model->costCenter = $codeCostCenter ? $this->costCenterRepo->findCostCenterByCode($codeCostCenter->value,1)->name : '-';
        $model->position = $employee->concepts->firstWhere('header',Concept::POSITION)->value ?? '-';
        $model->pension = $this->pensionRepo->findPensionByShort($codePension,1)->name;
        $model->pension = $this->pensionRepo->findPensionByShort($codePension,1)->name;
        $model->workedDays = $employee->concepts->firstWhere('header',Concept::WORKED_DAYS)->value;
        $model->workedHours = $employee->concepts->firstWhere('header',Concept::WORKED_HOURS)->value;
        $model->remuneration = $employee->concepts->firstWhere('header',Concept::BASIC_SALARY)->value;
        $model->income = $income;
        $model->expense = $expense;
        $model->contribution = $contribution;
        $model->net = $employee->concepts->firstWhere('header',Concept::NET)->value;

       return view('pdf.voucher',[
            'customer' => $this->customerRepo->findCustomerById($customer),
            'payroll' => $this->fileRepo->findFileById($file),
            'data'  => $model
        ]);

       /* $pdf = PDF::loadView('pdf.voucher',[
            'customer' => $this->customerRepo->findCustomerById($customer),
            'payroll' => $this->fileRepo->findFileById(3),
            'data'  => $model
        ]);
        return $pdf->stream();*/
    }





}
