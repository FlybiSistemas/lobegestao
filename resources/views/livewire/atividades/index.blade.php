@section('title', 'Atividades')
<div>
    <div class="flex justify-between">
        <h1>Atividades</h1>
        <div>
            <livewire:atividades.create-atividade />
        </div>
    </div>

    <div class="mt-5 mb-5 grid sm:grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-2">
            <x-form.input type="search" name="nome" wire:model="nome" label="none" placeholder="Pesquisar atividades">
                {{ old('nome', request('nome')) }}
            </x-form.input>
        </div>

    </div>

    <div class="overflow-x-scroll shadow-md">
        <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 border">
            <thead>
                <tr>
                    <th><a href="#" wire:click.prevent="sortBy('nome')">Nome</a></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->atividades() as $obj)
                    <tr class="bg-gray-50 dark:bg-gray-600 dark:border-gray-800">
                        <td class="p-2">
                            {{ $obj->nome }}
                        </td>
                        <td class="p-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('atividades.edit', ['atividade' => $obj->id]) }}"><i
                                        class="fa fa-edit text-lg"></i></a>

                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" @click="on = true"><i
                                                class="fa fa-times text-red-500 ml-2 text-lg"></i></a>
                                    </x-slot>

                                    <x-slot name="title">Confirmar a exclusão</x-slot>

                                    <x-slot name="content">
                                        <div class="text-center">
                                            Tem certeza que deseja excluir esse cadastro: <b>{{ $obj->nome }}</b>
                                        </div>
                                    </x-slot>

                                    <x-slot name="footer">
                                        <button @click="on = false">Cancelar</button>
                                        <button class="btn btn-red"
                                            wire:click="deleteGrupo('{{ $obj->id }}')">Excluir Atividade</button>
                                    </x-slot>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $this->atividades()->links() }}

</div>
