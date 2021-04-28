<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('symbol');
            $table->float('rate')->nullable();
            $table->float('compra')->nullable();
            $table->timestamps();
        });

        \App\AsientoContable\Currencies\Currency::create([
            'name' => 'United States Dollar',
            'code' => 'USD',
            'symbol' => '$',
            'rate' => '3.647'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
