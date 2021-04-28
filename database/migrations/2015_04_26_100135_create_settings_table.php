<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('send_email');
            $table->string('project')->default('Asientos Contables');
            $table->boolean('send_credentials')->default(true);
            $table->string('url_logo');
            $table->string('favicon');
        });

        DB::table('settings')->insert([
            'company' => 'JGA CONSULTORES',
            'send_email' => 'no-replay@brainbox.pe',
            'send_credentials' => false,
            'url_logo' => 'https://brainbox20201126.s3.amazonaws.com/general/vP64JKUauUvDQ6vTEST-01-JGA.png',
            'favicon' => 'https://brainbox20201126.s3.amazonaws.com/general/nuGHGkqpZEy1f3Wfavicon.ico',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
