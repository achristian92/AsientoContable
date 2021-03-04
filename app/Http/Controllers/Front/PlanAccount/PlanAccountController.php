<?php


namespace App\Http\Controllers\Front\PlanAccount;


use App\AsientoContable\AccountPlan\Repositories\IAccountPlan;
use App\AsientoContable\AccountPlan\Requests\AccountPlanRequest;
use App\AsientoContable\AccountPlan\Requests\StoreAccountPlanRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanAccountController extends Controller
{
    private $planAccountRepo;

    public function __construct(IAccountPlan $IAccountPlan)
    {
        $this->planAccountRepo = $IAccountPlan;
    }

    public function index(Request $request)
    {
        $subAccounts = [];

        if ($request->has('root'))
            $subAccounts = $this->planAccountRepo->listSubPlanAccountByRoot($request->root);

        return response()->json([
            'accounts' => $this->planAccountRepo->listPlanAccountRoot(),
            'subAccounts' => $subAccounts
        ]);
    }
    public function store(AccountPlanRequest $request)
    {
        $this->planAccountRepo->createPlanAccount($request->all());

        return response()->json(['msg' => 'Cuenta contable creada'],201);
    }

    public function update(AccountPlanRequest $request,$customer_id,int $id)
    {
        $this->planAccountRepo->updatePlanAccount($request->all(),$id);

        return response()->json(['msg' => 'Cuenta contable actualizada'],201);
    }

    public function destroy(int $customer_id,int $id)
    {
        return response()->json(['msg' => 'Cuenta contable eliminada']);
    }

}
