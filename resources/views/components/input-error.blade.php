@props(['for'])

@error($for)
<p {{ $attributes->merge(['style' => 'color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;']) }}>
    {{ $message }}
</p>
@enderror