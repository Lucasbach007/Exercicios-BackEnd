<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servico;
use App\Models\AgendamentoServico;

class Profissional extends Model
{
    use HasFactory;

  protected $table = 'profissionais';
   protected $fillable = [
        'nome',
        'especialidade',
        'telefone',
        'email'
   ];


    public function servicos()
{
    return $this->belongsToMany(Servico::class, 'profissional_servico');
}
  public function agendamentos()
    {
        return $this->hasMany(AgendamentoServico::class);
    }

}
