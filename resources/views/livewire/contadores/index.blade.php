@section('title', 'Contadores')
<div>
    <div class="flex justify-between">
        <h1>Contadores</h1>
        <div>
            <livewire:contadores.create-contador />
            <button class="btn btn-green-700" wire:click="exportar">Exportar</button>
        </div>
    </div>

    <div class="mt-5 mb-5 grid sm:grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-2">
            <x-form.input type="search" name="nome" wire:model="nome" label="none" placeholder="Pesquisar contadores">
                {{ old('nome', request('nome')) }}
            </x-form.input>
        </div>

    </div>

    <div class="overflow-x-scroll shadow-md">
        <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 border">
            <thead>
                <tr>
                    <th><a href="#" wire:click.prevent="sortBy('nome')">Nome</a></th>
                    <th><a href="#" wire:click.prevent="sortBy('usuario')">Usuário</a></th>
                    <th><a href="#" wire:click.prevent="sortBy('senha')">Senha</a></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->contadores() as $obj)
                    <tr class="bg-gray-50 dark:bg-gray-600 dark:border-gray-800">
                        <td class="p-2">{{ $obj->nome }}</td>
                        <td class="p-2">{{ $obj->usuario }}</td>
                        <td class="p-2">{{ $obj->senha }}</td>
                        <td class="p-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('contadores.edit', ['contador' => $obj->id]) }}"><i
                                        class="fa fa-edit text-lg"></i></a>

                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" @click="on = true"><i
                                                class="fa fa-times text-red-500 ml-2 text-lg"></i></a>
                                    </x-slot>

                                    <x-slot name="title">Confirmar Exclusão</x-slot>

                                    <x-slot name="content">
                                        <div class="text-center">
                                            Tem certeza que deseja excluir esse cadastro: <b>{{ $obj->nome }}</b>
                                        </div>
                                    </x-slot>

                                    <x-slot name="footer">
                                        <button @click="on = false">Cancelar</button>
                                        <button class="btn btn-red"
                                            wire:click="deleteContador('{{ $obj->id }}')">Excluir
                                            Contador</button>
                                    </x-slot>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $this->contadores()->links() }}

</div>
