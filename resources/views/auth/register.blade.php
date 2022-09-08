<x-guest-layout>
    @section('title', 'Registrar')
    <x-auth-card>
        @include('errors.success')
        <x-form action="{{ route('register') }}">
            <x-form.input type="text" label='Nome' name="name">{{ old('name') }}</x-form.input>
            <x-form.input type="text" label='E-mail' name="email">{{ old('email') }}</x-form.input>
            <x-form.input type="password" label='Senha' name='password'></x-form.input>
            <x-form.input type="password" label='Confirme a senha' name='confirmPassword'></x-form.input>

            <p>Já possui uma conta? <a class="text-primary" href="{{ route('login') }}">Clique aqui para entrar</a></p>

            <x-button>Salvar</x-button>
        </x-form>
    </x-auth-card>
</x-guest-layout>
