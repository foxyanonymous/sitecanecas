<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['id_produto','comprador_nome', 'comprador_email', 'quantidade', 'preco_unitario', 'status', 'external_reference'];

    // Relação com produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto'); // A coluna 'produto_id' deve existir na tabela vendas
    }
}
