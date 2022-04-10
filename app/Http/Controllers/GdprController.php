<?php

namespace App\Http\Controllers;

use App\Models\Gdpr;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GdprController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $real_state_registration = Gdpr::where('type', 'real_state_registration')->first();
        $broker_registration = Gdpr::where('type', 'broker_registration')->first();
        $privacy = Gdpr::where('type', 'privacy')->first();
        return view('gdpr.index')
            ->with('products', $products)
            ->with('real_state_registration', $real_state_registration)
            ->with('broker_registration', $broker_registration)
            ->with('privacy', $privacy);
    }

    public function store(Request $request)
    {
        $real_state_registration = Gdpr::where('type', 'real_state_registration')->first();
        $broker_registration = Gdpr::where('type', 'broker_registration')->first();
        $privacy = Gdpr::where('type', 'privacy')->first();

        if ($real_state_registration != null) {
            $real_state_registration->content = $request->real_state_registration;
            $real_state_registration->save();
        } else {
            $real_state_registration = Gdpr::create([
                'type' => 'real_state_registration',
                'content' => $request->real_state_registration
            ]);
        }

        if ($broker_registration != null) {
            $broker_registration->content = $request->broker_registration;
            $broker_registration->save();
        } else {
            $broker_registration = Gdpr::create([
                'type' => 'broker_registration',
                'content' => $request->broker_registration
            ]);
        }

        if ($privacy != null) {
            $privacy->content = $request->privacy;
            $privacy->save();
        } else {
            $privacy = Gdpr::create([
                'type' => 'privacy',
                'content' => $request->privacy
            ]);
        }

        Alert::success('Sucesso', 'Dados de LGPD atualizados com sucesso');

        return redirect()->route('gdpr.index');
    }
}
