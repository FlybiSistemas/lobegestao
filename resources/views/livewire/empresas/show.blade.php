@section('title', 'Empresa')
<div>
    <p>
        <a href="{{ route('empresas.index') }}">Empresas</a>
        <span class="dark:text-gray-200">- {{ $empresa->nome }}</span>
        <span class="dark:text-gray-200">-
            <a href="{{ route('empresas.edit', ['empresa' => $empresa->id]) }}">
                <i class="fa fa-edit text-lg"></i> Atualizar cadastro</a></span>
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
        <div>
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-center">Dados da Empresa</h4>
                </div>

                <div class="card-body">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">RAZÃO SOCIAL:</td>
                            <td class="py-2">{{ $empresa->nome }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">FUNDAÇÃO DA EMPRESA:</td>
                            <td class="py-2">
                                {{ $empresa->data_abertura ? $empresa->data_abertura->format('d/m/Y') : '' }}
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">CLIENTE DESDE:</td>
                            <td class="py-2">
                                {{ $empresa->cliente_desde ? $empresa->cliente_desde->format('d/m/Y') : '' }}
                            </td>
                        </tr>
                        <tr class="bg-gray-50 border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">CNPJ:</td>
                            <td class="py-2">{{ $empresa->cnpj }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">ENDEREÇO:</td>
                            <td class="py-2">{{ $empresa->endereco }}</td>
                        </tr>
                        <tr class="bg-gray-50 border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">CIDADE:</td>
                            <td class="py-2">{{ $empresa->cidade }} - {{ $empresa->estado }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">GRUPO:</td>
                            <td class="py-2">{{ $empresa->grupo ? $empresa->grupo->nome : '' }}</td>
                        </tr>
                        <tr class="bg-gray-50 border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">DEPARTAMENTO:</td>
                            <td class="py-2">{{ $empresa->departamento ? $empresa->departamento->nome : '' }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">ATIVIDADE:</td>
                            <td class="py-2">{{ $empresa->atividade ? $empresa->atividade->nome : '' }}</td>
                        </tr>
                        <tr class="bg-gray-50 border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">RESPONSÁVEL DP:</td>
                            <td class="py-2">{{ $empresa->responsavel_departamento_pessoal }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">REGIME TRIBUTÁRIO:</td>
                            <td class="py-2">{{ $empresa->nomeRegimeTributario() }}</td>
                        </tr>
                        <tr class="bg-gray-50 border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">REGIME APURACAO:</td>
                            <td class="py-2">{{ $empresa->nomePeriodoApuracao() }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">CONTRATO SOCIAL:</td>
                            <td class="py-2"><a href="{{ $empresa->contrato_social }}" target="_blank">Abrir</a></td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">CERTIFICADO:</td>
                            <td class="py-2"><a href="{{ $empresa->certificado }}" target="_blank">Abrir</a></td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">VALIDADE DO CERTIFICADO:</td>
                            <td class="py-2">
                                {{ $empresa->certificado_validade ? $empresa->certificado_validade->format('d/m/Y') : '' }}
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">VAI EXPIRAR EM:</td>
                            <td class="py-2">
                                {{ $empresa->certificado_validade ? $empresa->certificado_validade->diffForHumans() : '' }}
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">PARTICULARIDADES:</td>
                            <td class="py-2">
                                {{ $empresa->particularidades }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-center">CONTATOS</h4>
                </div>

                <div class="card-body">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">FISCAL:</td>
                            <td class="py-2">{{ $empresa->email_fiscal }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">CONTABIL:</td>
                            <td class="py-2">{{ $empresa->email_contabil }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">FINANCEIRO:</td>
                            <td class="py-2">{{ $empresa->email_financeiro }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-center">ACESSO AO SISTEMA</h4>
                </div>

                <div class="card-body">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">TIPO ACESSO / URL:</td>
                            <td class="py-2">
                                {{ $empresa->remoto_url }}
                                @if (str_starts_with($empresa->remoto_url, 'http'))
                                    <a href="{{ $empresa->remoto_url }}" target="_blank"> | Abrir <i
                                            class="fa fa-external-link"></i></a>
                                @endif
                            </td>
                        </tr>
                        <tr class="bg-gray-50 border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">REMOTO - USUÁRIO:</td>
                            <td class="py-2">{{ $empresa->remoto_usuario }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">REMOTO - SENHA:</td>
                            <td class="py-2">{{ $empresa->remoto_senha }}</td>
                        </tr>
                        <tr class="bg-gray-50 border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">SISTEMA - USUÁRIO:</td>
                            <td class="py-2">{{ $empresa->sistema_usuario }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">SISTEMA - SENHA:</td>
                            <td class="py-2">{{ $empresa->sistema_senha }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-center">ACESSO AO SEFAZ</h4>
                </div>

                <div class="card-body">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">URL:</td>
                            <td class="py-2">
                                {{ $empresa->sefaz_url }}
                                @if (str_starts_with($empresa->sefaz_url, 'http'))
                                    <a href="{{ $empresa->sefaz_url }}" target="_blank"> | Abrir <i
                                            class="fa fa-external-link"></i></a>
                                @endif
                            </td>
                        </tr>
                        <tr class="bg-gray-50 border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">Estado:</td>
                            <td class="py-2">{{ $empresa->estado }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">Inscrição Estadual:</td>
                            <td class="py-2">{{ $empresa->sefaz_ie }}</td>
                        </tr>
                        <tr class="bg-gray-50 border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">Contador:</td>
                            <td class="py-2">{{ $empresa->contador ? $empresa->contador->nome : '' }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">USUÁRIO:</td>
                            <td class="py-2">{{ $empresa->contador ? $empresa->contador->usuario : '' }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">SENHA:</td>
                            <td class="py-2">{{ $empresa->contador ? $empresa->contador->senha : '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0 text-center">ACESSO A PREFEITURA</h4>
                </div>

                <div class="card-body">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">URL:</td>
                            <td class="py-2">
                                {{ $empresa->prefeitura_url }}
                                @if (str_starts_with($empresa->prefeitura_url, 'http'))
                                    <a href="{{ $empresa->prefeitura_url }}" target="_blank"> | Abrir <i
                                            class="fa fa-external-link"></i></a>
                                @endif
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">USUÁRIO:</td>
                            <td class="py-2">{{ $empresa->prefeitura_usuario }}</td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <td class="py-2 font-bold">SENHA:</td>
                            <td class="py-2">{{ $empresa->prefeitura_senha }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
