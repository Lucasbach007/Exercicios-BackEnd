<?php

namespace App\Models;
use App\Models\Profissional;
use App\Models\Servicos;

use Illuminate\Database\Eloquent\Model;

class AgendamentoServico extends Model
{
    protected $table = 'agendamento_servico';

    protected $fillable = [
        'inicio',
        'fim',
        'servico_id',
        'profissional_id'
    ];

    public function servico()
    {
        return $this->belongsTo(Servicos::class);
    }

    public function profissional()
    {
        return $this->belongsTo(Profissional::class);
    }
}

