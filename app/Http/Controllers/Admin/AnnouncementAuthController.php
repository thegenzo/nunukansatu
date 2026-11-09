<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AnnouncementAuthController extends Controller
{
    public function create()
    {
        return Auth::guard('web')->user()?->is_admin
            ? redirect()->route('admin.announcements.index')
            : response()->view('admin.announcements.login')->header('Cache-Control', 'no-store');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:1024'],
            'remember' => ['sometimes', 'boolean'],
        ]);
        $credentials = ['email' => Str::lower($credentials['email']), 'password' => $credentials['password'], 'is_admin' => true];
        $key = 'announcement-login:'.hash('sha256', $credentials['email'].'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages(['email' => 'Terlalu banyak percobaan. Coba lagi dalam '.RateLimiter::availableIn($key).' detik.']);
        }

        if (! Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::hit($key, 300);
            throw ValidationException::withMessages(['email' => 'Email atau kata sandi tidak sesuai.']);
        }

        RateLimiter::clear($key);
        $request->session()->regenerate();
        $request->session()->put('announcement_admin_password_hash', Auth::guard('web')->user()->getAuthPassword());

        return redirect()->route('admin.announcements.index');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
