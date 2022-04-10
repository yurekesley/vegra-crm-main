<?php

namespace App\Http\Controllers;

use App\Models\AccessProfile;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $pageSize = $request->query('page_size') ?? 8;
        $filter = $request->query('filter');

        if (auth()->user()->user_type == 'partner') {
            if (!empty($filter)) {
                $partners = Partner::withCount('users')
                    ->sortable('email')
                    ->where('user_id', auth()->id())
                    ->where('name', 'like', '%' . $filter . '%')
                    ->orWhere('email', 'like', '%' . $filter . '%')
                    ->orWhere('cnpj', 'like', '%' . $filter . '%')
                    ->paginate($pageSize);
            } else {
                $partners = Partner::withCount('users')
                    ->sortable('email')
                    ->where('user_id', auth()->id())
                    ->paginate($pageSize);
            }
        } else {
            if (!empty($filter)) {
                $partners = Partner::withCount('users')
                    ->sortable('email')
                    ->where('name', 'like', '%' . $filter . '%')
                    ->orWhere('email', 'like', '%' . $filter . '%')
                    ->orWhere('cnpj', 'like', '%' . $filter . '%')
                    ->paginate($pageSize);
            } else {
                $partners = Partner::withCount('users')
                    ->sortable('email')
                    ->paginate($pageSize);
            }
        }

        return view('partners.index', compact('partners', 'filter', 'pageSize'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        $accessProfiles = AccessProfile::where('active', 'true')->get();
        return view('partners.edit', compact('partner', 'accessProfiles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnerRequest  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20'],
            'cnpj' => ['required', 'string', 'max:14', 'cnpj', 'unique:partners,cnpj,' . $partner->id],
            'creci' => ['required', 'string', 'max:20'],
            'access_profile_id' => ['required', 'not_in:0'],
            'user_status' => ['required', 'in:pending,active,inactive'],
        ]);

        $user = User::find($partner->user_id);

        DB::transaction(function () use ($request, $partner, $user) {
            $partner->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'whatsapp' => $request->whatsapp ?? false,
                'responsible' => $request->responsible,
                'cnpj' => $request->cnpj,
                'creci' => $request->creci,
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'whatsapp' => $request->whatsapp ?? false,
                'creci' => $request->creci,
                'user_status' => $request->user_status,
                'access_profile_id' => $user->id == auth()->id() ? $user->access_profile_id : $request->access_profile_id,
            ]);
        });

        Alert::success('Sucesso', 'Parceiro alterado com sucesso!');

        return redirect()->route('partners.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartnerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function approvePartner(Partner $partner)
    {
        $user = User::find($partner->user_id);
        if ($user != null) {
            $user->approve();
            $user->save();
        }

        Alert::success('Sucesso', 'Parceiro aprovado com sucesso!');

        return redirect()->route('partners.index');
    }
}
