<?php

namespace App\Actions\Fortify;

use App\Models\Notification;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(AuthUser $user, array $input): void
    {
        Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => $this->passwordRules(),
        ], [
            'current_password.current_password' => __('The provided password does not match your current password.'),
        ])->validateWithBag('updatePassword');

        try {
            $user->forceFill([
                'password' => Hash::make($input['password']),
            ])->save();

            // Notificación de cambio exitoso
            Notification::create([
                'user_id' => $user->id,
                'type' => 'password_changed',
                'message' => 'Su contraseña fue actualizada exitosamente',
                'notified_at' => now(),
                'read' => false,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);

        } catch (\Exception $e) {
            // Notificación de intento fallido
            Notification::create([
                'user_id' => $user->id,
                'type' => 'password_change_failed',
                'message' => 'Intento fallido de cambio de contraseña',
                'notified_at' => now(),
                'read' => false,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);

            throw $e;
        }
    }
}
