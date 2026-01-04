<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   

    public function up(): void
    {
        Schema::create('profissionais', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('especialidade');
            $table->string('telefone');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('profissionais');
    }
};
