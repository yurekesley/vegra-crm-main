<?php

namespace App\Http\Controllers;

use App\Models\AccessProfile;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $pageSize = $request->query('page_size') ?? 8;
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $users = User::sortable('email')
                ->where('user_type', 'admin')
                ->where('name', 'like', '%' . $filter . '%')
                ->orWhere('email', 'like', '%' . $filter . '%')
                ->orWhere('cpf', 'like', '%' . $filter . '%')
                ->paginate($pageSize);
        } else {
            $users = User::sortable('email')
                ->where('user_type', 'admin')
                ->paginate($pageSize);
        }

        return view('users.index', compact('users', 'filter', 'pageSize'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profiles = AccessProfile::where('active', 'true')->get();
        $users = User::where('user_type', 'admin')->where('user_status', 'active')->get();
        return view("users.create", compact('profiles', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => ['nullable', 'string', 'max:20'],
            'cpf' => ['nullable', 'string', 'max:11', 'cpf', 'unique:users,cpf'],
            'creci' => ['nullable', 'string', 'max:20'],
            'access_profile' => ['required', 'not_in:0'],
            'manager' => $request->manager != 'null' ? 'nullable|exists:users,id,user_type,admin,user_status,active' : 'nullable',
            'director' => $request->director != 'null' ? 'nullable|exists:users,id,user_type,admin,user_status,active' : 'nullable',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(Str::random(10)),
            'user_type' => 'admin',
            'user_status' => 'pending',
            'whatsapp' => $request->whatsapp ?? false,
            'access_profile_id' => $request->access_profile,
            'cpf' => $request->cpf,
            'creci' => $request->creci,
            'phone' => $request->phone,
            'manager_id' => $request->manager == 'null' ? null : $request->manager,
            'director_id' => $request->director == 'null' ? null : $request->director,
        ]);

        event(new Registered($user));

        Alert::success('Sucesso', 'Usuário convidado com sucesso');

        return redirect()->route('users.index', ['filter' => $user->email]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $accessProfiles = AccessProfile::where('active', 'true')->get();
        $users = User::where('user_type', 'admin')->where('user_status', 'active')->where('id', '!=', $user->id)->get();
        return view('users.edit', compact('user', 'accessProfiles', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20'],
            'cpf' => ['required', 'string', 'max:11', 'cpf', 'unique:users,cpf,' . $user->id],
            'creci' => ['required', 'string', 'max:20'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'access_profile_id' => ['required', 'not_in:0'],
            'user_status' => $user->user_status == 'pending' ? [] : ['required', 'in:pending,active,inactive'],
            'manager' => $request->manager != 'null' ? 'nullable|exists:users,id,user_type,admin,user_status,active' : 'nullable',
            'director' => $request->director != 'null' ? 'nullable|exists:users,id,user_type,admin,user_status,active' : 'nullable',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->cpf = $request->cpf;
        $user->creci = $request->creci;
        $user->access_profile_id = $request->access_profile_id;
        $user->user_status = $user->user_status == 'pending' ? $user->user_status : $request->user_status;
        $user->manager_id = $request->manager == 'null' ? null : $request->manager;
        $user->director_id = $request->director == 'null' ? null : $request->director;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        Alert::success('Sucesso', 'Usuário atualizado com sucesso');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->email == 'admin@vegra.com.br') {
            Alert::error('Falha', 'Usuário ADMIN não pode ser removido do sistema');
            return redirect()->route('users.index');
        }

        $user->delete();

        Alert::success('Sucesso', 'Usuário removido com sucesso');

        return redirect()->route('users.index');
    }
}
