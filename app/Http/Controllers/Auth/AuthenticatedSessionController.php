<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_status' => 'active'])) {
            RateLimiter::hit($request->throttleKey());

            $user = User::where('email', $request->email)->first();

            if ($user != null && $user->user_status == 'pending') {
                Alert::error('Acesso negado', __('auth.notapproved'));
                return redirect()
                    ->back()
                    ->withInput();
            }

            Alert::error('Acesso negado', __('auth.failed'));
            return redirect()
                ->back()
                ->withInput();
        }

        RateLimiter::clear($request->throttleKey());

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
