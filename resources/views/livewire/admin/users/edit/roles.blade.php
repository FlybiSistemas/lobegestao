<div>
    <x-2col>
        <x-slot name="left">
            <h3>Grupos de acesso</h3>
            <p>Se desmarcar todas, o usuário não poderá ver nenhum menu.</p>
        </x-slot>
        <x-slot name="right">

            <div class="card">
                <x-form wire:submit.prevent="update" method="put">

                    @foreach ($roles as $role)
                        <p><input type="checkbox" wire:model="roleSelections" value="{{ $role->id }}">
                            {{ $role->name }}</p>
                    @endforeach

                    <x-button class="mt-5">Atualizar grupos</x-button>

                    @include('errors.messages')

                </x-form>
            </div>

        </x-slot>
    </x-2col>

</div>
