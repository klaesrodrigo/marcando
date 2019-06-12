<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQuadras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quadras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 200);
            $table->integer('proprietario_id')->unsigned();
            // $table->foreign('proprietario_id')->reference('id')->on('users');
            $table->string('endereco', 300);
            $table->string('telefone');
            $table->string('imagem');
            $table->text('descricao');
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
        Schema::dropIfExists('quadras');
    }
}
