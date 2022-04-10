<x-app-layout>
    <x-slot name="header">
        {{ __('Ediar usuário interno') }}
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <input type="hidden" id="type" name="type" value="partner" />
                    <div class="grid grid-cols-6 gap-4">
                        <!-- Name -->
                        <div class="col-span-6 md:col-span-2">
                            <x-label for="name" :value="__('Nome')" />

                            <x-input id="name" class="block w-full mt-1" type="text" name="name"
                                :value="old('name') ?? $user->name" required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="col-span-6 md:col-span-2">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block w-full mt-1 text-gray-500 bg-gray-100" type="email"
                                name="email" :value="$user->email" required readonly
                                title="Email não pode ser alterado" />
                        </div>
                        @if ($user->id != auth()->id())
                            <div class="col-span-6 md:col-span-2">
                                <label for="access_profile_id"
                                    class="block text-sm font-medium text-gray-700">{{ __('Perfil de Acesso') }}</label>
                                <select id="location" name="access_profile_id" id="access_profile_id"
                                    placeholder="{{ __('Selecione um perfil') }}"
                                    class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                    <option disabled selected>Selecione um perfil</option>
                                    @foreach ($accessProfiles as $profile)
                                        @if (old('access_profile_id') ?? $user->access_profile_id == $profile->id)
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
                        <!-- Phone Number -->
                        <div class="col-span-6 md:col-start-1 md:col-span-1">
                            <x-label for="phone" :value="__('Telefone')" />

                            <x-input id="phone" class="block w-full mt-1 phone-mask" type="text" name="phone"
                                :value="old('phone') ?? $user->phone" required autofocus />
                        </div>

                        <div class="flex items-end col-span-6 pb-1 sm:col-span-2">
                            <div class="relative flex items-center">
                                <div class="flex items-center h-5">
                                    <input id="whatsapp" name="whatsapp" type="checkbox"
                                        {{ $user->whatsapp ? 'checked' : '' }}
                                        class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                </div>
                                <div class="flex flex-col items-start justify-center ml-3 text-sm">
                                    <label for="whatsapp" class="font-medium text-gray-700">WhatsApp</label>
                                    <p class="text-gray-500">
                                        {{ __('O telefone é utilizado para WhatsApp também') }}.</p>
                                </div>
                            </div>
                        </div>

                        <!-- CPF -->
                        <div class="col-span-6 md:col-span-1">
                            <x-label for="cpf" :value="__('CPF')" />

                            <x-input id="cpf" class="block w-full mt-1" type="text" name="cpf"
                                data-mask="000.000.000-00" :value="old('cpf') ?? $user->cpf" required />
                        </div>

                        <!-- CRECI -->
                        <div class="col-span-6 md:col-span-1">
                            <x-label for="creci" :value="__('CRECI')" />

                            <x-input id="creci" class="block w-full mt-1" type="text" name="creci" maxlength="11"
                                :value="old('creci') ?? $user->creci" required autofocus />
                        </div>

                        <div class="col-span-6 md:col-span-1">
                            <label for="user_status"
                                class="block text-sm font-medium text-gray-700">{{ __('Situação') }}</label>
                            <select id="location" name="user_status" id="user_status"
                                @if ($user->user_status == 'pending') readonly disabled title="Usuário pendente de confirmação de email" @endif
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base @if ($user->user_status == 'pending') bg-gray-200 @endif border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                @if ($user->user_status == 'pending')
                                    <option selected value="pending" )>Pendente</option>
                                @else
                                    <option @if ($user->user_status == 'active') selected @endif value="active" )>Ativo
                                    </option>
                                    <option @if ($user->user_status == 'inactive') selected @endif value="inactive" )>Inativo
                                    </option>
                                @endif
                            </select>
                            @error('user_status')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="manager"
                                class="block text-sm font-medium text-gray-700">{{ __('Gerente') }}</label>
                            <select name="manager" id="manager" placeholder="{{ __('Selecione um perfil') }}"
                                class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                <option {{ (old('manager') ?? $user->manager_id) == null ? 'selected' : '' }} value="null">{{ __('Não possui gerente') }}
                                </option>
                                @foreach ($users as $managerUser)
                                    @if ((old('manager') ?? $user->manager_id) == $managerUser->id)
                                        <option value="{{ $managerUser->id }}" selected>
                                            {{ $managerUser->name }}</option>
                                    @else
                                        <option value="{{ $managerUser->id }}">{{ $managerUser->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('manager')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="director"
                                class="block text-sm font-medium text-gray-700">{{ __('Diretor') }}</label>
                            <select name="director" id="director" placeholder="{{ __('Selecione um perfil') }}"
                                class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                <option {{ (old('director') ?? $user->director_id) == null ? 'selected' : '' }} value="null">{{ __('Não possui diretor') }}
                                </option>
                                @foreach ($users as $directorUser)
                                    @if ((old('director') ?? $user->director_id) == $directorUser->id)
                                        <option value="{{ $directorUser->id }}" selected>
                                            {{ $directorUser->name }}</option>
                                    @else
                                        <option value="{{ $directorUser->id }}">{{ $directorUser->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('director')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                    <a href="{{ route('users.index') }}"
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
