<x-app-layout>
    <x-slot name="header">
        {{ __('Editar perfil') }}
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form action="{{ route('access_profiles.update', $accessProfile->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nome') }}</label>
                            <input type="text" name="name" id="name" autocomplete="given-name"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                value="{{ old('name') ?? $accessProfile->name }}" autofocus>
                            @error('name')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 md:col-span-1">
                            <label for="active"
                                class="block text-sm font-medium text-gray-700">{{ __('Situação') }}</label>
                            <select id="location" name="active" id="user_status"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                <option @if (old('active') ?? $accessProfile->active) selected @endif value="true">Ativo</option>
                                <option @if (!(old('active') ?? $accessProfile->active)) selected @endif value="false">Inativo</option>
                            </select>
                            @error('active')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6">

                        </div>
                    </div>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <h2 class="col-span-6 mb-2 text-xl font-semibold leading-tight text-gray-600">
                                {{ __('Permissões') }}
                            </h2>
                            <fieldset
                                class="md:max-h[200px] lg:max-h-[400px] overflow-auto border-t border-b border-gray-200 pr-5">
                                <div class="divide-y divide-gray-200">
                                    @foreach ($permissions as $permission)
                                        <div class="relative flex items-center py-4">
                                            <div class="flex-1 min-w-0 text-sm">
                                                <label for="comments"
                                                    class="font-medium text-gray-700">{{ $permission->name }}</label>
                                                <p id="comments-description" class="text-gray-500">Get
                                                    notified
                                                    when someones posts a comment on a posting.</p>
                                            </div>
                                            <div class="flex items-center h-5 ml-3">
                                                <input id="permissions[]" aria-describedby="{{ $permission->name }}"
                                                    name="permissions[]" type="checkbox"
                                                    value="{{ $permission->id }}"
                                                    {{ $accessProfile->permissions->contains($permission) ? 'checked' : '' }}
                                                    class="w-6 h-6 text-red-600 border-gray-500 rounded focus:ring-red-500">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                    <a href="{{ route('access_profiles.index') }}"
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
