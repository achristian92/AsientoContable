<?php


namespace App\Http\Controllers;

use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\Base\BaseHeader;
use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\CenterCosts\Repositories\ICenterCost;
use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Collaborators\Repositories\ICollaborator;
use App\AsientoContable\ConceptAccounts\ConceptAccount;
use App\AsientoContable\ConceptAccounts\Repositories\IConceptAccount;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\Concepts\Transformations\ConceptTrait;
use App\AsientoContable\Currencies\Currency;
use App\AsientoContable\Customers\Customer;
use App\AsientoContable\Customers\Repositories\ICustomer;
use App\AsientoContable\Employees\AccountingSeating\Repositories\ISeating;
use App\AsientoContable\Employees\AccountingSeating\Seating;
use App\AsientoContable\Employees\CostEmployees\Repositories\ICostEmployee;
use App\AsientoContable\Files\File;
use App\AsientoContable\Files\Repositories\IFile;
use App\AsientoContable\Headers\Header;
use App\AsientoContable\Headers\Repositories\IHeader;
use App\AsientoContable\PensionFund\PensionFund;
use App\AsientoContable\PensionFund\Repositories\IPensionFund;
use App\AsientoContable\Tools\NestedsetTrait;
use App\Models\Setting;
use Arr;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;
use GuzzleHttp\Client;

class TestController extends Controller
{
    use NestedsetTrait, ConceptTrait;

    private $companyRepo, $terms, $userRepo, $conceptRepo, $headerRepo, $costEmployee, $fileRepo, $seatRepo, $employeeRepo;
    private $customerRepo, $costCenterRepo, $pensionRepo, $conceptAccountRepo;

    public function __construct(IConceptAccount $IConceptAccount, IPensionFund $IPensionFund, ICenterCost $ICenterCost, ICustomer $ICustomer, ICollaborator $ICollaborator, ISeating $ISeating, IFile $IFile, IConcept $IConcept, IHeader $IHeader, ICostEmployee $ICostEmployee)
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
        $this->conceptAccountRepo = $IConceptAccount;
    }

    public function __invoke(Request $request, int $customer)
    {
//        $seating  = Seating::where('file_id',82)->get()->unique('nro_documento')->pluck('nro_documento');
//        $concep = Concept::where('file_id',82)->get()->unique('collaborator_id')->pluck('collaborator_id');
//        $colaborar = Collaborator::whereIn('id',$concep)->get()->unique('nro_document')->pluck('nro_document');
//        $diff = $colaborar->diff($seating);
//        dd($seating,$concep,$colaborar,$diff);
        //Quitar espacios
        Collaborator::all()
            ->each(function ($colaborador) {
                $colaborador->nro_document = trim($colaborador->nro_document);
                $colaborador->save();
            });



        $collaborator = Collaborator::where('customer_id',$customer)->get()
            ->transform(function ($collaborator) {
                return [
                    'id' => $collaborator->id,
                    'nro' => trim($collaborator->nro_document),
                    'name' => $collaborator->full_name
                ];
            });

        $duplicados = collect($collaborator)->duplicates('nro')->values();

        foreach ($duplicados as $duplicado) {
            $employe = Collaborator::where('customer_id',$customer)->where('nro_document',$duplicado)->latest()->first();
            $employe->delete();
        }

        dd("limpiado");

    }

}
