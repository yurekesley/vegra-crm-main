<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class BrokerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Partner $partner)
    {
        $pageSize = $request->query('page_size') ?? 8;
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $brokers = User::sortable('email')
                ->where('partner_id', $partner->id)
                ->where('user_type', 'broker')
                ->where('name', 'like', '%' . $filter . '%')
                ->orWhere('email', 'like', '%' . $filter . '%')
                ->paginate($pageSize);
        } else {
            $brokers = User::sortable('email')
                ->where('partner_id', $partner->id)
                ->where('user_type', 'broker')
                ->paginate($pageSize);
        }

        return view('partners.brokers.index', compact('brokers', 'partner', 'filter', 'pageSize'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Partner $partner)
    {
        return view("partners.brokers.create", compact('partner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Partner $partner, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => ['nullable', 'string', 'max:20'],
            'cpf' => ['nullable', 'string', 'max:11', 'cpf', 'unique:users,cpf'],
            'creci' => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(Str::random(10)),
            'user_type' => 'broker',
            'user_status' => 'pending',
            'whatsapp' => $request->whatsapp ?? false,
            'access_profile_id' => 1,
            'cpf' => $request->cpf,
            'creci' => $request->creci,
            'phone' => $request->phone,
            'partner_id' => $partner->id,
        ]);

        event(new Registered($user));

        Alert::success('Sucesso', 'Corretor convidado com sucesso');

        return redirect()->route('partners.brokers.index', ['partner' => $partner->id, 'filter' => $user->email]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner, User $broker)
    {
        return view('partners.brokers.edit', compact('partner', 'broker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Partner $partner, User $broker, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'cpf' => ['nullable', 'string', 'max:11', 'cpf', 'unique:users,cpf,' . $broker->id],
            'creci' => ['nullable', 'string', 'max:20'],
            'user_status' => $broker->user_status == 'pending' ? [] : ['required', 'in:pending,active,inactive'],
        ]);

        $broker->name = $request->name;
        $broker->phone = $request->phone;
        $broker->cpf = $request->cpf;
        $broker->creci = $request->creci;
        $broker->whatsapp = $request->whatsapp ?? false;
        $broker->user_status = $broker->user_status == 'pending' ? $broker->user_status : $request->user_status;

        $broker->save();

        Alert::success('Sucesso', 'Corretor atualizado com sucesso');

        return redirect()->route('partners.brokers.index', $partner->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner, User $broker)
    {
        $broker->delete();

        Alert::success('Sucesso', 'Corretor removido com sucesso');

        return redirect()->route('partners.brokers.index', $partner->id);
    }
}
