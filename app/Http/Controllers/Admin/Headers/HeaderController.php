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
            'headers' => $this->headerRepo->listHeaders()
        ]);
    }

    public function create()
    {
        return view('customers.headers.create',[
            'model' => new Header(),
            'accounts' => $this->accountsRepo->listAccountsAnalitica()
        ]);
    }
    public function edit($customer_id,$id)
    {
        return view('customers.headers.edit',[
            'model' => $this->headerRepo->findHeaderById($id),
            'accounts' => $this->accountsRepo->listAccountsAnalitica()
        ]);
    }

    public function store(HeaderRequest $request,$customer_id)
    {
        $this->headerRepo->createHeader($request->all());
        return redirect()->route('admin.customers.headers.index',$customer_id)->with('message',"Registro creado");
    }

    public function update(HeaderRequest $request,$customer_id,$id)
    {
        $this->headerRepo->updateHeader($request->all(),$id);
        return redirect()->route('admin.customers.headers.index',$customer_id)->with('message',"Registro actualizado");
    }

}
