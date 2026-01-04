<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $table = 'servicos';

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'duracao_minutos',
        'imagem',
        'ativo',
        'user_id'
    ];

    // Quem cadastrou o serviço
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Muitos profissionais realizam muitos serviços
    public function profissionais()
    {
        return $this->belongsToMany(Profissional::class, 'profissional_servico');
    }

    // Avaliações polimórficas
    public function avaliacoes()
    {
        return $this->morphMany(Avaliacao::class, 'avaliavel');
    }

    // URL da imagem
    public function getImagemUrlAttribute()
    {
        return $this->imagem
            ? asset('storage/' . $this->imagem)
            : null;
    }
}
