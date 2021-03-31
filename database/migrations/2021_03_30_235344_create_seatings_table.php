<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seatings', function (Blueprint $table) {
            $table->id();
            $table->string('sub_diario');
            $table->integer('nro_asiento');
            $table->integer('l_registro');
            $table->string('fecha_registro');
            $table->string('mes');
            $table->integer('cuenta_contable');
            $table->float('debe')->nullable();
            $table->float('haber')->nullable();
            $table->string('moneda')->default('S');
            $table->float('tipo_cambio');
            $table->float('debeUSD')->nullable();
            $table->float('haberUSD')->nullable();
            $table->string('glosa_asiento');
            $table->string('nro_documento');
            $table->string('doc')->default('PL');
            $table->string('nro_doc');
            $table->string('fecha_doc');
            $table->string('fecha_vencimiento')->nullable();
            $table->string('cost')->nullable();
            $table->string('cost2')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seatings');
    }
}
