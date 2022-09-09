<button @click.stop="sidebarOpen = !sidebarOpen" class="md:hidden focus:outline-none pl-1 pt-4 pr-2">
    <svg class="w-6 transition ease-in-out duration-150 text-white" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
        fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>

<div class="py-4">
    <a href="{{ route('admin') }}" class="text-gray-100 font-bold">
        @php
            //cache the logo setting to reduce calling the database
            $applicationLogo = Cache::rememberForever('applicationLogo', function () {
                return \App\Models\Setting::where('key', 'applicationLogo')->value('value');
            });

            $applicationLogoDark = Cache::rememberForever('applicationLogoDark', function () {
                return \App\Models\Setting::where('key', 'applicationLogoDark')->value('value');
            });
        @endphp

        @if (storage_exists($applicationLogo))
            <picture>
                <source srcset="{{ storage_url($applicationLogoDark) }}" media="(prefers-color-scheme: dark)">
                <img src="{{ storage_url($applicationLogo) }}" alt="{{ config('app.name') }}">
            </picture>
        @else
            Gestor
        @endif
    </a>
</div>

<x-nav.link route="dashboard" icon="fas fa-home">Dashboard</x-nav.link>
@can('ver_configuracoes')
    <x-nav.group label="Configurações" route="admin.settings" icon="fas fa-cogs">
        @can('ver_auditoria')
            <x-nav.group-item route="admin.settings.audit-trails.index" icon="far fa-circle">Auditoria
            </x-nav.group-item>
        @endcan
        @can('ver_emails_enviados')
            <x-nav.group-item route="admin.settings.sent-emails" icon="far fa-circle">E-mails enviados
            </x-nav.group-item>
        @endcan
        @can('ver_configuracoes_sistema')
            <x-nav.group-item route="admin.settings" icon="far fa-circle">Configurações</x-nav.group-item>
        @endcan
        @can('ver_perfis')
            <x-nav.group-item route="admin.settings.roles.index" icon="far fa-circle">Permissões de Usuários
            </x-nav.group-item>
        @endcan
    </x-nav.group>
@endcan

@can('ver_usuarios')
    <x-nav.link route="admin.users.index" icon="fas fa-users">Usuários</x-nav.link>
@endcan
@can('ver_grupos')
    <x-nav.link route="grupos.index" icon="fas fa-arrow-right">Grupos</x-nav.link>
@endcan
@can('ver_departamentos')
    <x-nav.link route="departamentos.index" icon="fas fa-arrow-right">Departamentos</x-nav.link>
@endcan
@can('ver_atividades')
    <x-nav.link route="atividades.index" icon="fas fa-arrow-right">Atividades</x-nav.link>
@endcan
@can('ver_empresas')
    <x-nav.link route="empresas.index" icon="fas fa-arrow-right">Empresas</x-nav.link>
@endcan
<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
    class="flex text-white mt-10 items-center px-2 py-2 my-2 hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-100 hover:text-gray-800 rounded-md cursor-pointer">
    <i class="fas fa-sign-out-alt mr-1"></i> Sair do sistema</a>
