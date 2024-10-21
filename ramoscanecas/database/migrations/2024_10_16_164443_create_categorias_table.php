<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // Nome da categoria
            $table->string('caminho')->unique(); // Novo campo para o caminho da categoria
            $table->string('imagem')->nullable(); // Coluna para armazenar a imagem (pode ser nula)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
