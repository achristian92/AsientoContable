<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_header', function (Blueprint $table) {
            $table->id();
            $table->string('header');
            $table->string('header_slug');
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(1);
            $table->string('account_slug')->nullable();
            $table->boolean('show')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('base_header');
    }
}
