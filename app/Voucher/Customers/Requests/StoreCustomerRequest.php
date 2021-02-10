<?php


namespace App\Voucher\Customers\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function rules() {
        $rules = [
                    'name' => 'required|max:255',
            'nro_document' => 'required|max:11',
           'type_document' => 'required',
        ];

        foreach($this->request->get('contacts') as $key => $val)
        {
            if (!empty($val)) {
                $rules["contacts.$key.full_name"] = 'required';
                $rules["contacts.$key.email"]     = 'required|email';
            }
        }
        return $rules;

    }
    public function messages()
    {
        $messages = [
                    'name.required' => "Razón social es obligatorio",
            'nro_document.required' => "Número (RUC, DNI) es obligatorio",
           'type_document.required' => "Tipo de identificación es obligatorio",
        ];

        foreach($this->request->get('contacts') as $key => $val)
        {
            $messages["contacts.$key.full_name.required"] = 'Nombres(P-'.($key+1).') es requerido.';
            $messages["contacts.$key.email.required"]     = 'Correo(P-'.($key+1).') es requerido.';
            $messages["contacts.$key.email.email"]        = 'Correo(P-'.($key+1).') debe ser correo.';
        }

        return $messages;

    }

}
