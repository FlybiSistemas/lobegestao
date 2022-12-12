<div class="card">
    <div class="card-header mb-3 border-b-2">
        <h4>Dados da empresa</h4>
    </div>
    <div class="row grid grid-cols-12 gap-4">
        <div class="col-span-3">
            <x-form.input wire:model="cnpj" label='CNPJ/CPF' name='cnpj' required placeholder="00.000.000/0000-00">
            </x-form.input>
        </div>
        <div class="col-span-5">
            <x-form.input wire:model="nome" label='Nome' name='nome' required></x-form.input>
        </div>
        <div class="col-span-4">
            <x-form.input wire:model="fantasia" label='Fantasia' name='fantasia'></x-form.input>
        </div>
    </div>
    <div class="row grid grid-cols-12 gap-4">
        <div class="col-span-4">
            <x-form.select wire:model="grupo_id" label='Grupo' name='grupo_id'
                placeholder="Grupo da Empresa se existir" required>
                @foreach ($this->grupos as $grupo)
                    <x-form.select-option value="{{ $grupo->id }}">{{ $grupo->nome }}</x-form.select-option>
                @endforeach
            </x-form.select>
        </div>
        <div class="col-span-4">
            <x-form.select wire:model="departamento_id" label='Departamento' name='departamento_id'
                placeholder="Departamento responsável" required>
                @foreach ($this->departamentos as $departamento)
                    <x-form.select-option value="{{ $departamento->id }}">{{ $departamento->nome }}
                    </x-form.select-option>
                @endforeach
            </x-form.select>
        </div>
        <div class="col-span-4">
            <x-form.select wire:model="atividade_id" label='Atividade' name='atividade_id'
                placeholder="Qual a atividade da empresa" required>
                @foreach ($this->atividades as $atividade)
                    <x-form.select-option value="{{ $atividade->id }}">{{ $atividade->nome }}</x-form.select-option>
                @endforeach
            </x-form.select>
        </div>
    </div>
    <div class="row grid grid-cols-12 gap-4">
        <div class="col-span-3">
            <x-form.select wire:model="regime_tributario" label='Regime Tributário' name='regime_tributario' required
                placeholder="Escolha o Regime Tributário da empresa">
                <x-form.select-option value="S">Simples Nacional</x-form.select-option>
                <x-form.select-option value="R">Lucro Real</x-form.select-option>
                <x-form.select-option value="P">Lucro Presumido</x-form.select-option>
            </x-form.select>
        </div>
        <div class="col-span-4">
            <x-form.select wire:model="periodo_apuracao" label='Período de Apuração' name='periodo_apuracao' required
                placeholder="Informe o período de apuração dos eventos da empresa">
                <x-form.select-option value="M">Mensal</x-form.select-option>
                <x-form.select-option value="T">Trimestral</x-form.select-option>
                <x-form.select-option value="A">Anual</x-form.select-option>
            </x-form.select>
        </div>
        <div class="col-span-3">
            <x-form.input wire:model="responsavel_departamento" label='Responsável DP' name='responsavel_departamento'
                required>
            </x-form.input>
        </div>
        <div class="col-span-2">
            <x-form.input wire:model="cep" label='CEP' name='cep'></x-form.input>
        </div>
    </div>
    <div class="row grid grid-cols-12 gap-4">
        <div class="col-span-4">
            <x-form.input wire:model="logradouro" label='Endereço' name='logradouro'></x-form.input>
        </div>
        <div class="col-span-3">
            <x-form.input wire:model="bairro" label='Bairro' name='bairro'></x-form.input>
        </div>
        <div class="col-span-3">
            <x-form.input wire:model="cidade" label='Cidade' name='cidade'></x-form.input>
        </div>
        <div class="col-span-2">
            <x-form.select wire:model="estado" label='UF' name='estado'>
                <x-form.select-option value="">--</x-form.select-option>
                <x-form.select-option value="AC">AC</x-form.select-option>
                <x-form.select-option value="AL">AL</x-form.select-option>
                <x-form.select-option value="AM">AM</x-form.select-option>
                <x-form.select-option value="AP">AP</x-form.select-option>
                <x-form.select-option value="BA">BA</x-form.select-option>
                <x-form.select-option value="CE">CE</x-form.select-option>
                <x-form.select-option value="DF">DF</x-form.select-option>
                <x-form.select-option value="ES">ES</x-form.select-option>
                <x-form.select-option value="GO">GO</x-form.select-option>
                <x-form.select-option value="MA">MA</x-form.select-option>
                <x-form.select-option value="MG">MG</x-form.select-option>
                <x-form.select-option value="MS">MS</x-form.select-option>
                <x-form.select-option value="MT">MT</x-form.select-option>
                <x-form.select-option value="PA">PA</x-form.select-option>
                <x-form.select-option value="PB">PB</x-form.select-option>
                <x-form.select-option value="PE">PE</x-form.select-option>
                <x-form.select-option value="PI">PI</x-form.select-option>
                <x-form.select-option value="PR">PR</x-form.select-option>
                <x-form.select-option value="RJ">RJ</x-form.select-option>
                <x-form.select-option value="RN">RN</x-form.select-option>
                <x-form.select-option value="RO">RO</x-form.select-option>
                <x-form.select-option value="RR">RR</x-form.select-option>
                <x-form.select-option value="RS">RS</x-form.select-option>
                <x-form.select-option value="SC">SC</x-form.select-option>
                <x-form.select-option value="SE">SE</x-form.select-option>
                <x-form.select-option value="SP">SP</x-form.select-option>
                <x-form.select-option value="TO">TO</x-form.select-option>
            </x-form.select>
        </div>
        <div class="col-span-3">
            <x-form.date id="data_abertura" name="data_abertura" label="Data de Abertura"
                wire:model.lazy="data_abertura">
                {{ old('data_abertura', request('data_abertura')) }}
            </x-form.date>
        </div>
        <div class="col-span-3">
            <x-form.date id="cliente_desde" name="cliente_desde" label="Cliente desde"
                wire:model.lazy="cliente_desde">
                {{ old('cliente_desde', request('cliente_desde')) }}
            </x-form.date>
        </div>
        <div class="col-span-3">
            <x-form.date id="cliente_ate" name="cliente_ate" label="Cliente até" wire:model.lazy="cliente_ate">
                {{ old('cliente_ate', request('cliente_ate')) }}
            </x-form.date>
        </div>

    </div>
    <div class="row grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <x-form.textarea rows="10" wire:model="particularidades" label='Particularidades da empresa'
                name='particularidades'>
            </x-form.textarea>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header mb-3 border-b-2">
        <h4>Dados e contato</h4>
    </div>
    <div class="row grid grid-cols-12 gap-4">
        <div class="col-span-4">
            <x-form.input type="text" wire:model="nome_contato" label='Nome do Contato' name='nome_contato'>
            </x-form.input>
        </div>
        <div class="col-span-4">
            <x-form.input type="number" wire:model="primeiro_contato" label='Contato' name='primeiro_contato'>
            </x-form.input>
        </div>
        <div class="col-span-4">
            <x-form.input type="number" wire:model="segundo_contato" label='Contato'
                name='segundo_contato'>
            </x-form.input>
        </div>
    </div>
    <div class="row grid grid-cols-12 gap-4">
        <div class="col-span-4">
            <x-form.input type="email" wire:model="email_fiscal" label='E-mail Fiscal' name='email_fiscal'>
            </x-form.input>
        </div>
        <div class="col-span-4">
            <x-form.input type="email" wire:model="email_contabil" label='E-mail Contábil' name='email_contabil'>
            </x-form.input>
        </div>
        <div class="col-span-4">
            <x-form.input type="email" wire:model="email_financeiro" label='E-mail Financeiro'
                name='email_financeiro'>
            </x-form.input>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header mb-3 border-b-2">
        <h4>Documentos</h4>
    </div>
    <div class="row grid grid-cols-12 gap-4">
        <div class="col-span-9">
            <x-form.input wire:model="certificado" label='Endereço do Certificado' name='certificado'>
            </x-form.input>
        </div>
        <div class="col-span-3">
            <x-form.date id="certificado_validade" name="certificado_validade" label="Validade"
                wire:model.lazy="certificado_validade">
                {{ old('certificado_validade', request('certificado_validade')) }}
            </x-form.date>
        </div>
    </div>
    <div class="row grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <x-form.input wire:model="contrato_social" label='Endereço do contrato social' name='contrato_social'>
            </x-form.input>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header mb-3 border-b-2">
        <h4>Dados de acesso remoto</h4>
    </div>
    <div class="row grid grid-cols-12 gap-4">
        <div class="col-span-6">
            <x-form.input wire:model="remoto_url" label='URL para Acesso Remoto' name='remoto_url'>
            </x-form.input>
        </div>
        <div class="col-span-3">
            <x-form.input wire:model="remoto_usuario" label='Usuário' name='remoto_usuario'>
            </x-form.input>
        </div>
        <div class="col-span-3">
            <x-form.input wire:model="remoto_senha" label='Senha' name='remoto_senha'>
            </x-form.input>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header mb-3 border-b-2">
        <h4>Dados de acesso ao sistema do cliente</h4>
    </div>
    <div class="row grid grid-cols-12 gap-4">
        <div class="col-span-6">
            <x-form.input wire:model="sistema_url" label='URL para Acesso ao Sistema do cliente' name='sistema_url'>
            </x-form.input>
        </div>
        <div class="col-span-3">
            <x-form.input wire:model="sistema_usuario" label='Usuário' name='sistema_usuario'>
            </x-form.input>
        </div>
        <div class="col-span-3">
            <x-form.input wire:model="sistema_senha" label='Senha' name='sistema_senha'>
            </x-form.input>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header mb-3 border-b-2">
        <h4>Dados de acesso ao SEFAZ</h4>
    </div>
    <div class="row grid grid-cols-12 gap-4">
        <div class="col-span-5">
            <x-form.input wire:model="sefaz_url" label='URL para Acesso ao Sefaz' name='sefaz_url'>
            </x-form.input>
        </div>
        <div class="col-span-2">
            <x-form.select wire:model="sefaz_uf" label='UF' name='sefaz_uf'>
                <x-form.select-option value="">--</x-form.select-option>
                <x-form.select-option value="AC">AC</x-form.select-option>
                <x-form.select-option value="AL">AL</x-form.select-option>
                <x-form.select-option value="AM">AM</x-form.select-option>
                <x-form.select-option value="AP">AP</x-form.select-option>
                <x-form.select-option value="BA">BA</x-form.select-option>
                <x-form.select-option value="CE">CE</x-form.select-option>
                <x-form.select-option value="DF">DF</x-form.select-option>
                <x-form.select-option value="ES">ES</x-form.select-option>
                <x-form.select-option value="GO">GO</x-form.select-option>
                <x-form.select-option value="MA">MA</x-form.select-option>
                <x-form.select-option value="MG">MG</x-form.select-option>
                <x-form.select-option value="MS">MS</x-form.select-option>
                <x-form.select-option value="MT">MT</x-form.select-option>
                <x-form.select-option value="PA">PA</x-form.select-option>
                <x-form.select-option value="PB">PB</x-form.select-option>
                <x-form.select-option value="PE">PE</x-form.select-option>
                <x-form.select-option value="PI">PI</x-form.select-option>
                <x-form.select-option value="PR">PR</x-form.select-option>
                <x-form.select-option value="RJ">RJ</x-form.select-option>
                <x-form.select-option value="RN">RN</x-form.select-option>
                <x-form.select-option value="RO">RO</x-form.select-option>
                <x-form.select-option value="RR">RR</x-form.select-option>
                <x-form.select-option value="RS">RS</x-form.select-option>
                <x-form.select-option value="SC">SC</x-form.select-option>
                <x-form.select-option value="SE">SE</x-form.select-option>
                <x-form.select-option value="SP">SP</x-form.select-option>
                <x-form.select-option value="TO">TO</x-form.select-option>
            </x-form.select>
        </div>
        <div class="col-span-2">
            <x-form.input wire:model="sefaz_ie" label='IE' name='sefaz_ie'>
            </x-form.input>
        </div>
        <div class="col-span-3">
            <x-form.select wire:model="contador_id" label='Contador' name='contador_id' required>
                <x-form.select-option value="">Escolha o contador da empresa</x-form.select-option>
                @foreach ($this->contadores as $contador)
                    <x-form.select-option value="{{ $contador->id }}">{{ $contador->nome }}</x-form.select-option>
                @endforeach
            </x-form.select>
        </div>
        <div class="col-span-3">
            <x-form.input wire:model="sefaz_usuario" label='Usuário' name='sefaz_usuario'>
            </x-form.input>
        </div>
        <div class="col-span-3">
            <x-form.input wire:model="sefaz_senha" label='Senha' name='sefaz_senha'>
            </x-form.input>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header mb-3 border-b-2">
        <h4>Dados de acesso ao sistema da Prefeitura</h4>
    </div>
    <div class="row grid grid-cols-12 gap-4">
        <div class="col-span-6">
            <x-form.input wire:model="prefeitura_url" label='URL para Acesso ao Sistema da prefeitura'
                name='prefeitura_url'>
            </x-form.input>
        </div>
        <div class="col-span-3">
            <x-form.input wire:model="prefeitura_usuario" label='Usuário' name='prefeitura_usuario'>
            </x-form.input>
        </div>
        <div class="col-span-3">
            <x-form.input wire:model="prefeitura_senha" label='Senha' name='prefeitura_senha'>
            </x-form.input>
        </div>
    </div>
</div>
<div>
    <x-2col>
        <x-slot name="left">
            <h3>Integração Receitanet BX</h3>
            <p>Consultar informações do SPED e comparar com o que foi recolhido.</p>
        </x-slot>
        <x-slot name="right">

            <div class="card">

                <p><input type="checkbox" wire:model="bot_icms">
                    <span class="ml-1">
                    ICMS
                    </span>
                </p>
                
                <p><input type="checkbox" wire:model="bot_pis_cofins">
                    <span class="ml-1">
                    PIS COFINS
                    </span>
                </p>

            </div>

        </x-slot>
    </x-2col>

</div>
