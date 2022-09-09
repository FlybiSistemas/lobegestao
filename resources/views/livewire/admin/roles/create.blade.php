<div>
    <x-modal>
        <x-slot name="trigger">
            <button class="btn btn-primary" @click="on = true">Adicionar Grupo</button>
        </x-slot>

        <x-slot name="title">Adicionar Grupo</x-slot>

        <x-slot name="content">

            <x-form.input wire:model="role" label="Nome do Grupo" name="role" required>{{ old('role') }}
            </x-form.input>

        </x-slot>

        <x-slot name="footer">
            <button class="btn" @click="on = false">Cancelar</button>
            <button class="btn btn-primary" wire:click="store">Salvar</button>
        </x-slot>

    </x-modal>
</div>
