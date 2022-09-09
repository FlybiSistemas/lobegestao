<div>
    <div class="card">
        <h3>IPs permitidos</h3>

        <div class="bg-primary p-2 text-gray-100 rounded">
            Se marcar o usuário para acesso apenas no escritório, os IPs abaixo serão validados no login dele.
        </div>

        <x-form wire:submit.prevent="update" method="put">

            <table>
                <tr>
                    <td colspan="3" class="text-sm">Seu IP atual é: {{ request()->ip() }}</td>
                </tr>
                <tr>
                    <th>IP</th>
                    <th>Descrição</th>
                    <th></th>
                </tr>
                @foreach ($ips as $index => $row)
                    @error("ips.$index.ip")
                        <tr>
                            <td colspan="3">
                                <span class="text-red-600">{{ $message }}</span>
                            </td>
                        </tr>
                    @enderror
                    <tr>
                        <td>
                            <x-form.input wire:model="ips.{{ $index }}.ip" label="none">{{ $row['ip'] }}
                            </x-form.input>
                        </td>
                        <td>
                            <x-form.input wire:model="ips.{{ $index }}.comment" label="none">
                                {{ $row['comment'] }}</x-form.input>
                        </td>
                        <td class="flex justify-center pt-2"><button type="button"
                                wire:click="remove({{ $index }})" class="text-red-600">X</button></td>
                    </tr>
                @endforeach
            </table>

            <p>
                <x-button color="blue" wire:click="add">Adicionar outro</x-button>

                <x-button>Salvar</x-button>

        </x-form>

        @include('errors.messages')

    </div>
</div>
