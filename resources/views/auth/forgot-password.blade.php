<x-guest-layout>
    <x-auth-card>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Esqueceu a senha? Sem problemas. Informe seu email e iremos enviar um link para criar uma nova senha.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Lembrei minha senha') }}
                </a>
                <x-button>
                    {{ __('Enviar link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
