<?php


namespace App\Http\Controllers\Front\Costs;


use App\AsientoContable\CenterCosts\Repositories\ICenterCost;
use App\Http\Controllers\Controller;

class CostController extends Controller
{
    private $costRepo;

    public function __construct(ICenterCost $ICenterCost)
    {
        $this->costRepo = $ICenterCost;
    }
    public function __invoke(int $customer): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'costs' => $this->costRepo->listCostsCenter(['id','code','name']),
        ]);
    }

}
