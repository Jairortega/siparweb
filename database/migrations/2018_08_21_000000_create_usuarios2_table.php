<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarios2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios2', function (Blueprint $table) {
            $table->double('cc_usuario', 15, 0);
            $table->string('nom_usuario', 60);
            $table->string('ape_usuario', 60);
            $table->double('tel_usuario', 10, 0);
            $table->double('cel_usuario', 10, 0);
            $table->string('mail_usuario', 60);
            $table->string('clave', 300);
            $table->string('pregunta', 250);
            $table->string('respuesta', 250);
            $table->integer('id_perfil');
            $table->enum('bloqueo', ['0', '1']);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('usuarios2');
    }

}
