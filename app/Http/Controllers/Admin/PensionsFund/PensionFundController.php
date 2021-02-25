<?php


namespace App\Http\Controllers\Admin\PensionsFund;


use App\AsientoContable\PensionFund\PensionFund;
use App\AsientoContable\PensionFund\Repositories\IPensionFund;
use App\AsientoContable\PensionFund\Requests\PensionFundRequest;
use App\Http\Controllers\Controller;

class PensionFundController extends Controller
{
    private $pensionRepo;

    public function __construct(IPensionFund $IPensionFund)
    {
        $this->pensionRepo = $IPensionFund;
    }

    public function index()
    {
        return view('admin.pension-fund.index',[
            'pensions' => $this->pensionRepo->listPensionsFund()
        ]);
    }

    public function create()
    {
        return view('admin.pension-fund.create',[
            'model' => new PensionFund()
        ]);
    }

    public function store(PensionFundRequest $request)
    {
        $this->pensionRepo->createPensionFund($request->all());
        return redirect()->route('admin.pensions.index')->with('message',"Registro creado");
    }

    public function edit(int $id)
    {
        return view('admin.pension-fund.edit',[
            'model' => $this->pensionRepo->findPensionById($id)
        ]);
    }

    public function update(PensionFundRequest $request,int $id)
    {
        $this->pensionRepo->updatePensionFund($request->all(),$id);
        return redirect()->route('admin.pensions.index')->with('message',"Registro actualizado");
    }

}
