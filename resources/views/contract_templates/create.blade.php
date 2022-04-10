<x-app-layout>
    <x-slot name="header">
        {{ __('Criar minuta') }}
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form action="{{ route('contract_templates.store') }}" method="POST">
            @csrf
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-2">
                            <label for="name"
                                class="block text-sm font-medium text-gray-700">{{ __('Nome') }}</label>
                            <input type="text" name="name" id="name" autocomplete="given-name"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                value="{{ old('name') }}" autofocus>
                            @error('name')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 md:col-span-1">
                            <label for="active"
                                class="block text-sm font-medium text-gray-700">{{ __('Situação') }}</label>
                            <select id="active" name="active"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                <option @if (old('active')) selected @endif value="true" )>Ativa</option>
                                <option @if (!old('active')) selected @endif value="false" )>Inativa</option>
                            </select>
                            @error('active')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 md:col-span-2">
                            <label for="product_id"
                                class="block text-sm font-medium text-gray-700">{{ __('Produto') }}</label>
                            <select id="product_id" name="product_id"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                @foreach($products as $product)
                                    <option @if (old('product_id') == $product->id) selected @endif value="{{ $product->id }}" )>{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-6 gap-6 mt-6">
                        <div class="col-span-6">
                            <h3 class="font-medium leading-6 text-gray-900 text-md">
                                {{ __('Conteúdo da minuta') }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Este é o template que será utilizado para gerar os contratos
                            </p>
                            <hr class="w-full mt-2" />
                            <div class="w-full sm:items-start sm:pt-5">
                                <div class="mt-1 sm:mt-0">
                                    <x-tinymce-editor id="content"
                                        name="content" rows="20"
                                        :content="old('content')"
                                        class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </x-tinymce-editor>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                    <a href="{{ route('contract_templates.index') }}"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('Voltar') }}</a>
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-700 border border-transparent rounded-md shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('Criar') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
