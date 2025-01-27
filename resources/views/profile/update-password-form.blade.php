<div>
    <x-form-section submit="updatePassword">
        <x-slot name="title">
            {{ __('Actualizar Contraseña') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Asegúrese de que su cuenta esté usando una contraseña segura.') }}
        </x-slot>

        <x-slot name="form">
            <!-- Campo: Contraseña Actual -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="current_password" value="{{ __('Contraseña Actual') }}" style="color: #3C5D9D; font-weight: 500;" />
                <x-input
                    id="current_password"
                    type="password"
                    placeholder="Contraseña Actual"
                    wire:model="state.current_password"
                    autocomplete="current-password" />
                <x-input-error for="current_password" class="mt-2" />
            </div>

            <!-- Campo: Nueva Contraseña -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="password" value="{{ __('Nueva Contraseña') }}" style="color: #3C5D9D; font-weight: 500;" />
                <x-input
                    id="password"
                    type="password"
                    placeholder="Nueva Contraseña"
                    wire:model="state.password"
                    autocomplete="new-password" />
                <x-input-error for="password" class="mt-2" />
            </div>

            <!-- Campo: Confirmar Contraseña -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" style="color: #3C5D9D; font-weight: 500;" />
                <x-input
                    id="password_confirmation"
                    type="password"
                    placeholder="Confirmar Contraseña"
                    wire:model="state.password_confirmation"
                    autocomplete="new-password" />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="saved" style="color: #3C5D9D;">
                {{ __('Guardado.') }}
            </x-action-message>

            <x-button style="background-color: #3C5D9D; color: white;">
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>