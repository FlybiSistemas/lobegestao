<div>

    <div class="card">

        <h3 class="mb-4">Configurações do Gestor</h3>

        <x-form wire:submit.prevent="update" method="put">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form.input wire:model="siteName" name="siteName" label="Nome do sistema" />
            </div>

            <x-button>Atualizar</x-button>

        </x-form>

        @include('errors.messages')

    </div>
</div>
