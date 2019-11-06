<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacasUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacas_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('anos_trabajados');
            $table->integer('dias_totales');
            $table->integer('dias_cuenta');
            $table->integer('dias_disp');
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
        Schema::dropIfExists('vacas_user');
    }
}
