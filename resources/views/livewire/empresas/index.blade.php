@section('title', 'Empresas')
<div>
    <div class="flex justify-between">
        <h1>Empresas</h1>
        <div>
            <livewire:empresas.create-empresa />
        </div>
    </div>

    <div class="mt-5 mb-5 grid sm:grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-2">
            <x-form.input type="search" name="nome" wire:model="nome" label="none" placeholder="Pesquisar empresas">
            </x-form.input>
        </div>

    </div>

    <div class="overflow-x-scroll shadow-md">
        <table>
            <thead>
                <tr>
                    <th>CNPJ</th>
                    <th><a href="#" wire:click.prevent="sortBy('nome')">Nome</a></th>
                    <th><a href="#" wire:click.prevent="sortBy('g.nome')">Grupo</a></th>
                    <th><a href="#" wire:click.prevent="sortBy('d.nome')">Departamento</a></th>
                    <th><a href="#" wire:click.prevent="sortBy('at.nome')">Atividade</a></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->empresas() as $obj)
                    <tr>
                        <td>
                            {{ $obj->cnpj }}
                        </td>
                        <td>
                            {{ $obj->nome }}
                        </td>
                        <td>
                            {{ $obj->grupo ? $obj->grupo->nome : '' }}
                        </td>
                        <td>
                            {{ $obj->departamento ? $obj->departamento->nome : '' }}
                        </td>
                        <td>
                            {{ $obj->atividade ? $obj->atividade->nome : '' }}
                        </td>
                        <td>
                            <div class="flex space-x-2">
                                <a href="{{ route('empresas.edit', ['empresa' => $obj->id]) }}">Edit</a>

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
                                            wire:click="deleteEmpresa('{{ $obj->id }}')">Excluir
                                            Empresa</button>
                                    </x-slot>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $this->empresas()->links() }}

</div>
