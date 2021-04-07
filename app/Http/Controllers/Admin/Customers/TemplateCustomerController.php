<?php


namespace App\Http\Controllers\Admin\Customers;


use App\Exports\TemplateCustomer;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class TemplateCustomerController extends Controller
{
    public function __invoke()
    {
        $headers = ['EMPRESA','RUC','DIRECCION'];
        return Excel::download(new TemplateCustomer($headers), 'PlantillasClientes.xlsx');
    }

}
