<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendamento_servico', function (Blueprint $table) {
            $table->id();

            $table->dateTime('inicio');
            $table->dateTime('fim');

            $table->foreignId('servico_id')
                ->constrained('servicos')
                ->cascadeOnDelete();

            $table->foreignId('profissional_id')
                ->constrained('profissionais')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendamento_servico');
    }
};
