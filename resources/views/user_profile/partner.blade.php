<x-app-layout>
    <x-slot name="header">
        {{ __('Perfil do ') . $user->translatedUserType() }}
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form method="POST" action="{{ route('user_profile.update', $user->id) }}" enctype="multipart/form-data">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="type" name="type" value="{{ $user->user_type }}" />
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="name" :value="__('Nome')" />

                            <x-input id="name" class="block w-full mt-1" type="text" name="name"
                                :value="old('name') ?? $partner->name" required autofocus />
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block w-full mt-1 text-gray-500 bg-gray-100" type="email"
                                name="email" :value="$partner->email" required readonly
                                title="Email não pode ser alterado" />
                        </div>
                        <div class="col-span-12 md:col-span-2">
                            <x-label for="phone" :value="__('Telefone')" />

                            <x-input id="phone" class="block w-full mt-1" type="text" name="phone"
                                :value="old('phone') ?? $partner->phone" required autofocus />
                        </div>
                        <div class="flex items-end col-span-6 pb-1 sm:col-span-3">
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
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="responsible" :value="__('Responsável')" />

                            <x-input id="responsible" class="block w-full mt-1" type="text" name="responsible"
                                :value="old('responsible')  ?? $partner->responsible" required autofocus />
                        </div>
                        <div class="col-span-12 md:col-span-2">
                            <x-label for="cnpj" :value="__('CNPJ')" />

                            <x-input id="cnpj" class="block w-full mt-1 text-gray-500 bg-gray-100" type="text"
                                name="cnpj" data-mask="00.000.000/0000-00" :value="old('cnpj') ?? $partner->cnpj"
                                required readonly title="CNPJ não pode ser alterado" />
                        </div>
                        <div class="col-span-12 md:col-span-2">
                            <x-label for="creci" :value="__('CRECI')" />

                            <x-input id="creci" class="block w-full mt-1" type="text" name="creci" maxlength="11"
                                :value="old('creci') ?? $partner->creci" required autofocus />
                        </div>
                        <div class="justify-center col-span-12">
                            <x-label for="picture_url" :value="__('Foto de perfil')" />
                            <div class="flex items-center justify-start w-full">
                                <label
                                    class="flex flex-col w-32 h-32 cursor-pointer hover:bg-gray-100 hover:border-gray-300">
                                    <div class="relative flex flex-col items-center justify-center pt-10">
                                        <img id="preview_picture_url" class="absolute inset-0 object-cover w-full h-32"
                                            {{ $user->picture_url != null ? 'src=' . $user->picture_url . '' : '' }}>
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" width="32" height="32"
                                            fill="gray" y="0px" viewBox="0 0 1000 1000"
                                            enable-background="new 0 0 1000 1000" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M888.4,229.2c-21.3-29-50.9-62.9-83.4-95.4c-32.5-32.5-66.4-62.2-95.4-83.4c-49.4-36.2-73.3-40.4-87-40.4H147.8c-42.2,0-76.6,34.3-76.6,76.6v826.9c0,42.2,34.3,76.6,76.6,76.6h704.4c42.2,0,76.6-34.3,76.6-76.6V316.3C928.8,302.5,924.6,278.6,888.4,229.2z M761.6,177.1c29.4,29.4,52.4,55.9,69.5,77.9H683.8V107.7C705.7,124.7,732.3,147.7,761.6,177.1L761.6,177.1z M867.5,913.4c0,8.3-7,15.3-15.3,15.3H147.8c-8.3,0-15.3-7-15.3-15.3V86.6c0-8.3,7-15.3,15.3-15.3c0,0,474.6,0,474.7,0v214.4c0,16.9,13.7,30.6,30.6,30.6h214.4V913.4z" />
                                                    <path
                                                        d="M714.4,806.3H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,806.3,714.4,806.3z" />
                                                    <path
                                                        d="M714.4,683.8H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,683.8,714.4,683.8z" />
                                                    <path
                                                        d="M714.4,561.3H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,561.3,714.4,561.3z" />
                                                </g>
                                            </g>
                                        </svg>
                                        <p class="pt-1 text-xs tracking-wider text-center text-gray-400 group-hover:text-gray-600">
                                            Selecionar imagem (jpg, png)</p>
                                        </p>
                                    </div>
                                    <input id="picture_url" name="picture_url" type="file"
                                        class="opacity-0 image-upload" />
                                </label>
                            </div>
                            @error('picture_url')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-12 mt-5">
                            <p class="text-orange-500">
                                {{ __('Preencha os campos senha apenas se quiser alterar sua senha. Caso contrário, deixe em branco para manter a senha atual') }}
                            </p>
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="password" :value="__('Senha')" />

                            <x-input id="password" class="block w-full mt-1" type="password" name="password"
                                autocomplete="new-password" />
                        </div>
                        <div class="col-span-12 mb-5 md:col-span-3">
                            <x-label for="password_confirmation" :value="__('Confirme a Senha')" />

                            <x-input id="password_confirmation" class="block w-full mt-1" type="password"
                                name="password_confirmation" />
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
