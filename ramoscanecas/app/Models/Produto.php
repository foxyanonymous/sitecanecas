<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'preco', 'descricao', 'imagem', 'categoria_id']; // Campos que podem ser preenchidos

    // Relação com a categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
