@section('title', 'Edit')
<div>
    <div class="mb-5">
        <a href="{{ route('admin.users.index') }}">Usuário</a>
        <span class="dark:text-gray-200">- Alterar dados do Usuário</span>
    </div>

    <livewire:admin.users.edit.profile :user="$user" />
    <livewire:admin.users.edit.change-password :user="$user" />
    <livewire:admin.users.edit.admin-settings :user="$user" />
    <livewire:admin.users.edit.roles :user="$user" />
</div>
