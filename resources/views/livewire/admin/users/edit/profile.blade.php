<div>
    <div class="card">

        <div class="flex justify-between">
            <h2 class="mb-5">Configurações da Conta</h2>
            <div>
                <span class="error">*</span>
                <span class="dark:text-gray-200"> = required</span>
            </div>
        </div>

        <x-form wire:submit.prevent="" method="put">

            <x-form.input wire:model="name" label='Nome' name='name' required></x-form.input>
            <x-form.input wire:model="email" label='E-mail' name='email' required></x-form.input>
            <x-form.input wire:model="image" type="file" label='Imagem' name='image'></x-form.input>
            @if ($image)
                Photo Preview:
                <img src="{{ $image->temporaryUrl() }}" width="100px" class="mb-5">
            @elseif(storage_exists($user->image))
                <img src="{{ storage_url($user->image) }}" width="100px" class="mb-5">
            @endif

            <x-button wire:click="update">Atualizar</x-button>

            @include('errors.messages')

        </x-form>

    </div>
</div>
