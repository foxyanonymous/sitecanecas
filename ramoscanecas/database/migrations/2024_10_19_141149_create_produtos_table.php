<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // Nome do produto
            $table->decimal('preco', 10, 2); // Preço do produto
            $table->text('descricao'); // Descrição do produto
            $table->string('imagem')->nullable(); // Coluna para armazenar a imagem (pode ser nula)
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade'); // Relacionamento com categoria
            $table->foreignId('categoria_id')->constrained()->onDelete('relvenda'); // Relacionamento com categoria
            $table->foreignId('produto_id')->constrained()->onDelete('relvenda'); // Relaciona com produtos
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
        Schema::dropIfExists('venda_produto');
    }

}
