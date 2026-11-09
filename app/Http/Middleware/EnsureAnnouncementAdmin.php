<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAnnouncementAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $guard = Auth::guard('web');
        if (! $guard->check()) {
            if ($request->expectsJson()) {
                abort(401);
            }

            return redirect()->guest(route('admin.login'));
        }

        abort_unless($guard->user()->is_admin, 403);

        $sessionHash = $request->session()->get('announcement_admin_password_hash');
        $currentHash = $guard->user()->getAuthPassword();
        if ($sessionHash && ! hash_equals($currentHash, $sessionHash)) {
            $guard->logoutCurrentDevice();
            $request->session()->forget('announcement_admin_password_hash');

            return redirect()->route('admin.login')->withErrors(['email' => 'Kata sandi telah diganti. Silakan masuk kembali.']);
        }
        $request->session()->put('announcement_admin_password_hash', $currentHash);

        $response = $next($request);
        $response->headers->set('Cache-Control', 'no-store');

        return $response;
    }
}
