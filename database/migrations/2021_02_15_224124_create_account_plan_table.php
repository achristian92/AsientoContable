<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_plan', function (Blueprint $table) {
            $table->id();
            $table->string('account');
            $table->string('sub_account')->nullable();
            $table->string('analytical_account')->nullable();
            $table->string('name');
            $table->string('type');
            $table->boolean('is_analyzable')->default(true);
            $table->boolean('has_center_cost')->default(true);
            $table->boolean('has_center_cost2')->default(true);
            $table->timestamps();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_plan');
    }
}
