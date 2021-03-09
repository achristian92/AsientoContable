<?php


namespace App\Http\Controllers\Admin\CostCenter;


use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\CenterCosts\Repositories\ICenterCost;
use App\AsientoContable\CenterCosts\Requests\CenterCostRequest;
use App\AsientoContable\CostsCenter2\Repositories\ICenterCost2;
use App\AsientoContable\CostsCenter2\Requests\CostCenter2Request;
use App\Http\Controllers\Controller;

class CostCenter2Controller extends Controller
{

    private $centerCost2Repo;

    public function __construct(ICenterCost2 $ICenterCost2)
    {
        $this->centerCost2Repo = $ICenterCost2;
    }

    public function index()
    {
        return view('customers.cost-center2.index',[
            'centerCosts' => $this->centerCost2Repo->listCostsCenter2()
        ]);
    }

    public function create()
    {
        return view('customers.cost-center2.create',[
            'model' => new Cost(),
        ]);
    }

    public function store(CostCenter2Request $request,$customer_id)
    {
        $this->centerCost2Repo->createCostCenter2($request->all());
        return redirect()->route('admin.customers.cost-center2.index',$customer_id)->with('message',"Registro creado");
    }

    public function show()
    {

    }

    public function edit($customer_id,int $id)
    {
        return view('customers.cost-center2.edit',[
            'model' => $this->centerCost2Repo->findCostCenter2ById($id),
        ]);
    }

    public function update(CostCenter2Request $request,$customer_id,$id)
    {
        $this->centerCost2Repo->updateCostCenter2($request->all(),$id);
        return redirect()->route('admin.customers.cost-center2.index',[$customer_id])->with('message',"Registro actualizado");
    }

}
