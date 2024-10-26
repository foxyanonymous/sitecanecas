<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id('produto_id'); // Mantém 'produto_id' como a chave primária
            $table->string('comprador_nome');
            $table->string('comprador_email');
            $table->integer('quantidade');
            $table->decimal('preco_unitario', 10, 2);
            $table->string('status');
            $table->string('external_reference')->nullable();
            $table->timestamps();

            // Adiciona a chave estrangeira
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
