<?php

namespace App\Http\Controllers;

use App\Models\Gdpr;
use App\Models\Partner;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class WelcomeController extends Controller
{
    public function index()
    {
        $gdpr = Gdpr::where('type', 'real_state_registration')->first();
        return view('welcome.index')
            ->with('products', Product::where('show_for_customers', true)->get())
            ->with('gdpr', $gdpr);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'responsible' => ['required', 'string', 'max:100'],
            'cnpj' => ['required', 'string', 'max:14', 'cnpj', 'unique:partners,cnpj'],
            'creci' => ['required', 'string', 'max:20'],
            'accept_terms' => ['required', 'accepted'],
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(Str::random(10)),
                'user_type' => 'partner',
                'user_status' => 'pending',
            ]);

            Partner::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'responsible' => $request->responsible,
                'cnpj' => $request->cnpj,
                'creci' => $request->creci,
                'user_id' => $user->id,
            ]);

            event(new Registered($user));
        });

        Alert::success('Verifique seu email', 'Seu registro foi realizado com sucesso! Verifique seu email para confirmação.');

        return redirect()->route('welcome');
    }
}
