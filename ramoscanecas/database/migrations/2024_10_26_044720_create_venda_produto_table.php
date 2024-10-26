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
            $table->foreignId('venda_id')->constrained()->onDelete('cascade'); // Relaciona com vendas
            $table->foreignId('produto_id')->constrained()->onDelete('cascade'); // Relaciona com produtos
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('venda_produto');
    }
}
