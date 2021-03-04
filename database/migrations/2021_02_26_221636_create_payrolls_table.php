<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('work_area_id');
            $table->string('work_area');
            $table->string('position_id');
            $table->string('position');
            $table->date('date_entry');
            $table->date('date_termination')->nullable();
            $table->string('pension_short');
            $table->string('pension');
            $table->string('currency')->default('MN');
            $table->integer('nro_days_worked')->default(0);
            $table->integer('nro_hours_worked')->default(0);
            $table->integer('overtime_hours')->default(0);
            $table->integer('overtime_minutes')->default(0);
            $table->integer('pdt_days')->default(0);
            $table->integer('family_allowance')->default(0);
            $table->double('base_salary')->default(0);
            $table->double('total_income')->default(0);
            $table->double('pension_discount')->default(0);
            $table->double('insurance_discount')->default(0);
            $table->double('commission_discount')->default(0);
            $table->double('fifth_category')->default(0);
            $table->double('with_eps')->default(0);
            $table->double('total_expense')->default(0);
            $table->double('esshealth')->default(0);
            $table->double('total_contribution')->default(0);
            $table->double('net_pay')->default(0);
            $table->foreignId('collaborator_id')->constrained()->cascadeOnDelete();
            $table->date('payroll_date')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
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
        Schema::dropIfExists('payrolls');
    }
}
