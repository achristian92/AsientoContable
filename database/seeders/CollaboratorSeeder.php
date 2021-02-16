<?php

namespace Database\Seeders;

use App\AsientoContable\Collaborators\Collaborator;
use App\AsientoContable\Customers\Customer;
use Illuminate\Database\Seeder;

class CollaboratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collaborator::factory(300)->create();
    }
}
