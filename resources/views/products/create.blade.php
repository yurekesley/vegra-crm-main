<x-app-layout>
    <x-slot name="header">
        {{ __('Criar produto') }}
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nome') }}</label>
                            <input type="text" name="name" id="name" autocomplete="given-name"
                                placeholder="Informe um nome para o produto"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                value="{{ old('name') }}" autofocus>
                            @error('name')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="email"
                                class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                            <input type="text" name="email" id="email" autocomplete="given-email"
                                placeholder="Informe o email de contato do produto"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                value="{{ old('slug') }}" autofocus>
                            @error('email')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="slug"
                                class="block text-sm font-medium text-gray-700">{{ __('Chave Web') }}</label>
                            <input type="text" name="slug" id="slug" autocomplete="given-slug"
                                placeholder="Vamos sugerir a chave com base no nome"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                value="{{ old('slug') }}" autofocus>
                            <small class="text-gray-400 font-sm">* A chave precisa estar em letras minúsculas e sem
                                espaços</small>
                            @error('slug')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                    <a href="{{ route('products.index') }}"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('Voltar') }}</a>
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('Criar') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', (e) => {
                $('#name').on('input', function() {
                    console.log(this.value);
                    $('#slug').val(this.value.toLowerCase()
                        .replace(/ /g, '-')
                        .replace(/[^\w-]+/g, ''));
                });
            });
        </script>
    @endsection
</x-app-layout>
