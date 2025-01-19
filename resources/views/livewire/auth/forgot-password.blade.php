<div>
    <div class="mb-4 text-sm text-gray-600">
        @if ($step === 1)
            {{ __('¿Olvidaste tu contraseña? Ingresa tu correo electrónico para comenzar el proceso de recuperación.') }}
        @elseif ($step === 2)
            {{ __('Por favor, responde tu pregunta de seguridad.') }}
        @else
            {{ __('Ingresa tu nueva contraseña.') }}
        @endif
    </div>

    <x-validation-errors class="mb-4" />

    @if ($step === 1)
        <div>
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input wire:model="email" id="email" class="block mt-1 w-full" type="email" required autofocus />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button wire:click="findUser">
                {{ __('Continuar') }}
            </x-button>
        </div>
    @elseif ($step === 2)
        <div class="mb-4">
            <x-label value="{{ __('Pregunta de Seguridad') }}" />
            <div class="mt-1 text-gray-600">{{ $user->securityQuestion->question }}</div>
        </div>

        <div>
            <x-label for="security_answer" value="{{ __('Respuesta') }}" />
            <x-input wire:model="security_answer" id="security_answer" class="block mt-1 w-full" type="password" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button wire:click="verifyAnswer">
                {{ __('Verificar') }}
            </x-button>
        </div>
    @else
        <div>
            <x-label for="password" value="{{ __('Nueva Contraseña') }}" />
            <x-input wire:model="password" id="password" class="block mt-1 w-full" type="password" required />
        </div>

        <div class="mt-4">
            <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
            <x-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button wire:click="resetPassword">
                {{ __('Actualizar Contraseña') }}
            </x-button>
        </div>
    @endif
</div> 