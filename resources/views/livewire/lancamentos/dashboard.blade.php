@section('title', 'Lançamentos')
<div>
    <div class="flex justify-start">
        <a class="py-3 mr-5" href="{{ route('lancamentos.index') }}"><i class="fa fa-arrow-left"></i> Voltar</a>
        <h1>Dashboard dos lançamentos</h1>
    </div>

    <div class="mt-5 mb-5 grid grid-cols-12 gap-4">
        <div class="col-span-2">
            <x-form.input id="ano" name="ano" label="none" wire:model.lazy="ano"
                placeholder="Ano do lançamento">
            </x-form.input>
        </div>
        <div class="col-span-2">
            <x-form.input id="cnpj" name="cnpj" label="none" wire:model.lazy="cnpj"
                placeholder="CNPJ da Empresa">
            </x-form.input>
        </div>

    </div>

    <div class="mt-5 mb-5 grid grid-cols-12 gap-4">
        <div class="card col-span-4">
            <div class="card-header mb-3 border-b-2">
                <h4>CONFERÊNCIA ICMS</h4>
            </div>
            <div class="card-body">
                <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 border">
                    <thead>
                        <tr>
                            <th class="text-center leading-3">COMP.</th>
                            <th class="text-center leading-3">Declarado</th>
                            <th class="text-center leading-3">Recolhido</th>
                            <th class="bg-orange-600 text-white leading-3">Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->lancamentosIcms() as $obj)
                            <tr class="bg-gray-50 dark:bg-gray-600 dark:border-gray-800">
                                <td class="p-2 text-center">{{ $obj['mes'] }}</td>
                                <td class="p-2 text-right">{{ number_format($obj['valor_declarado'], 2, ',', '.') }}
                                </td>
                                <td class="p-2 text-right">{{ number_format($obj['valor_recolhido'], 2, ',', '.') }}
                                </td>
                                <td class="p-2 text-right">{{ number_format($obj['resultado'], 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card col-span-4">
            <div class="card-header mb-3 border-b-2">
                <h4>CONFERÊNCIA PROTEGE</h4>
            </div>
            <div class="card-body">
                <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 border">
                    <thead>
                        <tr>
                            <th class="text-center leading-3">COMP.</th>
                            <th class="text-center leading-3">Declarado</th>
                            <th class="text-center leading-3">Recolhido</th>
                            <th class="bg-orange-600 text-white leading-3">Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->lancamentosProtege() as $obj)
                            <tr class="bg-gray-50 dark:bg-gray-600 dark:border-gray-800">
                                <td class="p-2 text-center">{{ $obj['mes'] }}</td>
                                <td class="p-2 text-right">{{ number_format($obj['valor_declarado'], 2, ',', '.') }}
                                </td>
                                <td class="p-2 text-right">{{ number_format($obj['valor_recolhido'], 2, ',', '.') }}
                                </td>
                                <td class="p-2 text-right">{{ number_format($obj['resultado'], 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card col-span-4">
            <div class="card-header mb-3 border-b-2">
                <h4>CONFERÊNCIA IPI</h4>
            </div>
            <div class="card-body">
                <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 border">
                    <thead>
                        <tr>
                            <th class="text-center leading-3">COMP.</th>
                            <th class="text-center leading-3">Declarado</th>
                            <th class="text-center leading-3">Recolhido</th>
                            <th class="bg-orange-600 text-white leading-3">Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->lancamentosIpi() as $obj)
                            <tr class="bg-gray-50 dark:bg-gray-600 dark:border-gray-800">
                                <td class="p-2 text-center">{{ $obj['mes'] }}</td>
                                <td class="p-2 text-right">{{ number_format($obj['valor_declarado'], 2, ',', '.') }}
                                </td>
                                <td class="p-2 text-right">{{ number_format($obj['valor_recolhido'], 2, ',', '.') }}
                                </td>
                                <td class="p-2 text-right">{{ number_format($obj['resultado'], 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card col-span-4">
            <div class="card-header mb-3 border-b-2">
                <h4>CONFERÊNCIA PIS</h4>
            </div>
            <div class="card-body">
                <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 border">
                    <thead>
                        <tr>
                            <th class="text-center leading-3">COMP.</th>
                            <th class="text-center leading-3">Declarado</th>
                            <th class="text-center leading-3">Recolhido</th>
                            <th class="bg-orange-600 text-white leading-3">Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->lancamentosPis() as $obj)
                            <tr class="bg-gray-50 dark:bg-gray-600 dark:border-gray-800">
                                <td class="p-2 text-center">{{ $obj['mes'] }}</td>
                                <td class="p-2 text-right">{{ number_format($obj['valor_declarado'], 2, ',', '.') }}
                                </td>
                                <td class="p-2 text-right">{{ number_format($obj['valor_recolhido'], 2, ',', '.') }}
                                </td>
                                <td class="p-2 text-right">{{ number_format($obj['resultado'], 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card col-span-4">
            <div class="card-header mb-3 border-b-2">
                <h4>CONFERÊNCIA COFINS</h4>
            </div>
            <div class="card-body">
                <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 border">
                    <thead>
                        <tr>
                            <th class="text-center leading-3">COMP.</th>
                            <th class="text-center leading-3">Declarado</th>
                            <th class="text-center leading-3">Recolhido</th>
                            <th class="bg-orange-600 text-white leading-3">Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->lancamentosCofins() as $obj)
                            <tr class="bg-gray-50 dark:bg-gray-600 dark:border-gray-800">
                                <td class="p-2 text-center">{{ $obj['mes'] }}</td>
                                <td class="p-2 text-right">{{ number_format($obj['valor_declarado'], 2, ',', '.') }}
                                </td>
                                <td class="p-2 text-right">{{ number_format($obj['valor_recolhido'], 2, ',', '.') }}
                                </td>
                                <td class="p-2 text-right">{{ number_format($obj['resultado'], 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
