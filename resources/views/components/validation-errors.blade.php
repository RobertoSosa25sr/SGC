@if ($errors->any())
<div {{ $attributes->merge(['style' => 'margin-bottom: 1rem; padding: 1rem; border-radius: 0.375rem; background-color: #FEE2E2; border: 1px solid #DC2626;']) }}>
    <div style="color: #DC2626; font-weight: 500; margin-bottom: 0.5rem;">
        {{ __('¡Ups! Algo salió mal.') }}
    </div>
    <ul style="list-style-type: disc; list-style-position: inside; font-size: 0.875rem; color: #DC2626;">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif