<div>
    <x-form-section submit="updatePassword">
        <x-slot name="title">
            {{ __('Update Password') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Ensure your account is using a strong password.') }}
        </x-slot>

        <x-slot name="form">
            <!-- Campo: Current Password -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="current_password" value="{{ __('Current Password') }}" class="font-medium" />
                <x-input
                    id="current_password"
                    type="password"
                    placeholder="Current Password"
                    wire:model="state.current_password"
                    autocomplete="current-password" />
                <x-input-error for="current_password" class="mt-2" />
            </div>

            <!-- Campo: New Password -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="password" value="{{ __('New Password') }}" class="font-medium" />
                <x-input
                    id="password"
                    type="password"
                    placeholder="New Password"
                    wire:model="state.password"
                    autocomplete="new-password" />
                <x-input-error for="password" class="mt-2" />
            </div>

            <!-- Campo: Confirm Password -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="font-medium" />
                <x-input
                    id="password_confirmation"
                    type="password"
                    placeholder="Confirm Password"
                    wire:model="state.password_confirmation"
                    autocomplete="new-password" />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button wire:loading.attr="disabled" wire:target="photo">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>