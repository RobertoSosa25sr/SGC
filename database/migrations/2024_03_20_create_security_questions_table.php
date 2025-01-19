<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('security_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
        });

        // Preguntas predefinidas
        DB::table('security_questions')->insert([
            ['question' => '¿Cuál es el nombre de tu primera mascota?'],
            ['question' => '¿En qué ciudad naciste?'],
            ['question' => '¿Cuál es el nombre de tu mejor amigo de la infancia?'],
            ['question' => '¿Cuál fue tu primer colegio?'],
            ['question' => '¿Cuál es el segundo nombre de tu madre?']
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('security_questions');
    }
}; 