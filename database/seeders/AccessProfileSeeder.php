<?php

namespace Database\Seeders;

use App\Models\AccessProfile;
use Illuminate\Database\Seeder;

class AccessProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccessProfile::updateOrCreate(
            ['name' => __('Administrador')],
            ['active' => true],
            ['system_profile' => true],
            ['key' => 'admin']);

        AccessProfile::updateOrCreate(
            ['name' => __('Parceiro')],
            ['active' => true],
            ['system_profile' => true],
            ['key' => 'partner']);

        AccessProfile::updateOrCreate(
            ['name' => __('Corretor')],
            ['active' => true],
            ['system_profile' => true],
            ['key' => 'broker']);

        AccessProfile::updateOrCreate(
            ['name' => __('Financeiro')],
            ['active' => true],
            ['system_profile' => true],
            ['key' => 'financial']);

        AccessProfile::updateOrCreate(
            ['name' => __('Jurídico')],
            ['active' => true],
            ['system_profile' => true],
            ['key' => 'legal']);
    }
}
