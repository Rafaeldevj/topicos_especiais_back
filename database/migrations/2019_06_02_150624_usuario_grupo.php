<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsuarioGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_usuario_grupo', function (Blueprint $table) {
            $table->bigIncrements('cd_usuario_grupo');
            $table->bigInteger('cd_usuario')->unsigned();
            $table->bigInteger('cd_grupo')->unsigned();

            $table->foreign('cd_usuario')->references('cd_usuario')->on('tb_usuario')->onDelete('cascade');
            $table->foreign('cd_grupo')->references('cd_grupo')->on('tb_grupo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_usuario_grupo');
    }
}
