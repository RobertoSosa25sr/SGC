<?php

namespace App\Livewire\Profile;

use App\Models\Notification;
use App\Models\SecurityQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class SecurityQuestionForm extends Component
{
    public $state = [
        'current_password' => '',
        'security_question_id' => '',
        'security_answer' => '',
    ];

    public function mount()
    {
        $this->state['security_question_id'] = Auth::user()->security_question_id;
    }

    public function updateSecurityQuestion()
    {
        $this->validate([
            'state.current_password' => ['required', 'string', 'current_password'],
            'state.security_question_id' => ['required', 'exists:security_questions,id'],
            'state.security_answer' => ['required', 'string', 'min:3'],
        ]);

        try {
            $user = Auth::user();
            
            $user->forceFill([
                'security_question_id' => $this->state['security_question_id'],
                'security_answer' => Hash::make($this->state['security_answer']),
            ])->save();

            Notification::create([
                'user_id' => $user->id,
                'type' => 'security_question_updated',
                'message' => 'Su pregunta de seguridad fue actualizada exitosamente',
                'notified_at' => now(),
                'read' => false,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);

            $this->state['current_password'] = '';
            $this->state['security_answer'] = '';

            $this->dispatch('saved');

        } catch (\Exception $e) {
            Notification::create([
                'user_id' => Auth::id(),
                'type' => 'security_question_update_failed',
                'message' => 'Intento fallido de actualización de pregunta de seguridad',
                'notified_at' => now(),
                'read' => false,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);

            throw ValidationException::withMessages([
                'state.current_password' => [__('No se pudo actualizar la pregunta de seguridad.')],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.profile.security-question-form', [
            'securityQuestions' => SecurityQuestion::all()
        ]);
    }
} 