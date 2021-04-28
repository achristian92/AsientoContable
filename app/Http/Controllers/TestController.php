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
use RuntimeException;
use GuzzleHttp\Client;

class TestController extends Controller
{
    use NestedsetTrait,ConceptTrait;

    private $companyRepo,$terms,$userRepo,$conceptRepo,$headerRepo,$costEmployee,$fileRepo,$seatRepo,$employeeRepo;
    private $customerRepo,$costCenterRepo,$pensionRepo,$conceptAccountRepo;

    public function __construct(IConceptAccount $IConceptAccount,IPensionFund $IPensionFund,ICenterCost $ICenterCost,ICustomer $ICustomer,ICollaborator $ICollaborator,ISeating $ISeating,IFile $IFile,IConcept $IConcept,IHeader $IHeader,ICostEmployee $ICostEmployee)
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

        $currencyu = Setting::first()->send_credentials;
        dd($currencyu);

    }

    public function transformDataToInsertMass($employee,$account,$costCenter, $nro_seat,$exchangeRate,$isVariousCost): array
    {
        $isExpense = $account['type'] === AccountPlan::TYPE_EXPENSE;

        if ($isVariousCost)
            $penValue  = (floatval($account['value']) * $costCenter['percentage']) / 100;
        else
            $penValue  = floatval($account['value']);

        $USDValue  = $penValue/$exchangeRate;

        return [
            'collaborator_id' => $employee['workedID'],
            'file_id'         => $employee['fileID'],
            'customer_id'     => $employee['customerID'],
            'cuenta_contable' => $account['nroAccount'],
            'cost'            => $employee['costCenters'][0]['code'],
            'nro_asiento'     => $nro_seat,
            'sub_diario'      => 7,
            'l_registro'      => 31,
            'fecha_registro'  => $employee['createdAt'],
            'mes'             => $employee['month'],
            'debe'            => $isExpense ? $penValue : 0,
            'haber'           => !$isExpense ? $penValue : 0,
            'moneda'          => 'S',
            'tipo_cambio'     => $exchangeRate,
            'debe_usd'        => $isExpense ? number_format($USDValue,2) : 0,
            'haber_usd'       => !$isExpense ? number_format($USDValue,2) : 0,
            'glosa_asiento'   => 'PL/'.$employee['worked'].'/'.$account['concept'],
            'nro_documento'   => $employee['nroDoc'],
            'doc'             => 'PL',
            'nro_doc'         => 'PL'.(int)$employee['month'].'000'.($nro_seat),
            'fecha_doc'       => $employee['createdAt'],
            'fecha_vencimiento' => '',
            'cost2'           => $employee['costCenters2'],
        ];
    }

    private function transformData($IDS,int $file_id)
    {
        $employees   = $this->employeeRepo->listEmployeesByWhereIn($IDS->toArray());
        $file        = $this->fileRepo->findFileById($file_id)->load('concepts');
        $payrollDate = Carbon::parse($file->created_at);
        $costs       = $this->costCenterRepo->listCostsCenter();
        $accounts    = $this->conceptAccountRepo->listAccountsByFileId($file->id);

        $data =  $IDS->map(function ($id) use ($file,$payrollDate,$employees,$costs,$accounts) {
            $employee  = $employees->firstWhere('id',$id);
            $accountEmployee = $accounts->where('collaborator_id',$id);
            return [
                'workedID'    => $employee->id,
                'fileID'      => $file->id,
                'customerID'  => $file->customer_id,
                'worked'      => substr($employee->full_name,0,10),
                'nroDoc'      => $employee->nro_document,
                'createdAt'   => $payrollDate->format('d/m/Y'),
                'month'       => $payrollDate->format('m'),
                'costCenters2'=> $file->concepts->where('header',Concept::COSTCENTER2)->where('collaborator_id',$employee->id)->first()->value,
                'accounts'    => $this->conceptRepo->accounts($accountEmployee)->toArray(),
                'costCenters' => $this->conceptRepo->costCenterEmployee($file->concepts, ['file_id'=> $file->id, 'collaborator_id'=> $id], $costs)
            ];
        });

        return $data->filter(function ($employee) {
            return  count($employee['costCenters']) > 0;
        })->values();
    }

    private function employeeIDS(Request $request): Collection
    {
        if ($request->input('all',true))
            return $this->conceptRepo->employeeIDS($request->input('file_id'));

        return collect($request->input('employeeIDS'));
    }

    public function updateFileStatus(Request $request): void
    {
        $file = File::with('concepts','seating')->find($request->input('file_id'));
        $totalConcepts = $file->concepts->unique('collaborator_id')->count();
        $totalSeating = $file->seating->unique('collaborator_id')->count();
        if ($totalConcepts === $totalSeating) {
            $file->status = File::STATUS_CLOSE;
            $file->save();
        }
    }
}
