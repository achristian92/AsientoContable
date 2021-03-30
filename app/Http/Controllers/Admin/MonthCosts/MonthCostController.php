<?php


namespace App\Http\Controllers\Admin\MonthCosts;


use App\AsientoContable\Employees\CostEmployees\CostEmployee;
use App\AsientoContable\Employees\MonthCosts\MonthCost;
use App\AsientoContable\Employees\MonthCosts\Repositories\IMonthCost;
use App\AsientoContable\Employees\MonthCosts\Requests\MonthCostRequest;
use App\Http\Controllers\Controller;

class MonthCostController extends Controller
{
    private $monthRepo;

    public function __construct(IMonthCost $IMonthCost)
    {
        $this->monthRepo = $IMonthCost;
    }

    public function index()
    {
        $months = MonthCost::with('assigns')->orderBy('id','desc')->get();
        return view('customers.collaborators.month-costs.index',compact('months'));
    }

    public function store(MonthCostRequest $request,int $customer): \Illuminate\Http\RedirectResponse
    {
        $month = $this->monthRepo->createMonthCost($request->only('month'));
        return redirect()->route('admin.customers.month-costs.show',[$customer,$month->id]);
    }

    public function show(int $customer, int $month)
    {
        return view('customers.collaborators.assign-costs.index',[
            'months' => MonthCost::with('assigns')->orderBy('id','desc')->get(),
            'month' => $this->monthRepo->findMonthCostById($month),
            'assigns' => $this->monthRepo->listAssigns($month)
        ]);
    }

}
