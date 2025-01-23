<x-app-layout>
    <div class="flex justify-center items-start">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <form action="{{ route('permisos.update') }}" method="POST">
                @csrf
                @method('PUT')

                <ul class="space-y-4">
                    @foreach ($permisos as $permiso)
                    <li class="flex justify-between items-center border-b border-gray-200 pb-4">
                        <div class="flex-1 pr-4">
                            <p class="text-sm text-gray-700">{{ $permiso->descripcion }}</p>
                        </div>
                
                        <!-- Hidden input to handle unchecked checkboxes -->
                        <input type="hidden" name="permisos[{{ $permiso->id }}]" value="0">
                
                        <!-- Checkbox with additional condition for 'active' -->
                        <x-checkbox 
                            name="permisos[{{ $permiso->id }}]" 
                            :value="1" 
                            :checked="isset($userPermisos[$permiso->id]) && $userPermisos[$permiso->id]->active"
                            class="mr-2 h-5 w-5 text-blue-500 focus:ring-blue-500 rounded-md" 
                        />
                    </li>
                @endforeach
                
                </ul>

                @if ($errors->any())
                    <div class="mt-4 bg-red-100 p-4 rounded-md text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mt-6 pt-4 flex justify-center">
                    <x-button type="submit" class="w-auto bg-blue-600 text-white p-3 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Guardar Permisos
                    </x-button>
                </div>
                @if (session('saved'))
    <div id="saved-message" class="text-sm text-gray-600 pt-1 flex justify-center">
        {{ session('saved') }}
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtiene el elemento del mensaje
            const message = document.getElementById('saved-message');
            
            if (message) {
                // Establece un temporizador para iniciar la animación
                setTimeout(function() {
                    message.style.transition = 'opacity 1.5s ease-out';  // Define la duración y el tipo de transición
                    message.style.opacity = 0;  // Cambia la opacidad a 0 para hacer que se opaque
                }, 1000); // El mensaje comenzará a desvanecerse después de 3 segundos
                
                // Oculta el mensaje completamente después de que termine la animación
                setTimeout(function() {
                    message.style.display = 'none';
                }, 2000); // 4500ms corresponde a 3 segundos + 1.5 segundos de la animación
            }
        });
    </script>
@endif     
            </form>
        </div>
    </div>
    

</x-app-layout>
