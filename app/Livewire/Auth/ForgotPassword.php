<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use App\Models\Notification;

class ForgotPassword extends Component
{
    public $step = 1;
    public $email = '';
    public $security_answer = '';
    public $password = '';
    public $password_confirmation = '';
    public $user = null;

    public function findUser()
    {
        $this->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $this->user = User::where('email', $this->email)->first();
        
        if (!$this->user->security_question_id) {
            throw ValidationException::withMessages([
                'email' => [__('No hay una pregunta de seguridad configurada para esta cuenta.')],
            ]);
        }

        $this->step = 2;
    }

    public function verifyAnswer()
    {
        $this->validate([
            'security_answer' => ['required', 'string'],
        ]);

        if (!Hash::check($this->security_answer, $this->user->security_answer)) {
            throw ValidationException::withMessages([
                'security_answer' => [__('La respuesta es incorrecta.')],
            ]);
        }

        $this->step = 3;
    }

    public function resetPassword()
    {
        $this->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            $this->user->forceFill([
                'password' => Hash::make($this->password),
            ])->save();

            // Crear notificación de restablecimiento de contraseña
            Notification::create([
                'user_id' => $this->user->id,
                'type' => 'password_reset',
                'message' => 'Su contraseña fue restablecida mediante pregunta de seguridad',
                'notified_at' => now(),
                'read' => false,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);

            session()->flash('status', __('La contraseña ha sido actualizada exitosamente.'));

            return redirect()->route('login');

        } catch (\Exception $e) {
            Notification::create([
                'user_id' => $this->user->id,
                'type' => 'password_reset_failed',
                'message' => 'Intento fallido de restablecimiento de contraseña',
                'notified_at' => now(),
                'read' => false,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);

            throw ValidationException::withMessages([
                'password' => [__('No se pudo actualizar la contraseña.')],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
} 