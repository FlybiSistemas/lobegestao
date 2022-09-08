<x-guest-layout>
    @section('title', 'Recriar senha')
    <x-auth-card>

        @include('errors.messages')

        <x-form action="{{ route('password.reset.update', ['token' => $token]) }}">
            <x-form.input name="token" type="hidden" label="none">{{ $token }}</x-form.input>

            <p>Proteja sua conta utilizando uma senha maior e mais segura.</p>
            <p>Use um gerenciador de senha se precisar ou <a href="https://passwordsgenerator.net/" target="blank"
                    class="link link-blue">clique aqui</a> para gerar uma senha segura</p>

            <div class="alert alert-primary">
                <p class="text-white">Novas senhas precisam ter ao menos 8 caracteres<br>
                    pelo menos uma letra minúscula<br>
                    pelo menos uma letra maiúscula<br>
                    pelo menos um número</p>
            </div>

            <x-form.input name="email" label="E-mail">{{ old('email', request('email')) }}</x-form.input>
            <x-form.input name="password" label="Senha" type="password"></x-form.input>
            <x-form.input name="password_confirmation" label="Confirme a senha" type="password"></x-form.input>

            <p>
                <x-button type="submit" class="justify-center w-full">Atualizar senha</x-button>
            </p>

            <p><a href="{{ route('login') }}" class="float-right">Entrar</a></p>

        </x-form>

    </x-auth-card>
</x-guest-layout>
