<?php

namespace Database\Seeders;

use App\AsientoContable\AccountsHeaders\AccountHeader;
use App\AsientoContable\BaseHeaders\BaseHeader;
use App\AsientoContable\Concepts\Concept;
use App\AsientoContable\Customers\Customer;
use App\AsientoContable\HeaderAccountingsAccount\HeaderAccount;
use App\AsientoContable\Headers\Header;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'ruc' => '20557915541'
            ],
        ]);
        $customers->each(function ($customer) {
           Customer::create($customer);
        });

        $firstCustomer = Customer::first();

        BaseHeader::all()->each(function ($item) use ($firstCustomer) {
            Header::create([
                'name' => $item->header,
                'slug' => $item->header_slug,
                'order'        => $item->order,
                'is_required'  => $item->is_required,
                'has_account'  => $item['has_account'] ?? false,
                'customer_id' => $firstCustomer->id,
            ]);
        });

    }
}
