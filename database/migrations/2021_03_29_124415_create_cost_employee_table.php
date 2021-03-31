<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_employee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collaborator_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cost_id')->constrained()->cascadeOnDelete();
            $table->float('percentage');
            $table->foreignId('month_cost_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('cost_employee');
    }
}
