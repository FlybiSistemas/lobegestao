@section('title', 'Empresas')
<div>
    <div class="flex justify-between">
        <h1>Empresas</h1>
        <div>
            <a class="btn btn-primary" href="{{ route('empresas.create') }}">Adicionar Empresa</a>
            <button class="btn btn-green-700" wire:click="exportar">Exportar</button>
        </div>
    </div>

    <div class="mt-5 mb-5 grid sm:grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-2">
            <x-form.input type="search" name="nome" wire:model="nome" label="none" placeholder="Pesquisar empresas">
            </x-form.input>
        </div>

    </div>

    <div class="overflow-x-scroll shadow-md">
        <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 border">
            <thead>
                <tr>
                    <th><a href="#" wire:click.prevent="sortBy('nome')">Nome</a></th>
                    <th><a href="#" wire:click.prevent="sortBy('g.nome')">Grupo</a></th>
                    <th><a href="#" wire:click.prevent="sortBy('d.nome')">Depart.</a></th>
                    <th><a href="#" wire:click.prevent="sortBy('at.nome')">Atividade</a></th>
                    <th>Abertura</th>
                    <th>Cliente desde</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->empresas() as $obj)
                    <tr class="bg-gray-50 dark:bg-gray-600 dark:border-gray-800">
                        <td class="p-2">
                            <a href="{{ route('empresas.show', ['empresa' => $obj->id]) }}">
                                <strong>{{ $obj->nome }}</strong>
                            </a>
                            <br /><i>{{ $obj->cnpj }}</i>
                        </td>
                        <td class="p-2">{{ $obj->grupo ? $obj->grupo->nome : '' }}</td>
                        <td class="p-2">{{ $obj->departamento ? $obj->departamento->nome : '' }}</td>
                        <td class="p-2">{{ $obj->atividade ? $obj->atividade->nome : '' }}</td>
                        <td class="p-2">{{ $obj->data_abertura ? $obj->data_abertura->format('d/m/Y') : '' }}</td>
                        <td class="p-2">
                            @if ($obj->cliente_desde)
                                {{ $obj->cliente_desde->format('d/m/Y') }}
                                {{ $obj->cliente_ate ? ' até ' . $obj->cliente_ate->format('d/m/Y') : '' }}
                            @endif
                        </td>
                        <td class="p-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('empresas.edit', ['empresa' => $obj->id]) }}">
                                    <i class="fa fa-edit text-lg"></i></a>

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
