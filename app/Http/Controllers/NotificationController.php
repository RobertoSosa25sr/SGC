<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Obtener solo las notificaciones no leídas (read = 0)
        $notifications = Notification::where('user_id', Auth::id())
            ->where('read', false)  // Filtrar por notificaciones no leídas
            ->orderBy('notified_at', 'desc')
            ->get(['id','message', 'type', 'notified_at']);
    
        return view('notificaciones', compact('notifications')); // Cambiar el nombre de la vista aquí
    }
    
    public function markAsRead($id)
    {
        // Obtener la notificación por su ID
        $notification = Notification::findOrFail($id);
        
        // Cambiar el valor de 'read' a true
        $notification->update(['read' => true]);

        // Redirigir de nuevo a la página de notificaciones
        return redirect()->route('notificaciones')->with('success', 'Notificación marcada como leída.');
    }

}
