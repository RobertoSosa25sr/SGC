<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Laravel\Jetstream\Contracts\DeletesUsers;
use App\Models\Notification;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     */
    public function delete(AuthUser $user): void
    {
        // Crear notificación antes de eliminar la cuenta
        Notification::create([
            'user_id' => $user->id,
            'type' => 'account_deleted',
            'message' => 'Su cuenta ha sido eliminada',
            'notified_at' => now(),
            'read' => false,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
