@section('title', 'Edit Role')
<div class=" mx-auto max-w-screen-md">
    <div class="mb-5">
        <a class="dark:text-white" href="{{ route('admin.settings.roles.index') }}"><i class="fa fa-arrow-left"></i>
            Voltar</a>
        <span class="dark:text-gray-200">- Alterar Grupo</span>
    </div>
    <div class="clearfix"></div>

    <x-form wire:submit.prevent="update" method="put">

        <div class="row">

            <div class="md:w-1/2">
                @if ($role?->name == 'admin')
                    <x-form.input wire:model="name" label='Grupo' name='name' disabled></x-form.input>
                @else
                    <x-form.input wire:model="name" label='Grupo' name='name' required></x-form.input>
                @endif
            </div>

        </div>

        <div>
            <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 border">
                <thead>
                    <tr>
                        <th class="dark:text-gray-300">Permissão</th>
                        <th class="dark:text-gray-300">Liberar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $perm)
                        <tr>
                            <td class="p-2">{{ $perm->description }}</td>
                            <td class="p-2"><input type="checkbox" wire:model="permission"
                                    value="{{ $perm->id }}"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <x-form.submit>Atualizar Grupo</x-form.submit>

    </x-form>

</div>
