<?php

namespace Database\Seeders;

use App\AsientoContable\Base\BaseHeader;
use App\AsientoContable\Base\BasePension;
use App\AsientoContable\Customers\Customer;
use App\AsientoContable\Headers\Header;
use App\AsientoContable\PensionFund\PensionFund;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = collect([
            [
                'name' => 'JIMENEZ & ESPINOZA ASOCIADOS SOCIEDAD ANONIMA CERRADA',
                'ruc' => '20557915541',
                'address' => 'PJ. DE LA CULTURA NRO. 271 C.H. CARLOS CUETO FERN - LIMA - LOS OLIVOS'
            ],
        ]);
        $customers->each(function ($customer) {
           Customer::create($customer);
        });

        $firstCustomer = Customer::first();

        BaseHeader::all()->each(function ($base) use ($firstCustomer) {
            $base['customer_id'] = $firstCustomer->id;
            Header::create($base->toArray());
        });
        BasePension::all()->each(function ($value) use($firstCustomer){
            $value['customer_id'] = $firstCustomer->id;
            PensionFund::create($value->toArray());
        });

    }
}
