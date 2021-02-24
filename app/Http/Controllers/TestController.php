<?php


namespace App\Http\Controllers;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\Tools\NestedsetTrait;
use App\Models\User;
use Auth;
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
        $data = AccountPlan::with('parents')->find(11);
        dd($data);
    }


}
