<?php

namespace App\Http\Controllers;

use App\Models\Access_log;
use Illuminate\Support\Facades\Auth;

class AccessLogsController extends Controller
{
    public function index()
    {
        $accessLogs = Access_Log::where('user_id', Auth::id())
        ->where('read', false)  // Filtrar por notificaciones no leídas
            ->orderBy('attempted_at', 'desc')
            ->get(['id','attempted_at','success', 'read']);// Obtiene todos los registros de acceso
        return view('historial', compact('accessLogs')); // Pasa los registros a la vista
    }

    public function markAsRead($id)
    {
        // Buscar el registro por ID
        $log = Access_Log::find($id);

        if ($log) {
            // Marcar como leído (1)
            $log->read = true;  // O $log->read = 1;
            $log->save(); // Guardar los cambios

            return redirect()->route('historial')->with('success', 'Registro marcado como leído');
        }

        return redirect()->route('historial')->with('error', 'No se encontró el registro');
    }
}
