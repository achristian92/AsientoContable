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
        $aaa = 'FFFF';
       dd(Str::length($aaa));
        $file = Customer::all()->map(function ($customer,$key) {
            return $item[$key]     = strlen($customer->name);
        });
        dd($file);
        $oldCustomerId = 2;
        $newCustomerId = 4;
        AccountPlan::where('customer_id',$oldCustomerId)->get()
                ->each(function ($plan) use ($newCustomerId) {
                    $plan['customer_id'] = $newCustomerId;
                    $plan['from_id'] = $plan->id;
                    $plan['updated_at'] = now();
                    $plan['created_at'] = now();
                    AccountPlan::create($plan->toArray());
                });

        $newPlan = AccountPlan::where('customer_id',$newCustomerId)->get();

        Header::where('customer_id',$oldCustomerId)->get()
                ->each(function ($plan) use ($newCustomerId,$newPlan) {
                    $idNewPlan = null;
                    if ($plan->account_plan_id)
                        $idNewPlan = $newPlan->firstWhere('from_id',$plan->account_plan_id)->id;

                    $plan['account_plan_id'] = $idNewPlan;
                    $plan['customer_id'] = $newCustomerId;
                    $plan['created_at'] = now();
                    $plan['updated_at'] = now();
                    Header::create($plan->toArray());
                });
        PensionFund::where('customer_id',$oldCustomerId)->get()
                ->each(function ($pension) use ($newCustomerId,$newPlan) {
                    $idNewPlan = null;
                    if ($pension->account_plan_id)
                        $idNewPlan = $newPlan->firstWhere('from_id',$pension->account_plan_id)->id;

                    $pension['account_plan_id'] = $idNewPlan;
                    $pension['customer_id'] = $newCustomerId;
                    $pension['created_at'] = now();
                    $pension['updated_at'] = now();
                    PensionFund::create($pension->toArray());
                });

        dd("end");
    }

    public function dataOC()
    {
       $model = new Customer();
       $model->supplier = 'Coorporación Wong';
       return $model;
    }
}
