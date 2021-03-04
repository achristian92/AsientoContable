<?php


namespace App\Http\Controllers\Admin\CostCenter;


use App\AsientoContable\CenterCosts\CenterCost;
use App\AsientoContable\CenterCosts\Repositories\ICenterCost;
use App\AsientoContable\CenterCosts\Requests\CenterCostRequest;
use App\Http\Controllers\Controller;

class CostCenterController extends Controller
{

    private $centerCostRepo;

    public function __construct(ICenterCost $ICenterCost)
    {
        $this->centerCostRepo = $ICenterCost;
    }

    public function index()
    {
        return view('customers.cost-center.index',[
            'centerCosts' => $this->centerCostRepo->listCostsCenter()
        ]);
    }

    public function create()
    {
        return view('customers.cost-center.create',[
            'model' => new CenterCost(),
        ]);
    }

    public function store(CenterCostRequest $request,$customer_id)
    {
        $this->centerCostRepo->createCostCenter($request->all());
        return redirect()->route('admin.customers.cost-center.index',$customer_id)->with('message',"Registro creado");
    }

    public function show()
    {

    }

    public function edit($customer_id,int $id)
    {
        return view('customers.cost-center.edit',[
            'model' => $this->centerCostRepo->finCostCenterById($id),
        ]);
    }

    public function update(CenterCostRequest $request,$customer_id,$id)
    {
        $this->centerCostRepo->updateCostCenter($request->all(),$id);
        return redirect()->route('admin.customers.cost-center.index',[$customer_id,'type='.$request->type])->with('message',"Registro actualizado");
    }

}
