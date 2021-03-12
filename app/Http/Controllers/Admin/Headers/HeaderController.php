<?php


namespace App\Http\Controllers\Admin\Headers;


use App\AsientoContable\AccountsHeaders\AccountHeader;
use App\AsientoContable\AccountsHeaders\Requests\AccountHeaderRequest;
use App\Http\Controllers\Controller;
use Str;

class HeaderController extends Controller
{
    public function index(int $customer_id)
    {
        return view('customers.headers.index',[
            'headers' => AccountHeader::where(['customer_id'=>$customer_id,'show'=>true])->orderBy('order')->get()
        ]);
    }

    public function create()
    {
        return view('customers.headers.create',[
            'model' => new AccountHeader(),
            'headers' => AccountHeader::where('customer_id',customerID())->get()
        ]);
    }
    public function edit($customer_id,$id)
    {
        return view('customers.headers.edit',[
            'model' => AccountHeader::find($id),
            'headers' => AccountHeader::where('customer_id',customerID())->get()
        ]);
    }

    public function store(AccountHeaderRequest $request,$customer_id)
    {
        $request->merge([
            'customer_id' => customerID(),
            'name_slug' => Str::slug($request->name,'_')
        ]);
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
