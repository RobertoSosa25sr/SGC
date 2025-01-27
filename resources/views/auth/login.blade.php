@php
use Illuminate\Support\Facades\RateLimiter;
use App\Providers\RouteServiceProvider;
@endphp

<x-guest-layout>
    <x-authentication-card>

        <h1 class="text-center text-2xl font-bold mb-6 text-[#3C5D9D]">
            Sistema de Gestión de Consentimientos<br>SGC
        </h1>

        <h2 class="text-center text-xl mb-6 text-[#3C5D9D]">INICIAR SESIÓN</h2>

        <x-validation-errors class="mb-4" />

        @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input id="email"
                    class="block mt-1 w-full rounded-md border-gray-300"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Correo" />
            </div>

            <div class="mt-4">
                <x-input id="password"
                    class="block mt-1 w-full rounded-md border-gray-300"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Contraseña" />
            </div>

            <div class="mt-6">
                <x-button class="w-full justify-center bg-[#3C5D9D] hover:bg-[#2C4B8B]">
                    {{ __('Iniciar sesión') }}
                </x-button>
            </div>

            <div class="flex flex-col items-center justify-center mt-4 space-y-2">
                @if (Route::has('password.request'))
                <a class="text-sm text-[#3C5D9D] hover:text-[#2C4B8B]" href="{{ route('password.request') }}">
                    {{ __('Olvidé mi contraseña') }}
                </a>
                @endif

                @if (Route::has('register'))
                <a class="text-sm text-[#3C5D9D] hover:text-[#2C4B8B]" href="{{ route('register') }}">
                    {{ __('Registrarse') }}
                </a>
                @endif
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>