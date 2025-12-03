<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class agendamento_servico extends Model
{
  protected $table = "agendamento_servico";
    protected $fillable = [
        'nome',
        'inicio',
        'fim',
    ];
}
