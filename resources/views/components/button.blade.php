<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center justify-center px-4 py-2 bg-[#3C5D9D] border border-transparent rounded-md font-semibold text-white tracking-widest hover:bg-[#2C4B8B] focus:outline-none focus:ring-2 focus:ring-[#3C5D9D] focus:ring-offset-2 transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>