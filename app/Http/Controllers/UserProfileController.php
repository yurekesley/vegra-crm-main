<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\ImageManagerStatic as Image;

class UserProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->id());

        if ($user->user_type == 'partner') {
            $partner = Partner::where('user_id', $user->id)->first();
            return view('user_profile.partner', compact('partner', 'user'));
        }

        return view('user_profile.user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->type == 'partner') {
            $request->validate([
                'name' => 'required|string|max:100',
                'phone' => 'required|string|max:20',
                'responsible' => 'required|string|max:100',
                'creci' => 'required|string|max:20',
                'password' => ['nullable', 'confirmed', Password::defaults()],
                'picture_url' => 'sometimes|image|max:2048|mimes:jpg,jpeg,png',
            ]);

            $user = User::find(auth()->id());
            $partner = Partner::where('user_id', $user->id)->first();

            $path = null;
            if ($request->hasFile('picture_url')) {
                $file = $request->file('picture_url');

                $img = Image::make($file);
                $img = $img->resize(128, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img = $img->encode($file->getClientOriginalExtension());

                $name = uniqid() . '_user_profile_' . auth()->id() . '.' . $file->getClientOriginalExtension();
                $filePath = 'user_profiles/' . $name;
                Storage::disk('s3')->put($filePath, $img, 'public');
                $path = Storage::disk('s3')->url($filePath);
            }

            DB::transaction(function () use ($request, $user, $partner, $path) {
                $partner->name = $request->name;
                $partner->phone = $request->phone;
                $partner->responsible = $request->responsible;
                $partner->creci = $request->creci;
                $partner->cnpj = $request->cnpj;
                $partner->whatsapp = $request->whatsapp ?? false;

                $partner->save();

                $user->name = $request->name;

                if ($path != null) {
                    $user->picture_url = $path;
                }

                if (!empty($request->password)) {
                    $user->password = Hash::make($request->password);
                }

                $user->save();

                Auth::setUser($user);
            });
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'phone' => ['required', 'string', 'max:20'],
                'cpf' => ['required', 'string', 'max:11', 'cpf', 'unique:users,cpf,' . auth()->id()],
                'creci' => ['required', 'string', 'max:20'],
                'password' => ['nullable', 'confirmed', Password::defaults()],
                'picture_url' => 'sometimes|image|max:2048|mimes:jpg,jpeg,png',
            ]);

            $path = null;
            if ($request->hasFile('picture_url')) {
                $file = $request->file('picture_url');

                $img = Image::make($file);
                $img = $img->resize(128, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img = $img->encode($file->getClientOriginalExtension());

                $name = uniqid() . '_user_profile_' . auth()->id() . '.' . $file->getClientOriginalExtension();
                $filePath = 'user_profiles/' . $name;
                Storage::disk('s3')->put($filePath, $img, 'public');
                $path = Storage::disk('s3')->url($filePath);
            }

            $user = User::find(auth()->id());

            DB::transaction(function () use ($request, $user, $path) {
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->creci = $request->creci;
                $user->cpf = $request->cpf;
                $user->whatsapp = $request->whatsapp ?? false;
                if (!empty($request->password)) {
                    $user->password = Hash::make($request->password);
                }
                if ($path != null) {
                    $user->picture_url = $path;
                }

                $user->save();

                Auth::setUser($user);
            });
        }

        return redirect()->route('user_profile.index');
    }
}
