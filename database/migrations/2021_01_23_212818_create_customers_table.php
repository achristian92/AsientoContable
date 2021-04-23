<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('ruc')->unique()->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();;
            $table->string('raw_password')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });

         DB::table('customers')->insert([
             'name'         => 'JIMENEZ & ESPINOZA ASOCIADOS SOCIEDAD ANONIMA CERRADA',
             'ruc'          => '20557915541',
             'email'        => 'aruizdev27@gmail.com',
             'raw_password' => '20557915541',
             'password'     => bcrypt('20557915541'),
             'address'      => 'PJ. DE LA CULTURA NRO. 271 C.H. CARLOS CUETO FERN - LIMA - LOS OLIVOS'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
