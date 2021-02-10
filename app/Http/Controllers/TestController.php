<?php


namespace App\Http\Controllers;


use App\Models\User;
use App\Voucher\Companies\Company;
use App\Voucher\Companies\Repositories\ICompany;
use App\Voucher\Currencies\Currency;
use App\Voucher\Customers\Customer;
use App\Voucher\Providers\Provider;
use App\Voucher\TermsPayment\Repositories\ITermPayment;
use App\Voucher\Users\Repositories\IUser;
use Auth;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    private $companyRepo;
    private $terms;
    private $userRepo;

    public function __construct(ICompany  $ICompany, ITermPayment $ITermPayment,IUser $IUser)
    {
        $this->companyRepo = $ICompany;
        $this->terms = $ITermPayment;
        $this->userRepo = $IUser;
    }

    public function __invoke()
    {
        $user = User::find(1);
        $this->userRepo->sendEmailNewCredentials($user);


    }

}
