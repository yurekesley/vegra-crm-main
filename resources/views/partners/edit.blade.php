<x-app-layout>
    <x-slot name="header">
        {{ __('Ediar parceiro') }}
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form action="{{ route('partners.update', $partner->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-2">
                            <label for="email"
                                class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                            <input type="text" name="email" id="email" autocomplete="email"
                                value="{{ $partner->email }}" readonly
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm read-only:bg-gray-100 focus:ring-red-500 focus:border-red-500 sm:text-sm">
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nome') }}</label>
                            <input type="text" name="name" id="name" autocomplete="given-name"
                                value="{{ $partner->name }}"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="cnpj"
                                class="block text-sm font-medium text-gray-700">{{ __('CNPJ') }}</label>
                            <input type="text" name="cnpj" id="cnpj" autocomplete="family-name"
                                data-mask="00.000.000/0000-00" value="{{ $partner->cnpj }}"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="responsible"
                                class="block text-sm font-medium text-gray-700">{{ __('Responsável') }}</label>
                            <input type="text" name="responsible" id="responsible" autocomplete="family-name"
                                value="{{ $partner->responsible }}"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="creci"
                                class="block text-sm font-medium text-gray-700">{{ __('CRECI') }}</label>
                            <input type="text" name="creci" id="creci" autocomplete="family-name"
                                value="{{ $partner->creci }}"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                        </div>
                        @if ($partner->user->id != auth()->id())
                            <div class="col-span-6 md:col-span-2">
                                <label for="access_profile_id"
                                    class="block text-sm font-medium text-gray-700">{{ __('Perfil de Acesso') }}</label>
                                <select id="location" name="access_profile_id" id="access_profile_id"
                                    placeholder="{{ __('Selecione um perfil') }}"
                                    class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                    <option disabled selected>Selecione um perfil</option>
                                    @foreach ($accessProfiles as $profile)
                                        @if (old('access_profile_id') ?? $partner->user->access_profile_id == $profile->id)
                                            <option value="{{ $profile->id }}" selected>{{ $profile->name }}
                                            </option>
                                        @else
                                            <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('access_profile_id')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        @endif
                        <div class="col-span-6 sm:col-start-1 sm:col-span-2">
                            <label for="phone"
                                class="block text-sm font-medium text-gray-700">{{ __('Telefone') }}</label>
                            <input type="text" name="phone" id="phone" autocomplete="family-name"
                                value="{{ $partner->phone }}"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                        </div>

                        <div class="flex items-end col-span-6 pb-1 sm:col-span-2">
                            <div class="relative flex items-center">
                                <div class="flex items-center h-5">
                                    <input id="whatsapp" name="whatsapp" type="checkbox"
                                        {{ $partner->whatsapp ? 'checked' : '' }}
                                        class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                </div>
                                <div class="flex flex-col items-start justify-center ml-3 text-sm">
                                    <label for="whatsapp" class="font-medium text-gray-700">WhatsApp</label>
                                    <p class="text-gray-500">
                                        {{ __('O telefone é utilizado para WhatsApp também') }}.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 md:col-span-2">
                            <label for="user_status"
                                class="block text-sm font-medium text-gray-700">{{ __('Situação') }}</label>
                            <select id="location" name="user_status" id="user_status"
                                @if ($partner->user->user_status == 'pending') readonly disabled title="Usuário pendente de confirmação de email" @endif
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base @if ($partner->user->user_status == 'pending') bg-gray-200 @endif border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                @if ($partner->user->user_status == 'pending')
                                    <option selected value="pending" )>Pendente de aprovação</option>
                                @else
                                    <option @if ($partner->user->user_status == 'active') selected @endif value="active" )>Ativo
                                    </option>
                                    <option @if ($partner->user->user_status == 'inactive') selected @endif value="inactive" )>Inativo
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
                    <a href="{{ route('partners.index') }}"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Voltar</a>
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Alterar
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
