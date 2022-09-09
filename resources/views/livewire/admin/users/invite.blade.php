<div>
    <x-modal>
        <x-slot name="trigger">
            <button class="btn btn-primary" @click="on = true">Convidar Usuário</button>
        </x-slot>

        <x-slot name="title">Convidar Usuário</x-slot>

        <x-slot name="content">

            @include('errors.success')

            <x-form.input tabindex="1" wire:model="name" label="Nome" name="name" required></x-form.input>
            <x-form.input tabindex="3" wire:model="email" label="E-mail" name="email" required></x-form.input>

            <h4>Roles</h4>

            @error('rolesSelected')
                <p class="error">{{ $message }}</p>
            @enderror

            @foreach ($roles as $role)
                <p>
                    <x-form.checkbox name="grupos_{{ $role->id }}" wire:model="rolesSelected" :label="$role->label"
                        :wire:key="$role->id" value="{{ $role->id }}" />
            @endforeach
        </x-slot>

        <x-slot name="footer">
            <button @click="on = false">Cancelar</button>
            <button class="btn btn-primary" wire:click="store">Enviar convite</button>
        </x-slot>

    </x-modal>
</div>
