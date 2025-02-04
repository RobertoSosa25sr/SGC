@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">
            <span style="font-weight: bold;">{{ $title }}</span>
        </x-slot>
        <x-slot name="description">
            <span style="color: #666;">{{ $description }}</span>
        </x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">
            <div style="padding: 1.5rem; background-color: white; border-radius: 0.5rem;">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
            <div style="display: flex; justify-content: flex-end; align-items: center; padding: 1rem; background-color: #f8f9fa; border-radius: 0 0 0.5rem 0.5rem; border-top: none;">
                {{ $actions }}
            </div>
            @endif
        </form>
    </div>
</div>
