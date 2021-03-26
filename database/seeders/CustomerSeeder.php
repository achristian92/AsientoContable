<?php

namespace Database\Seeders;

use App\AsientoContable\AccountsHeaders\AccountHeader;
use App\AsientoContable\BaseHeaders\BaseHeader;
use App\AsientoContable\Customers\Customer;
use App\AsientoContable\HeaderAccountingsAccount\HeaderAccount;
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
                'ruc' => '20557915541'
            ],
        ]);
        $customers->each(function ($customer) {
           Customer::create($customer);
        });

        $firstCustomer = Customer::first();

        BaseHeader::all()->each(function ($item,$key) use ($firstCustomer) {
            AccountHeader::create([
                'name'         => $item->header,
                'name_slug'    => $item->header_slug,
                'customer_id'  => 1,
                'order'        => $item->order,
                'is_required'  => $item->is_required,
                'show'         => $item->show,
                'name_account_slug' => HeaderAccount::firstWhere('slug',$item->account_slug)->name ?? '',
                'account_slug' => $item->account_slug,
            ]);
        });
    }
}
