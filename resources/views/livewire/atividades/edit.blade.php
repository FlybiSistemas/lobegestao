@section('title', 'Atualizar atividades')
<div class="mx-auto max-w-screen-lg">
    <div class="mb-5 flex items-start justify-content-start">
        <a href="{{ route('atividades.index') }}" class="py-3 mr-5"><i class="fa fa-arrow-left"></i> Voltar</a>
        <h3>| Alterar Atividade</h3>
    </div>
    <div class="clearfix"></div>
    <x-form wire:submit.prevent="update" method="put">
        <div class="row">
            <div class="md:w-1/2">
                <x-form.input wire:model="nome" label='Nome' name='nome' required></x-form.input>
            </div>
        </div>
        <x-form.submit>Atualizar</x-form.submit>
    </x-form>
</div>
