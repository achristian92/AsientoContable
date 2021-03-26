<?php


namespace App\Http\Controllers\Admin\Headers;


use App\AsientoContable\AccountsHeaders\AccountHeader;
use App\AsientoContable\AccountsHeaders\Requests\AccountHeaderRequest;
use App\AsientoContable\HeaderAccountingsAccount\HeaderAccount;
use App\AsientoContable\Headers\Header;
use App\Http\Controllers\Controller;
use DB;
use Str;

class HeaderController extends Controller
{
    public function index(int $customer_id)
    {
        return view('customers.headers.index',[
            'headers' => Header::where(['customer_id'=>$customer_id,'show'=>true])->orderBy('order')->get()
        ]);
    }

    public function create()
    {
        return view('customers.headers.create',[
            'model' => new AccountHeader(),
            'headers' => HeaderAccount::all()
        ]);
    }
    public function edit($customer_id,$id)
    {
        return view('customers.headers.edit',[
            'model' => AccountHeader::find($id),
            'headers' => HeaderAccount::all()
        ]);
    }

    public function store(AccountHeaderRequest $request,$customer_id)
    {
        $request->merge([
            'customer_id' => customerID(),
            'name_slug' => Str::slug($request->name,'_')
        ]);
        if ($request->has('heacher_accounting_id')) {
            $cabeceraCuentas = HeaderAccount::find($request->heacher_accounting_id);
            $request->merge([
                'name_account_slug' => $cabeceraCuentas->name,
                'account_slug' => $cabeceraCuentas->slug
            ]);
        }
        AccountHeader::create($request->all());
        return redirect()->route('admin.customers.headers.index',$customer_id)->with('message',"Registro creado");
    }

    public function update(AccountHeaderRequest $request,$customer_id,$id)
    {
        $request->merge([
            'name_slug' => Str::slug($request->name,'_')
        ]);
        $header = AccountHeader::find($id);
        $header->update($request->all());
        return redirect()->route('admin.customers.headers.index',$customer_id)->with('message',"Registro actualizado");
    }

}
