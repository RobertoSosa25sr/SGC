<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthenticatedSessionController extends Controller
{
    protected function attemptLogin(Request $request)
    {
        $attempts = session('login_attempts', 0) + 1;
        session(['login_attempts' => $attempts]);
        
        // ... rest of login logic
    }
} 