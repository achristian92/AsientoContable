<?php


namespace App\AsientoContable\Concepts\Repositories;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\ConceptAccounts\ConceptAccount;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Concepts\Transformations\ConceptTrait;
use App\AsientoContable\Employees\CostEmployees\Repositories\CostEmployeeRepo;
use App\AsientoContable\PensionFund\PensionFund;
use App\AsientoContable\PensionFund\PensionTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class ConceptRepo extends BaseRepository implements IConcept
{
    use ConceptTrait, PensionTrait;

    public function model(): string
    {
        return Concept::class;
    }

    public function showConceptCollaboratorList(int $file_id): array
    {
        $collaboratorIDS = $this->employeeIDS($file_id);
        $pensionsFund = PensionFund::where('customer_id',customerID())->get();
        $concepts = $this->employeeConcepts($collaboratorIDS,$file_id);
        $costs = Cost::where('customer_id',customerID())->get();
        return $concepts->map(function ($collaboratorConcept) use ($pensionsFund,$costs) {
            $filters = [
                'file_id'=> $collaboratorConcept->first()->file_id,
                'collaborator_id'=> $collaboratorConcept->first()->collaborator_id
            ];
            $data = $this->generalConceptCollaborator($collaboratorConcept,$pensionsFund);
            $data['centerCost'] = $this->costCenterEmployee($collaboratorConcept,$filters,$costs);

            return $data;
        })->values()->toArray();
    }

    public function detailConceptCollaborator(int $file_id, int $collaborator_id): array
    {
        $filters = [
            'file_id'=> $file_id,
            'collaborator_id'=> $collaborator_id
        ];
        $collection = $this->model::where($filters)->get();
        $accounts = $this->accounts($filters);
        $costs = Cost::where('customer_id',customerID())->get();
        return [
            'info'        => $this->basicInfo($collection),
            'costs'       => $this->basicCosts($collection),
            'costCenters' => $this->costCenterEmployee($collection,$filters,$costs),
            'concepts'    => $collection,
            'accounts'    => $accounts,
            'totalMust'   => number_format($accounts->where('type',AccountPlan::TYPE_EXPENSE)->sum('value'),2),
            'totalHas'    => number_format($accounts->where('type',AccountPlan::TYPE_PASIVE)->sum('value'),2)
        ];
    }
    public function accounts(array $filters)
    {
        return ConceptAccount::where($filters)
            ->get()
            ->transform(function ($item) {
                $account = json_decode($item->account);
                return [
                    'concept'    => $item->header,
                    'nroAccount' => $account->code,
                    'account'    => $account->name,
                    'type'       => $account->type,
                    'value'      => $item->value,
                ];
            })->where('value','!==',"0");
    }

    public function employeeConcepts($employeeIDS,$file_id)
    {
        return $this->model::whereIn('collaborator_id',$employeeIDS)
            ->where('file_id',$file_id)
            ->get()
            ->groupBy('collaborator_id');
    }
    public function employeeIDS($file_id)
    {
        return $this->model::where('file_id',$file_id)
            ->get()
            ->pluck('collaborator_id')->unique();
    }

    public function costCenterEmployee(Collection $collection, $filters,$costs): array
    {
        $centerCostCode = $collection->firstWhere('header',Concept::COSTCENTER)->value;
        if ($centerCostCode)
            return $this->oneCenterCost($costs,$centerCostCode);

        return $this->manyCenterCost($filters);

    }
    public function oneCenterCost($costs,$code): array
    {
        $costCenter = $costs->firstWhere('code',$code);
        return  [
            [
                'code' => $costCenter->code,
                'cost' => $costCenter->name,
                'percentage' => '100',
            ]
        ];
    }
    public function manyCenterCost(array $filters): array
    {
        $costEmployee = resolve(CostEmployeeRepo::class);
        return $costEmployee->listCostEmployees($filters['collaborator_id'],$filters['file_id'])->toArray();
    }


}
