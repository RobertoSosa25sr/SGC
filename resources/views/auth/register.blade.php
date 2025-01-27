<x-guest-layout>
    <x-authentication-card>
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-size: 3.5rem; color: #3C5D9D; font-weight: bold; margin-bottom: 1.5rem;">
                Sistema de Gestión de Consentimientos (SGC)
            </h1>
        </div>

        <div style="display: flex; justify-content: center; align-items: center;">
            <form method="POST" action="{{ route('register') }}" style="width: 100%; max-width: 400px; padding: 2rem; border: 2px solid #3C5D9D; border-radius: 0.5rem; background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                @csrf

                <h3 style="text-align: center; font-size: 1.5rem; color: #3C5D9D; font-weight: bold; margin-bottom: 1.5rem;">
                    CREAR CUENTA
                </h3>

                <x-validation-errors class="mb-4" />

                <div style="margin-bottom: 1rem;">
                    <x-label for="name" value="Nombres" style="display: none;" />
                    <x-input
                        id="name"
                        type="text"
                        name="name"
                        :value="old('name')"
                        placeholder="Nombres"
                        style="width: 100%; padding: 0.5rem; border-radius: 0.375rem; border: 1px solid #3C5D9D; background-color: white;"
                        required
                        autofocus />
                </div>

                <div style="margin-bottom: 1rem;">
                    <x-label for="email" value="Correo" style="display: none;" />
                    <x-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        placeholder="Correo"
                        style="width: 100%; padding: 0.5rem; border-radius: 0.375rem; border: 1px solid #3C5D9D; background-color: white;"
                        required />
                </div>

                <div style="margin-bottom: 1rem;">
                    <x-label for="password" value="Contraseña" style="display: none;" />
                    <x-input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Contraseña"
                        style="width: 100%; padding: 0.5rem; border-radius: 0.375rem; border: 1px solid #3C5D9D; background-color: white;"
                        required />
                </div>

                <div style="margin-bottom: 1rem;">
                    <x-label for="password_confirmation" value="Confirmar Contraseña" style="display: none;" />
                    <x-input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirmar Contraseña"
                        style="width: 100%; padding: 0.5rem; border-radius: 0.375rem; border: 1px solid #3C5D9D; background-color: white;"
                        required />
                </div>

                <div style="margin-bottom: 1rem;">
                    <x-label for="security_question_id" value="Pregunta de seguridad" style="display: none;" />
                    <select
                        id="security_question_id"
                        name="security_question_id"
                        style="width: 100%; padding: 0.5rem; border-radius: 0.375rem; border: 1px solid #3C5D9D; background-color: white;"
                        required>
                        <option value="">Pregunta de seguridad</option>
                        @foreach(\App\Models\SecurityQuestion::all() as $question)
                        <option value="{{ $question->id }}" {{ old('security_question_id') == $question->id ? 'selected' : '' }}>
                            {{ $question->question }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <x-label for="security_answer" value="Respuesta" style="display: none;" />
                    <x-input
                        id="security_answer"
                        type="text"
                        name="security_answer"
                        placeholder="Respuesta"
                        style="width: 100%; padding: 0.5rem; border-radius: 0.375rem; border: 1px solid #3C5D9D; background-color: white;"
                        required />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div style="margin-bottom: 1rem; display: flex; align-items: center;">
                    <x-checkbox name="terms" id="terms" required style="margin-right: 0.5rem; border: 1px solid #3C5D9D; border-radius: 0.25rem;" />
                    <label for="terms" style="font-size: 0.875rem; color: #3C5D9D;">
                        {!! __('Acepto los :terms_of_service y la :privacy_policy', [
                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" style="text-decoration: underline; color: #3C5D9D;">Términos de Servicio</a>',
                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" style="text-decoration: underline; color: #3C5D9D;">Política de Privacidad</a>',
                        ]) !!}
                    </label>
                </div>
                @else
                <div style="margin-bottom: 1rem; display: flex; align-items: center;">
                    <x-checkbox name="terms" id="terms" required style="margin-right: 0.5rem; border: 1px solid #3C5D9D; border-radius: 0.25rem;" />
                    <label for="terms" style="font-size: 0.875rem; color: #3C5D9D;">
                        Acepto la Política de privacidad
                    </label>
                </div>
                @endif

                <div>
                    <x-button style="width: 100%; padding: 0.5rem; background-color: #3C5D9D; color: white; border-radius: 0.375rem; font-weight: 500;">
                        Registrarse
                    </x-button>
                </div>

                <div style="display: flex; justify-content: center; margin-top: 1rem;">
                    <a href="{{ route('login') }}" style="color: #3C5D9D; text-decoration: none; font-size: 0.875rem;">
                        Ya tengo una cuenta
                    </a>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>