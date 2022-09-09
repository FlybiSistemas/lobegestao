@section('title', 'Nova Empresa')
<div class="mx-auto max-w-screen-lg">
    <div class="mb-5 flex items-start justify-content-start">
        <a href="{{ route('empresas.index') }}" class="py-3 mr-5"><i class="fa fa-arrow-left"></i> Voltar</a>
        <h3>| Nova Empresa</h3>
    </div>
    <div class="clearfix"></div>
    <x-form wire:submit.prevent="store" method="post">
        @include('livewire.empresas.fields')
        <x-form.submit>Salvar</x-form.submit>
    </x-form>
</div>
