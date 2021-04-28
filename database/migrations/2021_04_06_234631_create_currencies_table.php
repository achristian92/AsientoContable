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
            $table->string('name')->default('United States Dollar');
            $table->string('code')->default('USD');
            $table->string('symbol')->default('$');
            $table->float('buy')->nullable();
            $table->float('sell')->nullable();
            $table->timestamps();
        });

        \App\AsientoContable\Currencies\Currency::create([
            'buy' => '3.834',
            'sell' => '3.841',
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
