<?php


namespace App\Http\Controllers\Admin\Currencies;


use App\AsientoContable\Currencies\Currency;
use App\AsientoContable\Currencies\Requests\CurrencyRequest;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    public function index()
    {
        return view('admin.currencies.index',[
            'currencies' => Currency::all()
        ]);
    }

    public function edit(Currency  $currency)
    {
        return view('admin.currencies.edit',[
            'model' => $currency
        ]);
    }

    public function update(CurrencyRequest $request,Currency $currency)
    {
        $currency->update($request->all());
        return redirect()->route('admin.currencies.index')->with('message','Registro actualizado');
    }
}
