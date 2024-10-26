<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendaProdutoTable extends Migration
{
    public function up()
    {
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
    }
}
