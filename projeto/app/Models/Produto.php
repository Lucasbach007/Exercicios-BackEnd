<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    use HasFactory;
    protected $table = 'listaprod';
    protected $fillable = [
        'nome_produto',
        'descricao',
        'preco',
    ];


//protected $table= 'listaprod';
//protected $fillable = ['id','nome_produto', 'descricao', 'preco'];
}
