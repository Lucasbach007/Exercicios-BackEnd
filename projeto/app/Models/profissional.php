<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servico;

class profissional extends Model
{
    /** @use HasFactory<\Database\Factories\ProfissionalFactory> */
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
    return $this->belongsToMany(Servicos::class, 'profissional_servico');
}
  public function agendamentos()
    {
        return $this->hasMany(agendamento_servico::class);
    }

}
