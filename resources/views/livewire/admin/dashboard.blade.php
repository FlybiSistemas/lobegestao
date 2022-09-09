@section('title', 'Dashboard')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<h1>Dashboard</h1>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
    <div class="card h-72">
        <div class="card-header">
            <h4 class="mb-0 text-center">Empresas por Atividade</h4>
        </div>
        <div class="card-body flex items-center justify-center">
            <div class="w-72 " id="chartAtividade"></div>
        </div>
    </div>
    <div class="card h-72">
        <div class="card-header">
            <h4 class="mb-0 text-center">Empresas por Departamento</h4>
        </div>
        <div class="card-body flex items-center justify-center">
            <div class="w-72" id="chartDepartamento"></div>
        </div>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0 text-center">Certificados Vencendo essa semana</h4>
        </div>
        <div class="card-body h-72 overflow-auto">
            <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 border dark:border-gray-800">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Depart.</th>
                        <th>Validade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->semana as $obj)
                        <tr
                            class="bg-gray-50 border-b dark:bg-gray-900 dark:border-gray-700 @if ($obj->certificado_validade->isToday()) bg-red-50 @endif">
                            <td class="p-2">
                                <a href="{{ route('empresas.show', ['empresa' => $obj->id]) }}">{{ $obj->nome }}</a>
                                <br /> {{ $obj->cnpj }}
                            </td>
                            <td class="p-2">{{ $obj->departamento ? $obj->departamento->nome : '' }}</td>
                            <td class="p-2">
                                {{ $obj->certificado_validade ? $obj->certificado_validade->format('d/m/Y') : '' }}
                                <br />{{ $obj->certificado_validade ? $obj->certificado_validade->diffForHumans() : '' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0 text-center">Certificados Vencendo esse mês</h4>
        </div>
        <div class="card-body h-72 overflow-auto">
            <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400 border dark:border-gray-600">
                <thead>
                    <tr class="dark:bg-gray-600">
                        <th>Empresa</th>
                        <th>Depart</th>
                        <th>Validade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->mes as $obj)
                        <tr class="bg-gray-50 border-b dark:bg-gray-700 dark:border-gray-800">
                            <td class="p-2">
                                <a href="{{ route('empresas.show', ['empresa' => $obj->id]) }}">{{ $obj->nome }}</a>
                                <br />{{ $obj->cnpj }}
                            </td>
                            <td class="p-2">{{ $obj->departamento ? $obj->departamento->nome : '' }}</td>
                            <td class="p-2">
                                {{ $obj->certificado_validade ? $obj->certificado_validade->format('d/m/Y') : '' }}
                                <br />{{ $obj->certificado_validade ? $obj->certificado_validade->diffForHumans() : '' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    var options = {
        chart: {
            type: 'pie'
        },
        legend: {
            show: false,
            position: 'top'
        },
        series: [
            @foreach ($empresasPorAtividades as $key => $value)
                {{ count($value) }},
            @endforeach
        ],
        labels: [
            @foreach ($empresasPorAtividades as $key => $value)
                "{{ $key }}",
            @endforeach
        ]
    }
    var chart = new ApexCharts(document.querySelector("#chartAtividade"), options);
    chart.render();
    var optionsDepart = {
        chart: {
            type: 'pie'
        },
        legend: {
            show: false,
            position: 'top'
        },
        series: [
            @foreach ($empresasPorDepartamento as $key => $value)
                {{ count($value) }},
            @endforeach
        ],
        labels: [
            @foreach ($empresasPorDepartamento as $key => $value)
                "{{ $key }}",
            @endforeach
        ]
    }
    var chartDepart = new ApexCharts(document.querySelector("#chartDepartamento"), optionsDepart);
    chartDepart.render();
</script>
