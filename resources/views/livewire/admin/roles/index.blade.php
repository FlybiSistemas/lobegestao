@section('title', 'Roles')
<div>
    <div class="flex justify-between">
        <h1>Grupos</h1>
        <div>
            <livewire:admin.roles.create />
        </div>
    </div>
    @include('errors.messages')
    <div class="grid sm:grid-cols-1 md:grid-cols-4 gap-4">

        <div class="col-span-2">
            <x-form.input type="search" id="roles" name="query" wire:model="query" label="none"
                placeholder="Pesquisa">
                {{ old('query', request('query')) }}
            </x-form.input>
        </div>

    </div>

    <table class="w-full text-xs text-left text-gray-500 dark:text-gray-600 border">
        <thead>
            <tr class="bg-gray-50 border-b dark:bg-gray-700 dark:border-gray-800">
                <th>
                    <a href="#" wire:click.prevent="sortBy('name')">Nome</a>
                </th>
                <th>
                    Ação
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->roles() as $role)
                <tr class="bg-gray-50 border-b dark:bg-gray-600 dark:border-gray-700">
                    <td class="p-2">{{ $role->name }}</td>
                    <td class="p-2">
                        <div class="flex space-x-2">

                            <a href="{{ route('admin.settings.roles.edit', ['role' => $role->id]) }}"><i
                                    class="fa fa-edit text-lg"></i></a>

                            @if ($role->label == 'App')
                            @else
                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" @click="on = true"><i
                                                class="fa fa-times text-red-500 ml-2 text-lg"></i></a>
                                    </x-slot>

                                    <x-slot name="title">Confirm Delete</x-slot>

                                    <x-slot name="content">
                                        <div class="text-center">
                                            Are you sure you want to role: <b>{{ $role->name }}</b>
                                        </div>
                                    </x-slot>

                                    <x-slot name="footer">
                                        <button class="btn" @click="on = false">Cancel</button>
                                        <button class="btn btn-red"
                                            wire:click="deleteRole('{{ $role->id }}')">Delete Role</button>
                                    </x-slot>
                                </x-modal>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $this->roles()->links() }}

</div>
