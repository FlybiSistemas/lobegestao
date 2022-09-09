<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class AppDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        // padrão do template. Alterei apenas o label
        Permission::firstOrCreate(['name' => 'ver_dashboard',               'description' => 'Ver Dashboard',             'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ver_pesquisa',                'description' => 'Ver pesquisa principal',    'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ver_configuracoes',           'description' => 'Ver configurações',         'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ver_configuracoes_sistema',   'description' => 'Ver configurações sistema', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ver_auditoria',               'description' => 'Ver auditoria',             'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ver_emails_enviados',         'description' => 'Ver e-mails enviados',      'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ver_usuarios',                'description' => 'Ver usuários',              'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ver_perfis',                  'description' => 'Ver perfil do usuário',     'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ver_atividades_de_usuarios',  'description' => 'Ver atividade do usuário',  'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'adicionar_usuarios',          'description' => 'Adicionar usuário',         'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'editar_usuarios',             'description' => 'Alterar usuário',           'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'editar_propria_conta',        'description' => 'Alterar a própria conta',   'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'excluir_usuarios',            'description' => 'Excluir usuário',           'guard_name' => 'web']);

        //nossas funções
        Permission::firstOrCreate(['name' => 'ver_grupos',          'description' => 'Ver grupos',          'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ver_departamentos',   'description' => 'Ver departamentos',   'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ver_atividades',      'description' => 'Ver atividades',      'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'ver_empresas',        'description' => 'Ver empresas',        'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'adicionar_empresas',  'description' => 'Adicionar empresas',  'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'editar_empresas',     'description' => 'Editar empresas',     'guard_name' => 'web']);

        Setting::firstOrCreate(['key' => 'app.name'], ['value' => 'Gestor']);
        Setting::firstOrCreate(['key' => 'applicationLogo'], ['value' => 'logo/A9dQcvFuzYLCVUfzrwqnSxN6RLKuCNDhjHwEVN3t.png']);
        Setting::firstOrCreate(['key' => 'applicationLogoDark'], ['value' => 'logo/A9dQcvFuzYLCVUfzrwqnSxN6RLKuCNDhjHwEVN3t.png']);
        Setting::firstOrCreate(['key' => 'loginLogo'], ['value' => 'logo/xbC28LrLRPgFQs3D4QEdTHnaJbGbT1QuCxnoxAAu.png']);
        Setting::firstOrCreate(['key' => 'loginLogoDark'], ['value' => 'logo/xbC28LrLRPgFQs3D4QEdTHnaJbGbT1QuCxnoxAAu.png']);
        Setting::firstOrCreate(['key' => 'ips'], ['value' => '[{"ip":"127.0.0.1","comment":"local"}]']);
        Setting::firstOrCreate(['key' => 'forced_2fa'], ['value' => '']);
    }
}
