<div>
    <x-modal>
        <x-slot name="trigger">
            <button class="btn btn-primary" @click="on = true">Adicionar Atividade</button>
        </x-slot>

        <x-slot name="title">Adicionar Atividade</x-slot>

        <x-slot name="content">
            <x-form.input wire:model="nome" label="Nome" name="nome" required>{{ old('nome') }}</x-form.input>
        </x-slot>

        <x-slot name="footer">
            <button class="btn" @click="on = false">Cancelar</button>
            <button class="btn btn-primary" wire:click="store">Salvar</button>
        </x-slot>

    </x-modal>
</div>
