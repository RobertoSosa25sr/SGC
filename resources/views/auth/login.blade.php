<x-guest-layout>
    <x-authentication-card>
        <div style="text-align: center; margin-bottom: 2rem; ">
            <h1 style="font-size: 3.5rem; color: #3C5D9D; font-weight: bold; margin-bottom: 1.5rem;">
                Sistema de Gestión de Consentimientos (SGC)
            </h1>
        </div>

        <div style="display: flex; justify-content: center; align-items: center;">
            <form method="POST" action="{{ route('login') }}" style="width: 100%; max-width: 400px; padding: 2rem; border: 2px solid #3C5D9D; border-radius: 0.5rem; background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                @csrf
                <h3 style="text-align: center; font-size: 1.5rem; color: #3C5D9D; font-weight: bold; margin-bottom: 1.5rem;">
                    INICIAR SESIÓN
                </h3>

                <div style="margin-bottom: 1rem;">
                    <x-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        placeholder="Correo"
                        style="width: 100%; padding: 0.5rem; border-radius: 0.375rem; border: 1px solid #3C5D9D; background-color: white;"
                        required
                        autofocus />
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <x-input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Contraseña"
                        style="width: 100%; padding: 0.5rem; border-radius: 0.375rem; border: 1px solid #3C5D9D; background-color: white;"
                        required />
                </div>

                <div>
                    <button type="submit" style="width: 100%; padding: 0.5rem; background-color: #3C5D9D; color: white; border-radius: 0.375rem; font-weight: 500;">
                        Iniciar sesión
                    </button>
                </div>

                <div style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem; margin-top: 1rem;">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="color: #3C5D9D; text-decoration: none; font-size: 0.875rem;">
                        Olvidé mi contraseña
                    </a>
                    @endif

                    <a href="{{ route('register') }}" style="color: #3C5D9D; text-decoration: none; font-size: 0.875rem;">
                        Registrarse
                    </a>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>