<?php


namespace App\Http\Controllers\Admin\Customers;


use App\AsientoContable\AccountsHeaders\AccountHeader;
use App\AsientoContable\BaseHeaders\BaseHeader;
use App\AsientoContable\Customers\Customer;
use App\AsientoContable\Customers\Requests\CustomerRequest;
use App\AsientoContable\Customers\Requests\StoreCustomerRequest;
use App\AsientoContable\Customers\Requests\UpdateCustomerRequest;
use App\AsientoContable\HeaderAccountingsAccount\HeaderAccount;
use App\Http\Controllers\Controller;
use App\AsientoContable\Customers\Repositories\ICustomer;

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

    public function create()
    {
        return view('admin.customers.create', ['model' => new Customer()]);
    }

    public function store(CustomerRequest $request)
    {
        $customer = $this->customerRepo->createCustomer($request->all());
        BaseHeader::all()->each(function ($item,$key) use ($customer) {
           AccountHeader::create([
               'name'         => $item->header,
               'name_slug'    => $item->header_slug,
               'customer_id'  => $customer->id,
               'order'        => $item->order,
               'is_required'  => $item->is_required,
               'show'         => $item->show,
               'name_account_slug' => HeaderAccount::firstWhere('slug',$item->account_slug)->name ?? '',
               'account_slug' => $item->account_slug,
           ]);
        });
        return redirect()->route('admin.customers.index')->with('message',"Cliente creado");
    }

    public function edit(int $id)
    {
        return view('admin.customers.edit', ['model' => $this->customerRepo->findCustomerById($id)]);
    }

    public function update(CustomerRequest $request, int $id)
    {
        if (isset($request->is_active))
            $request->merge(['is_active' => 1]);
        else
            $request->merge(['is_active' => 0]);

        $this->customerRepo->updateCustomer($request->all(),$id);
        return redirect()->route('admin.customers.index')->with('message',"Cliente actualizado");
    }

    public function destroy(int $id)
    {
        $this->customerRepo->deleteCustomer($id);
        return redirect()->route('admin.customers.index')->with('message',"Cliente desactivado");
    }

}
