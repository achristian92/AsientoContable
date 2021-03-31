<?php


namespace App\AsientoContable\Concepts\Repositories;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\ConceptAccounts\ConceptAccount;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Concepts\Transformations\ConceptTrait;
use App\AsientoContable\Employees\CostEmployees\Repositories\CostEmployeeRepo;
use App\AsientoContable\Employees\MonthCosts\MonthCost;
use App\AsientoContable\Files\File;
use App\AsientoContable\PensionFund\PensionFund;
use App\AsientoContable\PensionFund\PensionTrait;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

class ConceptRepo extends BaseRepository implements IConcept
{
    use ConceptTrait, PensionTrait;

    public function model()
    {
        return Concept::class;
    }

    public function showConceptCollaboratorList(int $file_id): array
    {
        $collaboratorIDS = $this->employeeIDS($file_id);
        $pensionsFund = PensionFund::all();
        $concepts = $this->employeeConcepts($collaboratorIDS,$file_id);

        return $concepts->map(function ($collaboratorConcept) use ($pensionsFund) {
            return $lists[] = $this->generalConceptCollaborator($collaboratorConcept,$pensionsFund);
        })->toArray();
    }

    public function detailConceptCollaborator(int $file_id, int $collaborator_id): array
    {
        $filters = [
            'file_id'=> $file_id,
            'collaborator_id'=> $collaborator_id
        ];
        $collection = $this->model::where($filters)->get();
        $accounts = $this->accounts($filters);
        return [
            'info'        => $this->basicInfo($collection),
            'costs'       => $this->basicCosts($collection),
            'costCenters' => $this->costCenterEmployee($filters),
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

    public function costCenterEmployee($filters): array
    {
        $concept = Concept::where($filters)->get();
        $centerCostCode = $concept->firstWhere('header',Concept::COSTCENTER)->value;
        if ($centerCostCode)
            return $this->oneCenterCost($centerCostCode);

        return $this->manyCenterCost($filters);

    }
    public function oneCenterCost($code): array
    {
        $costCenter = Cost::firstWhere('code',$code);
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
        $fileMonth = File::find($filters['file_id'])->name;
        $monthCost = MonthCost::firstWhere('name',$fileMonth);
        if (!$monthCost)
            return [];

        $costEmployee = resolve(CostEmployeeRepo::class);
        return $costEmployee->listCostEmployees($filters['collaborator_id'],$monthCost['id'])->toArray();
    }


}
