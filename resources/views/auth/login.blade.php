<x-guest-layout>
    <x-auth-card>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Senha')" />

                <x-input id="password" class="block w-full mt-1"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('welcome') }}">
                    {{ __('Não tem cadastro?') }}
                </a>

                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Esqueceu a senha?') }}
                    </a>
                @endif

                <x-button class="flex items-center justify-center px-4 py-2 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-700 border border-transparent rounded-md hover:bg-red-800 focus:outline-none disabled:opacity-25">
                    {{ __('Acessar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
