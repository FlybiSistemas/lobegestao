<x-guest-layout>
    @section('title', 'Recriar senha')
    <x-auth-card>

        <p>Informe seu e-mail. Enviaremos um e-mail com as instruções para recriar sua senha.</p>
        @include('errors.messages')
        <x-form action="{{ route('password.email') }}">
            <x-form.input name="email" label="E-mail">{{ old('email') }}</x-form.input>
            <p><button type="submit" class="justify-center w-full btn btn-primary">Confirmar</button></p>

            <p><a href="{{ route('login') }}" class="float-right">Entrar</a></p>
        </x-form>
    </x-auth-card>
</x-guest-layout>
