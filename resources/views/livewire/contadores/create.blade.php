<div>
    <x-modal>
        <x-slot name="trigger">
            <button class="btn btn-primary" @click="on = true">Adicionar Contador</button>
        </x-slot>

        <x-slot name="title">Adicionar Contador</x-slot>

        <x-slot name="content">
            @include('livewire.contadores.fields')
        </x-slot>

        <x-slot name="footer">
            <button class="btn" @click="on = false">Cancelar</button>
            <button class="btn btn-primary" wire:click="store">Salvar</button>
        </x-slot>

    </x-modal>
</div>
