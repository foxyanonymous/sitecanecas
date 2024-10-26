<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->string('comprador_nome');
            $table->string('comprador_email');
            $table->unsignedBigInteger('produto_id'); // A coluna que você precisa
            $table->integer('quantidade');
            $table->decimal('preco_unitario', 10, 2);
            $table->string('status');
            $table->string('external_reference')->nullable();
            $table->timestamps();
    
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade'); // Se você tem uma tabela de produtos
        });

        // Cria a tabela venda_produto
        Schema::create('venda_produto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venda_id')->constrained()->onDelete('cascade'); // Chave estrangeira para a tabela venda
            $table->foreignId('produto_id')->constrained()->onDelete('cascade'); // Chave estrangeira para a tabela produto
            $table->integer('quantidade'); // Coluna para a quantidade
            $table->decimal('preco', 10, 2); // Coluna para o preço unitário
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('venda_produto');
        Schema::dropIfExists('vendas');
    }
}
