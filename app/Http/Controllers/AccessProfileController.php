<?php

namespace App\Http\Controllers;

use App\Models\AccessProfile;
use App\Models\Permission;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AccessProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageSize = $request->query('page_size') ?? 8;
        $filter = $request->query('filter');

        $profiles = AccessProfile::sortable('name');

        if (!empty($filter)) {
            $profiles = $profiles->where('name', 'like', '%' . $filter . '%');
        }

        $profiles = $profiles->paginate($pageSize);

        return view('access_profiles.index', compact('profiles', 'filter', 'pageSize'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::where('active', true)->orderBy('name')->get();

        return view('access_profiles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccessProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:access_profiles,name',
            'permissions' => 'required|min:1',
            'active' => 'required|in:true,false',
        ]);

        $accessProfile = AccessProfile::create([
            'name' => $request->name,
            'active' => $request->active,
        ]);

        $accessProfile->permissions()->attach($request->permissions);

        Alert::success('Sucesso', 'Perfil de acesso criado com sucesso!');

        return redirect()->route('access_profiles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccessProfile  $accessProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(AccessProfile $accessProfile)
    {
        $permissions = Permission::where('active', true)->orderBy('name')->get();

        return view('access_profiles.edit', compact('accessProfile', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccessProfileRequest  $request
     * @param  \App\Models\AccessProfile  $accessProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccessProfile $accessProfile)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:access_profiles,name',
            'permissions' => 'required|min:1',
            'active' => 'required|in:true,false',
        ]);

        $accessProfile->name = $request->name;
        $accessProfile->active = $request->active;
        $accessProfile->save();

        $accessProfile->permissions()->sync($request->permissions);

        Alert::success('Sucesso', 'Perfil de acesso modificado com sucesso!');

        return redirect()->route('access_profiles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccessProfile  $accessProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccessProfile $accessProfile)
    {
        $accessProfile->delete();

        Alert::success('Sucesso', 'Perfil de acesso removido com sucesso');

        return redirect()->route('access_profiles.index');
    }
}
