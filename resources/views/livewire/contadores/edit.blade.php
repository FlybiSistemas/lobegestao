@section('title', 'Atualizar Contador')
<div class="mx-auto max-w-screen-lg">
    <div class="mb-5 flex items-start justify-content-start">
        <a href="{{ route('contadores.index') }}" class="py-3 mr-5 dark:text-white"><i class="fa fa-arrow-left"></i>
            Voltar</a>
        <h3>| Alterar Contador</h3>
    </div>
    <div class="clearfix"></div>
    <x-form wire:submit.prevent="update" method="put">
        @include('livewire.contadores.fields')
        <x-form.submit>Atualizar</x-form.submit>
    </x-form>
</div>
