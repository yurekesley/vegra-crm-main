<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmailVerificationRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\DB;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        $user = User::find($request->id);

        if ($user->hasVerifiedEmail() && $user->user_status != 'pending') {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        if ($user->user_type == 'admin' || $user->user_type == 'broker') {
            $user->approve();
            $user->save();
        }

        $token = app('auth.password.broker')->createToken($user);

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        if ($user != null) {
            $link = config('base_url') . 'reset-password/' . $token . '?email=' . urlencode($user->email);
            return redirect($link)->with('status', 'Cadastre agora sua senha.');
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
