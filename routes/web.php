<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Features;
use App\Http\Middleware\LoginRateLimiting;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AccessLogsController;
use App\Http\Controllers\PermisoController;

use App\Livewire\Auth\ForgotPassword;

Route::get('/forgot-password', ForgotPassword::class)
    ->name('password.request')
    ->middleware('guest');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/politica-privacidad', function () {
        $policy = file_get_contents(resource_path('markdown/policy.md'));
        return view('politica-privacidad', [
            'policy' => Str::markdown($policy)
        ]);
    })->name('politica-privacidad');

    Route::get('/permisos', function () {
        return view('permisos');
    })->name('permisos');

    // Ruta para obtener el historial (mostrar registros)
    Route::get('/historial', [AccessLogsController::class, 'index'])
        ->name('historial');

    // Ruta para actualizar el campo 'read' en un registro específico
    Route::middleware('auth')->group(function () {
        Route::put('/notificaciones/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
        Route::put('/historial/{accessLog}/mark-as-read', [AccessLogsController::class, 'markAsRead'])->name('accessLogs.markAsRead');
    });

    Route::get('/notificaciones', [NotificationController::class, 'index'])
        ->name('notificaciones');

    Route::get('/permisos', [PermisoController::class, 'index'])->name('permisos');

    Route::put('/permisos', [PermisoController::class, 'update'])->name('permisos.update');
});

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware(['guest', LoginRateLimiting::class])
    ->name('login');
