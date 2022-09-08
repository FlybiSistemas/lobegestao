@section('title', 'Departamentos')
<div>
    <div class="flex justify-between">
        <h1>Departamentos</h1>
        <div>
            <livewire:departamentos.create-departamento />
        </div>
    </div>

    <div class="mt-5 mb-5 grid sm:grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-2">
            <x-form.input type="search" name="nome" wire:model="nome" label="none"
                placeholder="Pesquisar departamentos">
                {{ old('nome', request('nome')) }}
            </x-form.input>
        </div>

    </div>

    <div class="overflow-x-scroll shadow-md">
        <table>
            <thead>
                <tr>
                    <th><a href="#" wire:click.prevent="sortBy('nome')">Nome</a></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->departamentos() as $obj)
                    <tr>
                        <td class="flex">
                            <div class="pl-1 pt-1">{{ $obj->nome }}</div>
                        </td>
                        <td>
                            <div class="flex space-x-2">
                                <a href="{{ route('departamentos.edit', ['departamento' => $obj->id]) }}">Edit</a>

                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" @click="on = true">Excluir</a>
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
                                            wire:click="deleteDepartamento('{{ $obj->id }}')">Excluir
                                            Departamento</button>
                                    </x-slot>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $this->departamentos()->links() }}

</div>
