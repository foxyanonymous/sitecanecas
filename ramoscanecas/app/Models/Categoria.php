<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Atributos que podem ser preenchidos em massa
    protected $fillable = ['nome', 'caminho', 'imagem'];

    // Relacionamento: uma categoria pode ter muitos produtos
    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
