<?php


namespace App\Http\Controllers\Admin\Headers;


use App\AsientoContable\AccountPlan\Repositories\IAccountPlan;
use App\AsientoContable\AccountsHeaders\AccountHeader;
use App\AsientoContable\AccountsHeaders\Requests\AccountHeaderRequest;
use App\AsientoContable\HeaderAccountingsAccount\HeaderAccount;
use App\AsientoContable\Headers\Header;
use App\AsientoContable\Headers\Repositories\IHeader;
use App\AsientoContable\Headers\Requests\HeaderRequest;
use App\Http\Controllers\Controller;
use DB;
use Str;

class HeaderController extends Controller
{
    private $accountsRepo, $headerRepo;

    public function __construct(IHeader $IHeader,IAccountPlan $IAccountPlan)
    {
        $this->headerRepo = $IHeader;
        $this->accountsRepo = $IAccountPlan;
    }

    public function index(int $customer_id)
    {
        return view('customers.headers.index',[
            'headers' => $this->headerRepo->listHeadersAll()
        ]);
    }

    public function create()
    {
        $model = new Header();
        $model->order = Header::getNextOrderNumber();
        return view('customers.headers.create',[
            'model' => $model,
            'accounts' => $this->accountsRepo->listAccountsAnalitica(),
            'types' => Header::HEADER_TYPES
        ]);
    }
    public function edit($customer_id,$id)
    {


        return view('customers.headers.edit',[
            'model' => $this->headerRepo->findHeaderById($id),
            'accounts' => $this->accountsRepo->listAccountsAnalitica(),
            'types' => Header::HEADER_TYPES
        ]);
    }

    public function store(HeaderRequest $request,$customer_id)
    {
        if ( $request->filled('account_plan_id') && $request->input('is_account_main') == "1") {
            $headerUniqueMain = Header::where('account_plan_id',$request->account_plan_id)
                ->where('is_account_main',1)
                ->whereCustomerId(customerID())
                ->count();
            if ( $headerUniqueMain > 0 )
                return redirect()->back()->with('error',"Cuenta contable ya está en uso de modo principal(selecciona modo secundaria)");
        }

        $this->headerRepo->createHeader($request->all());
        return redirect()->route('admin.customers.headers.index',$customer_id)->with('message',"Registro creado");
    }

    public function update(HeaderRequest $request,$customer_id,$id)
    {
        if ( $request->filled('account_plan_id') && $request->input('is_account_main') == "1") {
            $headerUniqueMain = Header::where('account_plan_id',$request->account_plan_id)
                ->where('is_account_main',1)
                ->whereCustomerId(customerID())
                ->count();
            if ( $headerUniqueMain > 0 )
                return redirect()->back()->with('error',"Cuenta contable ya está en uso de modo principal(selecciona modo secundaria)'");
        }


        $this->headerRepo->updateHeader($request->all(),$id);
        return redirect()->route('admin.customers.headers.index',$customer_id)->with('message',"Registro actualizado");
    }

}
