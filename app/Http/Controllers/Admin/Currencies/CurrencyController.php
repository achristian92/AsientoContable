<?php


namespace App\Http\Controllers\Admin\Currencies;


use App\AsientoContable\Currencies\Currency;
use App\AsientoContable\Currencies\Requests\CurrencyRequest;
use App\Http\Controllers\Controller;
use App\Models\History;

class CurrencyController extends Controller
{
    public function index()
    {
        return view('admin.currencies.index',[
            'currencies' => Currency::latest()->get()
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
        history(History::UPDATED_TYPE,"Actualizó tipo de cambio a $request->buy y venta a $request->sell");

        $currency->update($request->all());
        return redirect()->route('admin.currencies.index')->with('message','Registro actualizado');
    }
}
