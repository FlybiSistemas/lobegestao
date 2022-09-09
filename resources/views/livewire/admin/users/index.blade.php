@section('title', 'Users')
<div>
    <div class="flex justify-between">

        <h1>Usuários</h1>

        <div>
            <livewire:admin.users.invite />
        </div>

    </div>

    <div class="mt-5 mb-5 grid sm:grid-cols-1 md:grid-cols-3 gap-4">

        <div class="col-span-2">
            <x-form.input type="search" name="name" wire:model="name" label="none" placeholder="Pesquisa">
                {{ old('name', request('name')) }}
            </x-form.input>
        </div>
    </div>

    <div class="overflow-x-scroll shadow-md">
        <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 border">
            <thead>
                <tr>
                    <th><a href="#" wire:click.prevent="sortBy('first_name')">Nome</a></th>
                    <th><a href="#" wire:click.prevent="sortBy('email')">E-mail</a></th>
                    <th>Grupo</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->users() as $user)
                    <tr>
                        <td class="p-2">
                            {{ $user->name }}
                        </td>
                        <td class="p-2">{{ $user->email }}</td>
                        <td class="p-2">
                            @foreach ($user->roles as $role)
                                {{ $role->name }}<br>
                            @endforeach
                        </td>
                        <td class="p-2">
                            <div class="flex space-x-2">

                                <a href="{{ route('admin.users.show', ['user' => $user->id]) }}">Perfil</a>
                                <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}">Editar</a>
                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" @click="on = true">Delete</a>
                                    </x-slot>

                                    <x-slot name="title">Confirm Delete</x-slot>

                                    <x-slot name="content">
                                        <div class="text-center">
                                            Are you sure you want to delete: <b>{{ $user->name }}</b>
                                        </div>
                                    </x-slot>

                                    <x-slot name="footer">
                                        <button @click="on = false">Cancel</button>
                                        <button class="btn btn-red"
                                            wire:click="deleteUser('{{ $user->id }}')">Delete User</button>
                                    </x-slot>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $this->users()->links() }}

</div>
