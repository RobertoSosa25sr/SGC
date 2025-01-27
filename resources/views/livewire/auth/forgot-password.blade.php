<x-guest-layout>
    <x-authentication-card>
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 3.5rem; color: #3C5D9D; font-weight: bold; margin-bottom: 1.5rem;">
                Sistema de Gestión de Consentimientos (SGC)
            </h1>
        </div>

        <div style="display: flex; justify-content: center; align-items: center;">
            <div style="width: 100%; max-width: 400px; padding: 2rem; border: 2px solid #3C5D9D; border-radius: 0.5rem; background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <!-- Mensaje dinámico según el paso -->
                <div class="mb-4 text-sm text-gray-600" style="text-align: center;">
                    @if ($step === 1)
                    {{ __('¿Olvidaste tu contraseña? Ingresa tu correo electrónico para comenzar el proceso de recuperación.') }}
                    @elseif ($step === 2)
                    {{ __('Por favor, responde tu pregunta de seguridad.') }}
                    @else
                    {{ __('Ingresa tu nueva contraseña.') }}
                    @endif
                </div>

                <!-- Errores de validación -->
                <x-validation-errors class="mb-4" />

                <!-- Paso 1: Ingresar correo electrónico -->
                @if ($step === 1)
                <div style="margin-bottom: 1rem;">
                    <x-input
                        wire:model="email"
                        id="email"
                        type="email"
                        placeholder="Correo electrónico"
                        style="width: 100%; padding: 0.5rem; border-radius: 0.375rem; border: 1px solid #3C5D9D; background-color: white;"
                        required
                        autofocus />
                </div>

                <div style="text-align: center;">
                    <button
                        type="button"
                        wire:click="findUser"
                        style="width: 100%; padding: 0.5rem; background-color: #3C5D9D; color: white; border-radius: 0.375rem; font-weight: 500;">
                        {{ __('Continuar') }}
                    </button>
                </div>
                @endif

                @if ($step === 2)
                <div style="margin-bottom: 1rem;">
                    <div style="font-weight: 500; color: #3C5D9D; margin-bottom: 0.5rem;">
                        {{ __('Pregunta de Seguridad') }}
                    </div>
                    <div style="color: #4a5568;">{{ $user->securityQuestion->question }}</div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <x-input
                        wire:model="security_answer"
                        id="security_answer"
                        type="password"
                        placeholder="Respuesta"
                        style="width: 100%; padding: 0.5rem; border-radius: 0.375rem; border: 1px solid #3C5D9D; background-color: white;"
                        required />
                </div>

                <div style="text-align: center;">
                    <button
                        type="button"
                        wire:click="verifyAnswer"
                        style="width: 100%; padding: 0.5rem; background-color: #3C5D9D; color: white; border-radius: 0.375rem; font-weight: 500;">
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
                        placeholder="Nueva contraseña"
                        style="width: 100%; padding: 0.5rem; border-radius: 0.375rem; border: 1px solid #3C5D9D; background-color: white;"
                        required />
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <x-input
                        wire:model="password_confirmation"
                        id="password_confirmation"
                        type="password"
                        placeholder="Confirmar contraseña"
                        style="width: 100%; padding: 0.5rem; border-radius: 0.375rem; border: 1px solid #3C5D9D; background-color: white;"
                        required />
                </div>

        <div class="flex items-center justify-end mt-4">
            <x-button wire:click="resetPassword">
                {{ __('Actualizar Contraseña') }}
            </x-button>
        </div>
    @endif
</div>
