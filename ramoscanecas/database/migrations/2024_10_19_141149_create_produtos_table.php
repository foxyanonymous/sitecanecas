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
            $table->timestamps(); // Adiciona os timestamps
        });

        // Adiciona a coluna produto_id na tabela vendas
        if (!Schema::hasColumn('vendas', 'produto_id')) {
            Schema::table('vendas', function (Blueprint $table) {
                $table->unsignedBigInteger('produto_id')->after('comprador_email'); // Adiciona a coluna
                $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade'); // Chave estrangeira
            });
        }
    }

    public function down()
    {
        // Remove a chave estrangeira se existir
        Schema::table('vendas', function (Blueprint $table) {
            if (Schema::hasColumn('vendas', 'produto_id')) {
                $table->dropForeign(['produto_id']);
                $table->dropColumn('produto_id');
            }
        });
        
        Schema::dropIfExists('produtos');
    }
}
