<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

protected $table= 'produtos';
protected $fillable = ['id','nome_produto', 'descricao', 'preco', 'estoque', 'imagem'];

    public function avaliacoes()
    {
        return $this->morphMany(Avaliacao::class, 'avaliavel');
    }

    // Accessor para retornar nome_produto como nome
    public function getNomeAttribute()
    {
        return $this->nome_produto;
    }

    // URL da imagem
    public function getImagemUrlAttribute()
    {
        return $this->imagem
            ? asset('storage/' . $this->imagem)
            : null;
    }
}
