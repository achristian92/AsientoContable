<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedInteger('parent_id')->nullable();
        });
        Schema::table('account_plan', function (Blueprint $table) {
            $table->unsignedInteger('from_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('parent_id');
        });
        Schema::table('account_plan', function (Blueprint $table) {
            $table->dropColumn('from_id');
        });
    }
}
