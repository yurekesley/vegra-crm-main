<x-app-layout>
    <x-slot name="header">
        {{ __('Convidar corretor') }}
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form action="{{ route('partners.brokers.store', $partner->id) }}" method="POST">
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
                        <div class="col-span-6 sm:col-span-2">
                            <label for="email"
                                class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                            <input type="text" name="email" id="email" autocomplete="email"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm read-only:bg-gray-100 focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                value="{{ old('email') }}">
                            @error('email')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- CPF -->
                        <div class="col-span-6 md:col-span-2">
                            <x-label for="cpf" :value="__('CPF')" />

                            <x-input id="cpf" class="block w-full mt-1" type="text" name="cpf"
                                data-mask="000.000.000-00" :value="old('cpf')" />
                        </div>

                        <!-- CRECI -->
                        <div class="col-span-6 md:col-span-2">
                            <x-label for="creci" :value="__('CRECI')" />

                            <x-input id="creci" class="block w-full mt-1" type="text" name="creci"
                                maxlength="11" :value="old('creci')" autofocus />
                        </div>

                        <div class="col-span-6 md:col-span-2">
                            <x-label for="phone" :value="__('Telefone')" />

                            <x-input id="phone" class="block w-full mt-1 phone-mask" type="text" name="phone"
                                :value="old('phone')" />
                        </div>

                        <div class="flex items-end col-span-6 pb-1 sm:col-span-2">
                            <div class="relative flex items-center">
                                <div class="flex items-center h-5">
                                    <input id="whatsapp" name="whatsapp" type="checkbox"
                                        {{ old('whatsapp') ? 'checked' : '' }}
                                        class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                </div>
                                <div class="flex flex-col items-start justify-center ml-3 text-sm">
                                    <label for="whatsapp" class="font-medium text-gray-700">WhatsApp</label>
                                    <p class="text-gray-500">
                                        {{ __('O telefone é utilizado para WhatsApp também') }}.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                    <a href="{{ route('partners.brokers.index', $partner->id) }}"
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
</x-app-layout>
