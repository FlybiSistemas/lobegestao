@section('title', 'Lançamentos')
<div>
    <div class="flex justify-between">
        <h1>Lançamentos</h1>
        <div class="flex justify-end">
            <a class="btn bg-blue-900 text-white mr-3" href="{{ route('lancamentos.dashboard') }}">Dashboard</a>
            <livewire:lancamentos.create-lancamento />
        </div>
    </div>

    <div class="mt-5 mb-5 grid grid-cols-12 gap-4">
        <div class="col-span-2">
            <x-form.date id="data_lancamento" name="data_lancamento" label="none" wire:model.lazy="data_lancamento"
                placeholder="Data do lançamento">
                {{ old('data_lancamento', request('data_lancamento')) }}
            </x-form.date>
        </div>
        <div class="col-span-2">
            <x-form.select wire:model="tipo" label='none' name='tipo' placeholder="Tipo do lançamento">
                <x-form.select-option value="M">ICMS</x-form.select-option>
                <x-form.select-option value="I">IPI</x-form.select-option>
                <x-form.select-option value="P">PROTEGE</x-form.select-option>
                <x-form.select-option value="C">PIS/COFINS</x-form.select-option>
            </x-form.select>
        </div>

    </div>

    <div class="overflow-x-scroll shadow-md">
        <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 border">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Tipo</th>
                    <th><a href="#" wire:click.prevent="sortBy('data_lancamento')">Data</a></th>
                    <th>Valor Declarado</th>
                    <th>Valor Recolhido</th>
                    <th>Resultado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->lancamentos() as $obj)
                    <tr class="bg-gray-50 dark:bg-gray-600 dark:border-gray-800">
                        <td class="p-2">
                            <a href="{{ route('empresas.show', ['empresa' => $obj->empresa_id]) }}">
                                <strong>{{ $obj->empresa->nome }}</strong>
                            </a>
                            <br /><i>{{ $obj->empresa->cnpj }}</i>
                        </td>
                        <td class="p-2">{{ $obj->tipoLancamento() }}</td>
                        <td class="p-2">{{ $obj->data_lancamento->format('m/Y') }}</td>
                        <td class="p-2">{{ number_format($obj->valor_declarado, 2, ',', '.') }}</td>
                        <td class="p-2">{{ number_format($obj->valor_recolhido, 2, ',', '.') }}</td>
                        <td class="p-2 @if ($obj->resultado < 0) text-red-800 @endif">
                            {{ number_format($obj->resultado, 2, ',', '.') }}</td>
                        <td class="p-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('lancamentos.edit', ['lancamento' => $obj->id]) }}"><i
                                        class="fa fa-edit text-lg"></i></a>

                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" @click="on = true"><i
                                                class="fa fa-times text-red-500 ml-2 text-lg"></i>
                                        </a>
                                    </x-slot>

                                    <x-slot name="title">Confirmar a exclusão</x-slot>

                                    <x-slot name="content">
                                        <div class="text-center">
                                            Tem certeza que deseja excluir esse lançamento:
                                            <b>{{ $obj->data_lancamento->format('m/Y') }}</b>
                                        </div>
                                    </x-slot>

                                    <x-slot name="footer">
                                        <button @click="on = false">Cancelar</button>
                                        <button class="btn btn-red"
                                            wire:click="deleteLancamento('{{ $obj->id }}')">Excluir
                                            Lançamento</button>
                                    </x-slot>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $this->lancamentos()->links() }}

</div>
