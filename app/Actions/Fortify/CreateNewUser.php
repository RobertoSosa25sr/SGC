<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'security_question_id' => ['required', 'exists:security_questions,id'],
            'security_answer' => ['required', 'string', 'min:3', 'max:255'],
        ])->validate();

        $user = DB::transaction(function () use ($input) {
            return User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'security_question_id' => $input['security_question_id'],
                'security_answer' => Hash::make($input['security_answer']),
            ]);
        });
        
        // Ahora fuera de la transacción, creamos la notificación
        Notification::create([
            'user_id' => $user->id,
            'type' => 'account_created',
            'message' => 'Su cuenta ha sido creada exitosamente',
            'notified_at' => now(),
            'read' => false,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        return $user;
    }
}
