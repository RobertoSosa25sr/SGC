<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     */
    public function delete(AuthUser $user): void
    {
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
