<?php


namespace App\Http\Controllers\Admin\Customers;


use App\AsientoContable\AccountPlan\AccountPlan;
use App\AsientoContable\Base\BaseHeader;
use App\AsientoContable\Base\BasePension;
use App\AsientoContable\CenterCosts\Cost;
use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\CostsCenter2\CostCenter2;
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

        if (request()->has('q') && request()->input('q') != '') {
            $customers = $this->customerRepo->searchCustomer(request()->input('q'));
        }

        return view('admin.customers.index',compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create', [
            'customers' => Customer::orderBy('name','asc')->get(),
            'model' => new Customer()
        ]);
    }

    public function store(CustomerRequest $request)
    {
        $customer = $this->customerRepo->createCustomer($request->all());

        if ($request->filled('parent_id')) {
            $oldCustomerId = Customer::find($request->input('parent_id'))->id;

            AccountPlan::where('customer_id',$oldCustomerId)->get()
                ->each(function ($plan) use ($customer) {
                    $plan['customer_id'] = $customer->id;
                    $plan['from_id'] = $plan->id;
                    $plan['updated_at'] = now();
                    $plan['created_at'] = now();
                    AccountPlan::create($plan->toArray());
                });

            $newPlan = AccountPlan::where('customer_id',$customer->id)->get();

            Header::where('customer_id',$oldCustomerId)->get()
                ->each(function ($plan) use ($customer,$newPlan) {
                    $idNewPlan = null;
                    if ($plan->account_plan_id)
                        $idNewPlan = $newPlan->firstWhere('from_id',$plan->account_plan_id)->id;

                    $plan['account_plan_id'] = $idNewPlan;
                    $plan['customer_id'] = $customer->id;
                    $plan['created_at'] = now();
                    $plan['updated_at'] = now();
                    Header::create($plan->toArray());
                });

            PensionFund::where('customer_id',$oldCustomerId)->get()
                ->each(function ($pension) use ($customer,$newPlan) {
                    $idNewPlan = null;
                    if ($pension->account_plan_id)
                        $idNewPlan = $newPlan->firstWhere('from_id',$pension->account_plan_id)->id;

                    $pension['account_plan_id'] = $idNewPlan;
                    $pension['customer_id'] = $customer->id;
                    $pension['created_at'] = now();
                    $pension['updated_at'] = now();
                    PensionFund::create($pension->toArray());
                });
        } else {
            BaseHeader::all()->each(function ($base) use ($customer) {
                $base['customer_id'] = $customer->id;
                Header::create($base->toArray());
            });

            BasePension::all()->each(function ($value) use($customer){
                $value['customer_id'] = $customer->id;
                PensionFund::create($value->toArray());
            });
        }

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
        $customer = Customer::find($id);
        if ($customer->files()->exists()) {
            $this->customerRepo->deleteCustomer($id);
            return redirect()->route('admin.customers.index')->with('message',"Cliente tiene planillas cargadas(primero eliminalas)");
        }

        Header::where('customer_id',$customer->id)->delete();
        PensionFund::where('customer_id',$customer->id)->delete();
        AccountPlan::where('customer_id',$customer->id)->delete();
        Cost::where('customer_id',$customer->id)->delete();
        CostCenter2::where('customer_id',$customer->id)->delete();
        Collaborator::where('customer_id',$customer->id)->delete();
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('message',"Cliente eliminado");
    }

    public function notify(Customer $customer)
    {
        $msg = 'Cliente notificado';
        $this->customerRepo->sendEmailNewCredentials($customer);

        if ($customer->email)
            $customer->update(['notified'=> true]);
        else
            $msg = 'El cliente no tiene correo asignado';

        return redirect()->route('admin.customers.index')->with('message',$msg);
    }


}
