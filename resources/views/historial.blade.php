<x-app-layout>
    <div class="flex justify-center items-start">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            @if ($accessLogs->isEmpty())
                <p class="text-center text-gray-500">No hay registros de acceso.</p>
            @else
                <ul class="space-y-2">
                    @foreach ($accessLogs as $log)
                        <li class="flex justify-between items-center border-b border-gray-200 pb-2">
                            <div class="flex-1 pr-4">
                                <p class="text-sm">
                                    <span class="{{ $log->success ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $log->success ? 'Acceso Exitoso' : 'Acceso Fallido' }} 
                                        <small class="text-gray-500 text-xs mr-4"> - {{ $log->attempted_at->format('d/m/Y H:i') }}</small> 
                                    </span>
                                </p>
                            </div>
                            <form action="{{ route('accessLogs.markAsRead', $log->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-gray-600 hover:text-red-600 transition-colors duration-300">
                                    <i class="fas fa-trash hover:text-red-600 transition-colors duration-300"></i> <!-- Ícono de basura -->
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
