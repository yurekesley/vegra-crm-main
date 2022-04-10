<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::upsert([
            ['name' => __('Perfis de acesso'), 'key' => 'access_profiles', 'active' => true],
            ['name' => __('Usuários'), 'key' => 'users', 'active' => true],
            ['name' => __('Parceiros'), 'key' => 'partners', 'active' => true],
            ['name' => __('Corretores'), 'key' => 'brokers', 'active' => true],
            ['name' => __('Produtos'), 'key' => 'products', 'active' => true],
            ['name' => __('Espelhos de Venda'), 'key' => 'mirrors', 'active' => true],
            ['name' => __('LGPD'), 'key' => 'gdpr', 'active' => true],
            ['name' => __('Minutas'), 'key' => 'contract_templates', 'active' => true],
            ['name' => __('Pastas'), 'key' => 'prospects', 'active' => true],
            ['name' => __('Alterar status de pastas'), 'key' => 'prospects_status', 'active' => true],
            ['name' => __('Excluir pastas'), 'key' => 'prospects_delete', 'active' => true],
            ['name' => __('Códigos de propostas'), 'key' => 'codes', 'active' => true],
            ['name' => __('Mensagens do dashboard'), 'key' => 'board_messages', 'active' => true],
            ['name' => __('Propostas'), 'key' => 'proposals', 'active' => true],
            ['name' => __('Alterar status de propostas'), 'key' => 'proposals_status', 'active' => true],
            ['name' => __('Excluir propostas'), 'key' => 'proposals_delete', 'active' => true],
        ], ['key'], ['name', 'active']);
    }
}
