<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

protected $table= 'listaprod';
protected $fillable = ['id','nome_produto', 'descricao', 'preco'];
}
