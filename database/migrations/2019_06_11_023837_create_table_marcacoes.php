<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMarcacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quadra_tipo_id')->unsigned();
            // $table->foreign('quadra_tipo_id')->reference('id')->on('quadras_tipos');
            $table->integer('usuario_id')->unsigned();
            // $table->foreign('usuario_id')->reference('id')->on('users');
            $table->string('data_hora');
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
        Schema::dropIfExists('marcacoes');
    }
}
