<?php


namespace App\Http\Controllers;


use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\ConceptAccounts\ConceptAccount;
use App\AsientoContable\Concepts\Repositories\IConcept;
use App\AsientoContable\Employees\CostEmployees\CostEmployee;
use App\AsientoContable\Employees\MonthCosts\MonthCost;
use App\AsientoContable\Headers\Repositories\IHeader;
use App\AsientoContable\Payrolls\Transformations\PayrollTransformable;
use App\AsientoContable\Tools\NestedsetTrait;


class TestController extends Controller
{
    use NestedsetTrait, PayrollTransformable;

    private $companyRepo;
    private $terms;
    private $userRepo;
    private $conceptRepo;
    private $headerRepo;

    public function __construct(IConcept $IConcept,IHeader $IHeader)
    {
        $this->conceptRepo = $IConcept;
        $this->headerRepo = $IHeader;
    }

    public function __invoke()
    {
        $another = MonthCost::with('assigns','assigns.employee','assigns.cost')->find(13);
        $result = $another->assigns->transform(function ($item) {
            $model = new CostEmployee();
            $model->worked = $item->employee->full_name;
            $model->cost = $item->cost->name;
            $model->percentage = $item->percentage;
            return $model;
        })->groupBy('worked')
          ->transform(function ($group) {
              return [
                  'worked' => $group->first()->worked,
                  'qtyCosts' => $group->count(),
                  'total'   => $group->sum('percentage')
              ];
          })->values();

        dd($result);

    }

    private function accounts()
    {
        $filters = [
            'collaborator_id' => 11,
            'file_id' => 1,
            'customer_id' => 1
        ];

        return ConceptAccount::where($filters)
                ->get()
                ->transform(function ($item) {
                    $account = json_decode($item->account);
                    return [
                        'concept' => $item->header,
                        'nroAccount' => $account->code,
                        'account' => $account->name,
                        'value' => $item->value
                    ];
                });
    }


}
