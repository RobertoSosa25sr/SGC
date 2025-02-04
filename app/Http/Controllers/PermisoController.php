<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Permiso;
use App\Models\User_permiso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function index()
    {
        // Fetch all permissions
        $permisos = Permiso::all();
    
        // Fetch user's permissions with active status
        $userPermisos = User_permiso::where('user_id', Auth::id())
            ->get(['permiso_id', 'active']) // Get permiso_id and active status
            ->keyBy('permiso_id'); // Use permiso_id as the key for easier access in the view
    
        // Pass both permisos and userPermisos to the view
        return view('permisos', compact('permisos', 'userPermisos'));
    }
    

    public function update(Request $request)
    {
        // Obtener al usuario autenticado
        $user = auth()->user();
    
        // Validar que los permisos enviados sean un arreglo
        $request->validate([
            'permisos' => 'required|array', // Se espera un arreglo de permisos con sus estados
            'permisos.*' => 'boolean', // Cada permiso debe ser un valor booleano (1 o 0)
        ]);
    
        // Iterar sobre todos los permisos enviados desde la vista
        foreach ($request->input('permisos') as $permisoId => $isChecked) {
            User_permiso::updateOrCreate(
                ['user_id' => $user->id, 'permiso_id' => $permisoId],
                ['active' => $isChecked] // Activar o desactivar según el valor enviado
            );
        }
    
        // Redirigir con un mensaje de éxito
        session()->flash('saved', 'Saved');
        Notification::create([
            'user_id' => $user->id,
            'type' => 'policy_updated',
            'message' => 'Sus permisos fueron actualizados',
            'notified_at' => now(),
            'read' => false,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        return redirect()->route('permisos')->with('success', 'Permisos actualizados correctamente.');
    }
       
    
    
}
