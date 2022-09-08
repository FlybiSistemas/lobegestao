<x-guest-layout>
    @section('title', 'Login')
    <x-auth-card>

        <x-form action="{{ route('login') }}">

            @include('errors.messages')

            <x-form.input name="email" label="E-mail">{{ old('email') }}</x-form.input>
            <x-form.input name="password" label="Senha" type="password" />

            <div class="flex justify-between">
                <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Registrar</a>
                @endif
            </div>

            <p><button type="submit" class="justify-center w-full btn btn-primary">Entrar</button></p>

        </x-form>

    </x-auth-card>

</x-guest-layout>
