<?php


namespace App\AsientoContable\Currencies\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest  extends FormRequest
{
    public function rules() {
        return [
            'name'   => 'required',
            'code'   => 'required',
            'symbol' => 'required',
            'rate'   => 'required|regex:/^\d+(\.\d{1,3})?$/',
        ];
    }
}
