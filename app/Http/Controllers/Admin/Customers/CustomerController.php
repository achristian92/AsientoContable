<?php


namespace App\Http\Controllers\Admin\Customers;


use App\Http\Controllers\Controller;
use App\Voucher\Customers\Repositories\ICustomer;

class CustomerController extends Controller
{

    private $customerRepo;

    public function __construct(ICustomer $ICustomer)
    {
        $this->customerRepo = $ICustomer;
    }

    public function index()
    {
        $customers = $this->customerRepo->listCustomers();
        return view('admin.customers.index',compact('customers'));
    }

}
