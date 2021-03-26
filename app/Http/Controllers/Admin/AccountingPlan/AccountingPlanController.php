<?php


namespace App\Http\Controllers\Admin\AccountingPlan;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\AccountPlan\Repositories\IAccountPlan;
use App\AsientoContable\HeaderAccountingsAccount\HeaderAccount;
use App\AsientoContable\Tools\NestedsetTrait;
use App\Http\Controllers\Controller;

class AccountingPlanController extends Controller
{
    use NestedsetTrait;
    private $accountRepo;

    public function __construct(IAccountPlan $IAccountPlan)
    {
        $this->accountRepo = $IAccountPlan;
    }

    public function index()
    {
        return view('customers.accounting-plan.index',[
            'data' => $this->accountRepo->listPlanAccountNested()
        ]);
    }

    public function create()
    {
        return view('customers.accounting-plan.create',[
            'headers' => HeaderAccount::all()
        ]);
    }

    public function edit($customer_id, $account_id)
    {
        return view('customers.accounting-plan.edit', [
            'model' => $this->accountRepo->findPlanAccountById($account_id)->load('parents'),
            'headers' => HeaderAccount::all()
        ]);
    }


}
