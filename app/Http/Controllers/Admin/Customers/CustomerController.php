<?php


namespace App\Http\Controllers\Admin\Customers;


use App\AsientoContable\Base\BaseHeader;
use App\AsientoContable\Base\BasePension;
use App\AsientoContable\Customers\Customer;
use App\AsientoContable\Customers\Requests\CustomerRequest;
use App\AsientoContable\Headers\Header;
use App\AsientoContable\PensionFund\PensionFund;
use App\Http\Controllers\Controller;
use App\AsientoContable\Customers\Repositories\ICustomer;
use Maatwebsite\Excel\Facades\Excel;

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
        BaseHeader::all()->each(function ($base) use ($customer) {
            $base['customer_id'] = $customer->id;
            Header::create($base->toArray());
        });

        BasePension::all()->each(function ($value) use($customer){
            $value['customer_id'] = $customer->id;
            PensionFund::create($value->toArray());
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
