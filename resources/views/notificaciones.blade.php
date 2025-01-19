<x-app-layout>
    <div class="flex justify-center items-start ">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            @if ($notifications->isEmpty())
                <p class="text-center text-gray-500">No tienes notificaciones.</p>
            @else
                <ul class="space-y-2">
                    @foreach ($notifications as $notification)
                        <li class="flex justify-between items-center border-b border-gray-200 pb-2">
                            <div class="flex-1 pr-4"> <!-- Usa flex-1 para que el mensaje ocupe el espacio disponible -->
                                <p class="
                                    {{ $notification->type === 'account_locked' ? 'text-red-600' : '' }}
                                    {{ $notification->type === 'password_changed' ? 'text-green-600' : '' }}
                                    {{ $notification->type === 'policy_updated' ? 'text-orange-600' : '' }}
                                    {{ $notification->type !== 'profile_updated' && $notification->type !== 'account_locked' && $notification->type !== 'password_changed' && $notification->type !== 'policy_updated' ? 'text-gray-700' : '' }}
                                    text-sm">
                                    {{ $notification->message }}
                                    <small class="text-gray-500 text-xs mr-4">{{ $notification->notified_at->format('d/m/Y H:i') }}</small>
                                </p>
                            </div>
                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
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
