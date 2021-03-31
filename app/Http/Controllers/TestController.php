<?php


namespace App\Http\Controllers;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\ConceptAccounts\ConceptAccount;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\Employees\CostEmployees\CostEmployee;
use App\AsientoContable\Employees\CostEmployees\Repositories\ICostEmployee;
use App\AsientoContable\Employees\MonthCosts\MonthCost;
use App\AsientoContable\Files\File;
use App\AsientoContable\Headers\Repositories\IHeader;
use App\AsientoContable\Tools\NestedsetTrait;
use Carbon\Carbon;


class TestController extends Controller
{
    use NestedsetTrait;

    private $companyRepo;
    private $terms;
    private $userRepo;
    private $conceptRepo;
    private $headerRepo;
    private $costEmployee;

    public function __construct(IConcept $IConcept,IHeader $IHeader,ICostEmployee $ICostEmployee)
    {
        $this->conceptRepo = $IConcept;
        $this->headerRepo = $IHeader;
        $this->costEmployee = $ICostEmployee;
    }

    public function __invoke()
    {
        $filters = [
            'collaborator_id' => 1,
            'file_id' => 1,
        ];

        $employeeIDS = $this->conceptRepo->employeeIDS($filters['file_id']);
        $file = File::find($filters['file_id']);
        $payrollDate = Carbon::parse($file->created_at);

        $data = $employeeIDS->map(function ($id) use ($file,$payrollDate) {
            $employee  = Collaborator::find($id);
            return [
                'worked' => $employee->full_name,
                'nroDoc' => $employee->nro_document,
                'createdAt' => $payrollDate->format('d/m/y'),
                'accounts' => $this->conceptRepo->accounts(['file_id'=> $file->id, 'collaborator_id'=> $id])->toArray(),
                'costCenters' => $this->conceptRepo->costCenterEmployee(['file_id'=> $file->id, 'collaborator_id'=> $id])
            ];
        });

        $onlyCenterCost = collect($data)->filter(function ($employee) {
            return  count($employee['costCenters']) > 0;
        });

        $accountingSeat = collect($data)->map(function ($employee) {
            if (count($employee['costCenters']) === 1) {
                return collect($employee['accounts'])->transform(function ($account) {

                });
            } else {

            }
        });

        dd($onlyCenterCost,$accountingSeat);

        $exchangeRate = 3.76;
        $total = $allAccountings->map(function ($conceptAccount,$key) use($payrollDate, $exchangeRate) {
            $account = json_decode($conceptAccount->account);
            $isExpense = $account->type === AccountPlan::TYPE_EXPENSE;
            $penValue = $conceptAccount->value;
            $USDValue = $penValue/$exchangeRate;

            return [
                'subdiario'  => '07',
                'nroAsiento' => $key+1,
                'lRegistro' => 31,
                'fechaRegistro' => $payrollDate->format('d/m/y'),
                'mes' => $payrollDate->format('m'),
                'cuenta' => $account->code,
                'debePEN' => $isExpense ? $penValue : '-',
                'haberPEN' => !$isExpense ? $penValue : '-',
                'm' => 'S',
                'T/C' => $exchangeRate,
                'debeUSD' => $isExpense ? number_format($USDValue,2) : '-',
                'haberUSD' => !$isExpense ? number_format($USDValue,2) : '-',
                'glosario' => 'PL/'.substr($conceptAccount->employee->full_name,0,10).'/'.$conceptAccount->header,
                'nroDocument' => $conceptAccount->employee->nro_document,
                'NumDoc' => 'PL11000'.($key+1),
                'fechaDoc' => $payrollDate->format('d/m/y'),
                'fechaVenc' => '',
                'cost1' => ''
            ];
        });

        dd($total);

    }

    public function getEmployees()
    {

    }




}
