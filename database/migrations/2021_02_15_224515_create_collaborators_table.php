<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborators', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('type_document')->nullable();
            $table->string('nro_document');
            $table->string('full_name');
            $table->string('date_start_work');
            $table->boolean('is_active')->default(1);
            $table->string('cuspp')->nullable();
            $table->string('code_cuspp')->nullable();
            $table->string('especial')->default('NINGUNO')->nullable();
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
        Schema::dropIfExists('collaborators');
    }
}
