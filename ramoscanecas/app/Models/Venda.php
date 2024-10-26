<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'comprador_nome',
        'comprador_email',
        'produto_id', // Se este campo for usado
        'quantidade', // Se necessário
        'preco_unitario', // Se necessário
        'status', // Se necessário
        'external_reference' // Se necessário
    ];

    // Relação com produtos
    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'venda_produto', 'venda_id', 'produto_id')
                    ->withPivot('quantidade', 'preco'); // Assume que você precisa de quantidade e preço
    }
}
