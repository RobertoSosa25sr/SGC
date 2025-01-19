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

        // Preguntas más personales y específicas
        DB::table('security_questions')->insert([
            ['question' => 'Contraseña alternativa'],
            ['question' => 'Correo electrónico alternativo'], 
            ['question' => '¿Cuál fue el nombre del primer profesor que recuerdas?'],
            ['question' => '¿En qué calle vivías cuando tenías 10 años?'],
            ['question' => '¿Cuál fue el primer plato que aprendiste a cocinar?'],
            ['question' => '¿Cuál fue el primer concierto al que asististe?'],
            ['question' => '¿Cuál fue el nombre de tu primer mejor amigo en la escuela primaria?'],
       ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('security_questions');
    }
}; 