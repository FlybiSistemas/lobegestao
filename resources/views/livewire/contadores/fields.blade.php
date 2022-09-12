<div class="row grid grid-cols-12 gap-4">
    <div class="col-span-12">
        <x-form.input wire:model="nome" label="Nome" name="nome" required>{{ old('nome') }}
        </x-form.input>
    </div>
    <div class="col-span-4">
        <x-form.input wire:model="usuario" label="Usuário" name="usuario" required>{{ old('usuario') }}
        </x-form.input>
    </div>
    <div class="col-span-4">
        <x-form.input wire:model="senha" label="Senha" name="senha" required>{{ old('senha') }}
        </x-form.input>
    </div>
</div>
