@section('title', 'Atualizar atividades')
<div>
    <div class="mb-5">
        <a href="{{ route('atividades.index') }}">Atividades</a>
        <span class="dark:text-gray-200">- Editar Atividade</span>
    </div>
    <div class="float-right"><span class="text-red-600">*</span> <span class="dark:text-gray-200"> = required</span>
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
