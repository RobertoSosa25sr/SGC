<x-authentication-card>
    <div style="text-align: center; margin-bottom: 2rem;">
        <h1 style="font-size: 3.5rem; color: #3C5D9D; font-weight: bold; margin-bottom: 1.5rem;">
            Sistema de Gestión de Consentimientos (SGC)
        </h1>
    </div>

    <div style="width: 100%; max-width: 32rem; margin: 0 auto; padding: 1.5rem; background: white; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: 2px solid #3C5D9D;">
        <div style="margin-bottom: 1rem; text-align: center; color: #4B5563; font-size: 0.875rem;">
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
        <div style="margin-bottom: 1rem;">
            <x-input
                wire:model="email"
                id="email"
                type="email"
                style="width: 100%; padding: 0.5rem; border: 1px solid #3C5D9D; border-radius: 0.375rem;"
                placeholder="Correo electrónico"
                required
                autofocus />
        </div>

        <div style="text-align: center;">
            <button wire:click="findUser" style="width: 100%; padding: 0.5rem 1rem; background: #3C5D9D; color: white; border-radius: 0.375rem; font-weight: 500; border: none; cursor: pointer;">
                {{ __('Continuar') }}
            </button>
        </div>
        @endif

        @if ($step === 2)
        <div style="margin-bottom: 1rem;">
            <div style="font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                {{ __('Pregunta de Seguridad') }}
            </div>
            <div style="color: #4B5563; padding: 0.75rem; background: #F9FAFB; border-radius: 0.375rem;">
                {{ $user->securityQuestion->question }}
            </div>
        </div>

        <div style="margin-bottom: 1rem;">
            <x-input
                wire:model="security_answer"
                id="security_answer"
                type="password"
                style="width: 100%; padding: 0.5rem; border: 1px solid #3C5D9D; border-radius: 0.375rem;"
                placeholder="Respuesta"
                required />
        </div>

        <div style="text-align: center;">
            <button wire:click="verifyAnswer" style="width: 100%; padding: 0.5rem 1rem; background: #3C5D9D; color: white; border-radius: 0.375rem; font-weight: 500; border: none; cursor: pointer;">
                {{ __('Verificar') }}
            </button>
        </div>
        @endif

        @if ($step === 3)
        <div style="margin-bottom: 1rem;">
            <x-input
                wire:model="password"
                id="password"
                type="password"
                style="width: 100%; padding: 0.5rem; border: 1px solid #3C5D9D; border-radius: 0.375rem;"
                placeholder="Nueva contraseña"
                required />
        </div>

        <div style="margin-bottom: 1rem;">
            <x-input
                wire:model="password_confirmation"
                id="password_confirmation"
                type="password"
                style="width: 100%; padding: 0.5rem; border: 1px solid #3C5D9D; border-radius: 0.375rem;"
                placeholder="Confirmar contraseña"
                required />
        </div>

        <div style="text-align: center;">
            <button wire:click="resetPassword" style="width: 100%; padding: 0.5rem 1rem; background: #3C5D9D; color: white; border-radius: 0.375rem; font-weight: 500; border: none; cursor: pointer;">
                {{ __('Actualizar Contraseña') }}
            </button>
        </div>
        @endif
    </div>
</x-authentication-card>
