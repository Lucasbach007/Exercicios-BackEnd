<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicos extends Model
{
    protected $table = 'servicos';
    protected $fillable = [
        'nome',
        'descricao',
        'preco'
    ];
        use HasFactory;

        public function profissionais()
{
    return $this->belongsToMany(Profissional::class, 'profissional_servico');
}
}
