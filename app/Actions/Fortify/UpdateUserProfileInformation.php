<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(AuthUser $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        try {
            $oldValues = [
                'name' => $user->name,
                'phone' => $user->phone,
            ];

            $user->forceFill([
                'name' => $input['name'],
                'phone' => $input['phone'] ?? null,
            ])->save();

            // Crear notificaciones para los campos modificados
            if ($oldValues['name'] !== $input['name']) {
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'profile_updated',
                    'message' => 'Su nombre fue actualizado',
                    'notified_at' => now(),
                    'read' => false,
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ]);
            }

            if ($oldValues['phone'] !== ($input['phone'] ?? null)) {
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'profile_updated',
                    'message' => 'Su teléfono fue actualizado',
                    'notified_at' => now(),
                    'read' => false,
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ]);
            }

        } catch (\Exception $e) {
            Notification::create([
                'user_id' => $user->id,
                'type' => 'profile_update_failed',
                'message' => 'Error al actualizar el perfil',
                'notified_at' => now(),
                'read' => false,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);

            throw $e;
        }
    }
}
