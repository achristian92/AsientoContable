<?php


namespace App\Http\Controllers\Front\AssignCosts;


use App\AsientoContable\Employees\CostEmployees\CostEmployee;
use App\AsientoContable\Employees\CostEmployees\Repositories\ICostEmployee;
use App\AsientoContable\Employees\CostEmployees\Requests\CostEmployeeRequest;
use App\AsientoContable\Employees\CostEmployees\Transformations\CostEmployeeTrait;
use App\Http\Controllers\Controller;

class AssignCostController extends Controller
{
    use CostEmployeeTrait;
    private $costEmployeeRepo;

    public function __construct(ICostEmployee $ICostEmployee)
    {
        $this->costEmployeeRepo = $ICostEmployee;
    }
    public function store(CostEmployeeRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->costEmployeeRepo->createCostEmployee($request->all());
        $assign = $this->costEmployeeRepo->listCostEmployees($request->collaborator_id,$request->file_id);

        return response()->json([
            'assign' => $this->transformAgroupCostEmployee($assign),
            'msg'  => 'Registro actualizado'
        ]);
    }

    public function show(int $customer, int $employee): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'assigns' => $this->costEmployeeRepo->listCostEmployees($employee,request()->input('file_id'))                                    ,
        ]);
    }

    public function edit(int $customer, int $employee)
    {
        return response()->json([
            'collaborator_id' => $employee,
            'file_id' => request()->input('file_id'),
            'assigns' => CostEmployee::where('collaborator_id',$employee)->where('file_id',request()->input('file_id'))->get()
        ]);
    }

    public function destroy(int $customer, int $id)
    {
        $cost = CostEmployee::find($id);
        $cost->delete();
        return response()->json([
            'msg' => 'Eliminó la asignación'                                    ,
        ]);
    }

}
