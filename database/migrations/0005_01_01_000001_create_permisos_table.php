<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->string('descripcion',500)->nullable();
            $table->timestamps();
        });
    
        DB::table('permisos')->insert([
            ['nombre' => 'notificaciones_correo', 'descripcion' => 'Concedo acceso a mi correo electrónico para recibir notificaciones de promociones según la Ley Orgánica de Protección de Datos Personales de Ecuador'],
            ['nombre' => 'mensajes_whatsapp', 'descripcion' => 'Concedo acceso a mi número telefónico personal para recibir mensajes por WhatsApp, de acuerdo con la Ley Orgánica de Protección de Datos Personales de Ecuador'],
            ['nombre' => 'llamadas', 'descripcion' => 'Concedo acceso a mi número telefónico personal para recibir llamadas, de acuerdo con la Ley Orgánica de Protección de Datos Personales de Ecuador'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};
