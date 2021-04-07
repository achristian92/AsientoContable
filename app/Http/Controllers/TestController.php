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
use App\AsientoContable\Employees\AccountingSeating\Seating;
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

        $data = Seating::getNextSeatNumber(1,1);
        dd($data);

    }





}
