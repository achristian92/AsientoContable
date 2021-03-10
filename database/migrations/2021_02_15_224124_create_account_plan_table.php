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
            $table->string('category');
            $table->string('code')->nullable();
            $table->string('parent_id')->nullable();
            $table->string('name');
            $table->string('import')->nullable();
            $table->string('import_slug')->nullable();
            $table->string('type')->default('GASTO');
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
