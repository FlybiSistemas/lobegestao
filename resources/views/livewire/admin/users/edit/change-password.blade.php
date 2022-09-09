<div>
    <x-2col>
        <x-slot name="left">
            <h3>Atualizar senha</h3>
            <p>Utilize uma senha segura.</p>
        </x-slot>
        <x-slot name="right">

            <div class="card">
                <x-form wire:submit.prevent="update" method="put">

                    <x-form.input wire:model="newPassword" type="password" label='Nova senha' name='newPassword'>
                    </x-form.input>
                    <x-form.input wire:model="confirmPassword" type="password" label='Confirme a senha'
                        name='confirmPassword'></x-form.input>

                    <x-button>Atualizar senha</x-button>

                    @include('errors.success')

                </x-form>
            </div>

        </x-slot>
    </x-2col>
</div>
