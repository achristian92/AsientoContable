<?php


namespace App\Http\Controllers\Admin\PensionsFund;


use App\AsientoContable\AccountPlan\Repositories\IAccountPlan;
use App\AsientoContable\PensionFund\PensionFund;
use App\AsientoContable\PensionFund\Repositories\IPensionFund;
use App\AsientoContable\PensionFund\Requests\PensionFundRequest;
use App\Http\Controllers\Controller;

class PensionFundController extends Controller
{
    private $pensionRepo,$accountRepo;

    public function __construct(IPensionFund $IPensionFund,IAccountPlan $IAccountPlan)
    {
        $this->pensionRepo = $IPensionFund;
        $this->accountRepo = $IAccountPlan;
    }

    public function index()
    {
        return view('customers.pension-fund.index',[
            'pensions' => $this->pensionRepo->listPensionsFund()
        ]);
    }

    public function create()
    {
        return view('customers.pension-fund.create',[
            'model' => new PensionFund(),
            'accounts' => $this->accountRepo->listAccountsAnalitica()
        ]);
    }

    public function store(PensionFundRequest $request,int $customer)
    {
        $this->pensionRepo->createPensionFund($request->all());
        return redirect()->route('admin.customers.pensions.index',$customer)->with('message',"Registro creado");
    }

    public function edit(int $customer, int $id)
    {
        return view('customers.pension-fund.edit',[
            'model' => $this->pensionRepo->findPensionById($id),
            'accounts' => $this->accountRepo->listAccountsAnalitica()
        ]);
    }

    public function update(PensionFundRequest $request,int $customer,int $id)
    {
        $this->pensionRepo->updatePensionFund($request->all(),$id);
        return redirect()->route('admin.customers.pensions.index',$customer)->with('message',"Registro actualizado");
    }

}
