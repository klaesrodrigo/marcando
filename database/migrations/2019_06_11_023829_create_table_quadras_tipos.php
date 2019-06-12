<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQuadrasTipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quadras_tipos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quadra_id')->unsigned();
            // $table->foreign('quadra_id')->reference('id')->on('quadras');
            $table->integer('tipo_id')->unsigned();
            // $table->foreign('tipo_id')->reference('id')->on('tipos');
            $table->double('valor');
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
        Schema::dropIfExists('quadras_tipos');
    }
}
