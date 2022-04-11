<?php

namespace Database\Seeders;

use App\Models\AccessProfile;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AccessProfileSeeder::class,
            PermissionSeeder::class
        ]);

         if (!User::where('email', env('DEFAULT_ADMIN_EMAIL'))->exists()) {
             User::create(
                 [
                     'name' => __('Administrador'),
                     'email' => env('DEFAULT_ADMIN_EMAIL'),
                     'email_verified_at' => now(),
                     'password' => Hash::make(env('DEFAULT_ADMIN_PASSWORD', 'P@$$w0rd')),
                     'user_type' => 'admin',
                     'user_status' => 'active',
                 ]);
         }

         $accessProfile = AccessProfile::updateOrCreate(
             ['name' => __('Administrador')],
             ['active' => true]);

         $user = User::where('email', env('DEFAULT_ADMIN_EMAIL'))->first();

         if ($user != null) {
             $user->access_profile_id = $accessProfile->id;
             $user->save();
         }

        $accessProfile->permissions()->sync(Permission::select('id')->where('active', true)->get());
    }
}
