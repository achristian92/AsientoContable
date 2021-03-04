<?php


namespace App\Http\Controllers;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\PensionFund\PensionFund;
use App\AsientoContable\Tools\NestedsetTrait;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    use NestedsetTrait;

    private $companyRepo;
    private $terms;
    private $userRepo;

    public function __construct()
    {


    }

    public function __invoke()
    {
        $data = Carbon::parse("2021-03");
        $month = $data->monthName;
        $year = $data->year;
        $day = $data->day;
        dd($data,$month,$year,$day);
    }


}
