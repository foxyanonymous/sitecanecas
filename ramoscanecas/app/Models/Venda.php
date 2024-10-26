<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = ['comprador_nome', 'comprador_email', 'itens', 'total'];

    protected $casts = [
        'itens' => 'array', // Converte JSON em array automaticamente
    ];

    // Relação com produtos
    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'venda_produto', 'venda_id', 'produto_id');
    }
}
