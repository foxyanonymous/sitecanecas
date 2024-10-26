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
            $table->string('nome');
            $table->decimal('preco', 10, 2);
            $table->text('descricao');
            $table->string('imagem')->nullable();
            $table->foreignId('categoria_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Remover coluna produto_id da tabela vendas, se existir
        Schema::table('vendas', function (Blueprint $table) {
            if (Schema::hasColumn('vendas', 'produto_id')) {
                $table->dropForeign(['produto_id']);
                $table->dropColumn('produto_id');
            }
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
