<?php

namespace Database\Seeders;

use App\AsientoContable\BaseHeaders\BaseHeader;
use App\AsientoContable\Customers\Customer;
use App\AsientoContable\Headers\Header;
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

        BaseHeader::all()->each(function ($item) use ($firstCustomer) {
            Header::create([
                'name'        => $item->header,
                'slug'        => $item->header_slug,
                'type'        => $item->type,
                'order'       => $item->order,
                'is_required' => $item->is_required,
                'has_account' => $item['has_account'] ?? false,
                'customer_id' => $firstCustomer->id,
            ]);
        });

    }
}
