<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\Access_log;
use App\Models\Notification;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class LoginRateLimiting
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->email . $request->ip();
        $maxAttempts = 5;
        $decayMinutes = 3;
        $user = User::where('email', $request->email)->first();

        // Registrar el intento de acceso
        $accessLog = new Access_log([
            'user_id' => $user?->id,
            'email_attempted' => $request->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'attempted_at' => now(),
            'success' => false
        ]);
        $accessLog->save();

        // Verificar si la cuenta está bloqueada
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);

            // Verificar si es el intento que causa el bloqueo
            if ($user && RateLimiter::attempts($key) == $maxAttempts) {
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'account_locked',
                    'message' => "Tu cuenta ha sido bloqueada por demasiados intentos fallidos. Podrás intentar nuevamente en {$minutes} minutos.",
                    'notified_at' => now(),
                    'read' => false,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]);
            }
            
            return back()->withInput()->withErrors([
                'email' => [__("Too many login attempts. Please try again in {$minutes} minutes.")],
            ]);
        }

        $response = $next($request);

        if ($response->status() === 302 && !session()->has('errors')) {
            $accessLog->success = true;
            $accessLog->save();
        } else if ($response->status() === 302 && session()->has('errors')) {
            RateLimiter::hit($key, $decayMinutes * 60);
        }

        return $response;
    }
} 