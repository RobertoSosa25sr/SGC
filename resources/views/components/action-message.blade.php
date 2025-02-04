@props(['on'])

<div x-data="{ shown: false, timeout: null }"
    x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
    x-show.transition.out.opacity.duration.1500ms="shown"
    x-transition:leave.opacity.duration.1500ms
    style="display: none; color: #3C5D9D; font-size: 0.875rem;"
    {{ $attributes }}>
    {{ $slot->isEmpty() ? 'Guardado.' : $slot }}
</div>