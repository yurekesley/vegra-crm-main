<x-app-layout>
    <x-slot name="header">
        {{ __('Editar corretor') }}
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form action="{{ route('partners.brokers.update', ['partner' => $partner->id, 'broker' => $broker->id]) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-12 gap-4">
                        <!-- Name -->
                        <div class="col-span-12 md:col-span-4">
                            <x-label for="name" :value="__('Nome')" />

                            <x-input id="name" class="block w-full mt-1" type="text" name="name"
                                :value="old('name') ?? $broker->name" required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block w-full mt-1 text-gray-500 bg-gray-100" type="email"
                                name="email" :value="$broker->email" required readonly
                                title="Email não pode ser alterado" />
                        </div>

                        <!-- Phone Number -->
                        <div class="col-span-12 md:col-span-2">
                            <x-label for="phone" :value="__('Telefone')" />

                            <x-input id="phone" class="block w-full mt-1 phone-mask" type="text" name="phone"
                                :value="old('phone') ?? $broker->phone" required autofocus />
                        </div>

                        <div class="flex items-end col-span-12 pb-1 sm:col-span-3">
                            <div class="relative flex items-center">
                                <div class="flex items-center h-5">
                                    <input id="whatsapp" name="whatsapp" type="checkbox"
                                        {{ $broker->whatsapp ? 'checked' : '' }}
                                        class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                </div>
                                <div class="flex flex-col items-start justify-center ml-3 text-sm">
                                    <label for="whatsapp" class="font-medium text-gray-700">WhatsApp</label>
                                    <p class="text-gray-500">{{ __('O telefone é utilizado para WhatsApp também') }}.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- CPF -->
                        <div class="col-span-12 md:col-start-1 md:col-span-3">
                            <x-label for="cpf" :value="__('CPF')" />

                            <x-input id="cpf" class="block w-full mt-1" type="text" name="cpf"
                                data-mask="000.000.000-00" :value="old('cpf') ?? $broker->cpf" required />
                        </div>

                        <!-- CRECI -->
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="creci" :value="__('CRECI')" />

                            <x-input id="creci" class="block w-full mt-1" type="text" name="creci" maxlength="11"
                                :value="old('creci') ?? $broker->creci" required autofocus />
                        </div>

                        <div class="col-span-12 md:col-span-3">
                            <label for="user_status"
                                class="block text-sm font-medium text-gray-700">{{ __('Situação') }}</label>
                            <select id="location" name="user_status" id="user_status"
                                @if ($broker->user_status == 'pending') readonly disabled title="Usuário pendente de confirmação de email" @endif
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base @if ($broker->user_status == 'pending') bg-gray-200 @endif border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                @if ($broker->user_status == 'pending')
                                    <option selected value="pending" )>Pendente</option>
                                @else
                                    <option @if ($broker->user_status == 'active') selected @endif value="active" )>Ativo
                                    </option>
                                    <option @if ($broker->user_status == 'inactive') selected @endif value="inactive" )>Inativo
                                    </option>
                                @endif
                            </select>
                            @error('user_status')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                    <a href="{{ route('partners.brokers.index', $partner->id) }}"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('Voltar') }}</a>
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('Alterar') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
