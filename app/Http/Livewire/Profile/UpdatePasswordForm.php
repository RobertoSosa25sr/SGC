<?php

namespace App\Http\Livewire\Profile;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class UpdatePasswordForm extends Component
{
    public $state = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function updatePassword()
    {
        $this->validate([
            'state.current_password' => ['required', 'string', 'current_password'],
            'state.password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ]);

        try {
            $user = Auth::user();
            $user->forceFill([
                'password' => Hash::make($this->state['password']),
            ])->save();

            // Notificación de cambio exitoso
            Notification::create([
                'user_id' => $user->id,
                'type' => 'password_changed',
                'message' => 'La contraseña fue actualizada exitosamente',
                'notified_at' => now(),
                'read' => false,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);

            $this->state = [
                'current_password' => '',
                'password' => '',
                'password_confirmation' => '',
            ];

            $this->emit('saved');

        } catch (\Exception $e) {
            // Notificación de intento fallido
            Notification::create([
                'user_id' => Auth::id(),
                'type' => 'password_change_failed',
                'message' => 'Intento fallido de cambio de contraseña',
                'notified_at' => now(),
                'read' => false,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);

            throw ValidationException::withMessages([
                'state.current_password' => [__('No se pudo actualizar la contraseña.')],
            ]);
        }
    }

    public function render()
    {
        return view('profile.update-password-form');
    }
} 