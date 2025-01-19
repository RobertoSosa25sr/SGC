<x-form-section submit="updateSecurityQuestion">
    <x-slot name="title">
        {{ __('Security Question') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your security question for account recovery.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Current Password') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" />
            <x-input-error for="state.current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="security_question" value="{{ __('Security Question') }}" />
            <select id="security_question" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" wire:model="state.security_question_id">
                <option value="">{{ __('Select a security question') }}</option>
                @foreach($securityQuestions as $question)
                    <option value="{{ $question->id }}">{{ $question->question }}</option>
                @endforeach
            </select>
            <x-input-error for="state.security_question_id" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="security_answer" value="{{ __('Security Answer') }}" />
            <x-input id="security_answer" type="password" class="mt-1 block w-full" wire:model="state.security_answer" />
            <x-input-error for="state.security_answer" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section> 