<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vegra - Gestão de Negócios</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="h-full">
    <div class="min-h-full">
        <div class="pb-32 bg-red-900">
            <nav class="bg-red-900 border-b border-red-300 border-opacity-25 lg:border-none">
                <div class="px-2 mx-auto sm:px-4 lg:px-8">
                    <div
                        class="relative flex items-center w-full h-16 lg:border-b lg:border-red-400 lg:border-opacity-25">
                        <div class="flex items-center justify-end w-full px-2 lg:px-0">
                            <div class="hidden lg:block lg:ml-10">
                                <div class="flex space-x-4">
                                    <a href="#" id="open-lgpd-link"
                                        class="px-3 py-2 text-sm font-medium text-white rounded-md hover:bg-red-500 hover:bg-opacity-75">
                                        {{ __('LGPD') }}
                                    </a>
                                    <a href="/dashboard"
                                        class="px-3 py-2 text-sm font-medium text-white rounded-md hover:bg-red-500 hover:bg-opacity-75">
                                        {{ __('Acesso ao sistema') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="flex lg:hidden">
                            <!-- Mobile menu button -->
                            <button type="button"
                                class="inline-flex items-center justify-center p-2 text-red-200 bg-red-600 rounded-md hover:text-white hover:bg-red-500 hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-600 focus:ring-white"
                                aria-controls="mobile-menu" aria-expanded="false">
                                <span class="sr-only">{{ __('Abrir menu principal') }}</span>
                                <!--
                          Heroicon name: outline/menu

                          Menu open: "hidden", Menu closed: "block"
                        -->
                                <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                <!--
                          Heroicon name: outline/x

                          Menu open: "block", Menu closed: "hidden"
                        -->
                                <svg class="hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
            <header class="py-10">
                <div class="flex justify-center px-4 mx-auto sm:px-6 lg:px-8">
                    <img src="https://yata-apix-ee4bc549-f13e-4202-9855-4f92b3d3d704.lss.locawebcorp.com.br/dcbda08f55254bdc850c17721bf800d9.png"
                        alt="Logo Vegra">
                </div>
            </header>
        </div>

        <main class="-mt-32">
            <div class="px-4 pb-12 mx-auto sm:px-6 lg:px-8">
                <div class="grid items-start grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">
                    <div class="grid grid-cols-1 gap-4 lg:col-span-2">
                        <section aria-labelledby="section-1-title">
                            <h2 class="sr-only" id="section-1-title">Section title</h2>
                            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                                <div class="p-6">
                                    <h2 class="text-xl font-bold text-gray-900">
                                        {{ __('Empreendimentos') }}
                                    </h2>
                                    <p class="mb-6 text-gray-600">
                                        {{ __('Acesso aos empreendimentos para ficha cadastral e propostas de aquisição') }}
                                    </p>
                                    <ul role="list"
                                        class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3">
                                        @foreach ($products as $product)
                                            <li
                                                class="col-span-1 bg-[url('https://images.unsplash.com/photo-1516156008625-3a9d6067fab5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=300&q=80')] bg-cover rounded-lg shadow-md divide-y divide-gray-200">
                                                <div
                                                    class="flex items-center justify-between w-full p-6 pb-12 space-x-6 bg-black bg-opacity-50 rounded-t-md">
                                                    <div class="flex-1 truncate">
                                                        <div class="flex items-center justify-between space-x-3">
                                                            <h3
                                                                class="text-sm font-bold text-white truncate drop-shadow-md shadow-gray-200">
                                                                {{ $product->name }}</h3>
                                                            @if (!$product->enable_prospects && !$product->allow_proposals)
                                                                <span
                                                                    class="flex-shrink-0 inline-block px-2 py-0.5 text-white text-xs font-medium bg-gray-500 rounded-full"
                                                                    title="Bloqueado">
                                                                    <svg fill="#fff" xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 48 48" width="16px" height="16px"
                                                                        title="Bloqueado">
                                                                        <path
                                                                            d="M 24 4 C 19.599415 4 16 7.599415 16 12 L 16 16 L 12.5 16 C 10.032499 16 8 18.032499 8 20.5 L 8 39.5 C 8 41.967501 10.032499 44 12.5 44 L 35.5 44 C 37.967501 44 40 41.967501 40 39.5 L 40 20.5 C 40 18.032499 37.967501 16 35.5 16 L 32 16 L 32 12 C 32 7.599415 28.400585 4 24 4 z M 24 7 C 26.779415 7 29 9.220585 29 12 L 29 16 L 19 16 L 19 12 C 19 9.220585 21.220585 7 24 7 z M 12.5 19 L 35.5 19 C 36.346499 19 37 19.653501 37 20.5 L 37 39.5 C 37 40.346499 36.346499 41 35.5 41 L 12.5 41 C 11.653501 41 11 40.346499 11 39.5 L 11 20.5 C 11 19.653501 11.653501 19 12.5 19 z M 24 27 A 3 3 0 0 0 24 33 A 3 3 0 0 0 24 27 z" />
                                                                    </svg>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div
                                                        class="flex -mt-px bg-white divide-x divide-gray-150 rounded-b-md">
                                                        @if ($product->enable_prospects)
                                                            <div class="flex flex-1 w-0 rounded-bl-lg">
                                                                <a href="{{ route('prospects.registration.index', $product->id) }}"
                                                                    class="relative inline-flex items-center justify-center flex-1 w-0 py-4 -mr-px font-medium text-red-700 border border-transparent rounded-bl-lg md:text-xs xl:text-base hover:text-white hover:bg-red-700">
                                                                    <span
                                                                        class="ml-1">{{ __('Cadastros') }}</span>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="flex flex-1 w-0 rounded-bl-lg">
                                                                <a href="#"
                                                                    class="relative inline-flex items-center justify-center flex-1 w-0 py-4 -mr-px font-medium text-gray-300 border border-transparent rounded-bl-lg cursor-not-allowed md:text-xs xl:text-base"
                                                                    title="Bloqueado">
                                                                    <span
                                                                        class="ml-1">{{ __('Cadastros') }}</span>
                                                                </a>
                                                            </div>
                                                        @endif
                                                        @if ($product->allow_proposals)
                                                            <div class="flex flex-1 w-0">
                                                                <a href="{{ route('proposals.registration.index', $product->id) }}"
                                                                    class="relative inline-flex items-center justify-center flex-1 w-0 py-4 -mr-px font-medium text-yellow-700 border border-transparent md:text-xs xl:text-base hover:text-white hover:bg-yellow-700">
                                                                    <span
                                                                        class="ml-1">{{ __('Propostas') }}</span>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="flex flex-1 w-0">
                                                                <a href="#"
                                                                    class="relative inline-flex items-center justify-center flex-1 w-0 py-4 -mr-px font-medium text-gray-300 border border-transparent cursor-not-allowed md:text-xs xl:text-base"
                                                                    title="Bloqueado">
                                                                    <span
                                                                        class="ml-1">{{ __('Propostas') }}</span>
                                                                </a>
                                                            </div>
                                                        @endif
                                                        @if ($product->enable_prospects)
                                                            <div class="flex -ml-px">
                                                                <a href="{{ $product->whatsAppUrl() }}"
                                                                    target="_blank" rel="noopener noreferrer nofollow"
                                                                    class="relative inline-flex items-center justify-center flex-1 px-3 py-4 text-sm font-medium text-green-600 border border-transparent rounded-br-lg hover:text-white hover:bg-green-600">
                                                                    <span>
                                                                        <svg viewBox="-0.003 -293.41895027729095 1172.923 1474.5159502772908"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill-rule="evenodd" clip-rule="evenodd"
                                                                            width="32" height="32"
                                                                            style="margin-top: -3px; margin-bottom: 3px;">
                                                                            <path
                                                                                d="M308.678 1021.49l19.153 9.576a499.739 499.739 0 0 0 258.244 70.227c279.729-.638 509.563-231.016 509.563-510.744 0-135.187-53.692-265.012-149.169-360.713-95.35-96.69-225.62-151.18-361.383-151.18-278.451 0-507.552 229.133-507.552 507.552 0 2.203 0 4.373.032 6.576a523.81 523.81 0 0 0 76.612 268.14l12.768 19.153-51.074 188.337 192.806-46.925z"
                                                                                fill="#00E676" fill-rule="nonzero" />
                                                                            <path
                                                                                d="M1003.29 172.378C894.597 61.482 745.49-.732 590.225 0h-.99C269.479.001 6.35 263.131 6.35 582.888c0 1.5.032 2.969.032 4.47a616.759 616.759 0 0 0 76.612 290.485L-.003 1181.097l309.32-79.804a569.202 569.202 0 0 0 278.993 70.228c320.939-1.756 584.036-266.385 583.844-587.356.766-154.213-60.044-302.52-168.864-411.787m-413.065 900.186a473.935 473.935 0 0 1-245.476-67.035l-19.153-9.577-184.187 47.883 47.882-181.953-12.768-19.153a484.242 484.242 0 0 1-72.558-254.957c0-265.65 218.599-484.25 484.25-484.25 265.65 0 484.248 218.6 484.248 484.25 0 167.269-86.666 323.11-228.781 411.372a464.838 464.838 0 0 1-251.86 73.42m280.59-354.329l-35.114-15.96s-51.075-22.346-82.996-38.306c-3.192 0-6.384-3.192-9.577-3.192a46.308 46.308 0 0 0-22.345 6.384c-6.799 3.99-3.192 3.192-47.882 54.266-3.032 5.97-9.257 9.705-15.96 9.577h-3.193a24.328 24.328 0 0 1-12.768-6.384l-15.961-6.385a309.91 309.91 0 0 1-92.573-60.65c-6.384-6.385-15.96-12.77-22.345-19.154a357.13 357.13 0 0 1-60.65-76.611l-3.193-6.384a46.475 46.475 0 0 1-6.384-12.769 23.915 23.915 0 0 1 3.192-15.96c2.905-4.789 12.769-15.962 22.345-25.538 9.577-9.576 9.577-15.96 15.961-22.345a39.33 39.33 0 0 0 6.384-31.922 1246.398 1246.398 0 0 0-51.074-121.301 37.099 37.099 0 0 0-22.345-15.961H380.82c-6.384 0-12.768 3.192-19.153 3.192l-3.192 3.192c-6.384 3.192-12.768 9.577-19.153 12.769-6.384 3.192-9.576 12.769-15.96 19.153a162.752 162.752 0 0 0-35.114 98.956 189.029 189.029 0 0 0 15.96 73.42l3.193 9.576a532.111 532.111 0 0 0 118.11 162.8l12.768 12.769a193.037 193.037 0 0 1 25.537 25.537c66.141 57.554 144.7 99.052 229.516 121.302 9.576 3.192 22.345 3.192 31.921 6.384h31.922a118.126 118.126 0 0 0 47.882-12.769c7.82-3.543 15.29-7.82 22.345-12.768l6.384-6.385c6.385-6.384 12.769-9.576 19.153-15.96a84.393 84.393 0 0 0 15.961-19.153c6.129-14.301 10.438-29.304 12.769-44.69V724.62a40.107 40.107 0 0 0-9.577-6.385"
                                                                                fill="#fff" fill-rule="nonzero" />
                                                                        </svg></span>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="flex -ml-px">
                                                                <a href="#"
                                                                    class="relative inline-flex items-center justify-center flex-1 px-3 py-4 text-sm font-medium text-green-600 line-through border border-transparent rounded-br-lg cursor-not-allowed"
                                                                    title="Bloqueado">
                                                                    <span>
                                                                        <svg viewBox="-0.003 -293.41895027729095 1172.923 1474.5159502772908"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill-rule="evenodd" clip-rule="evenodd"
                                                                            width="32" height="32"
                                                                            class="opacity-40"
                                                                            style="margin-top: -3px; margin-bottom: 3px;">
                                                                            <path
                                                                                d="M308.678 1021.49l19.153 9.576a499.739 499.739 0 0 0 258.244 70.227c279.729-.638 509.563-231.016 509.563-510.744 0-135.187-53.692-265.012-149.169-360.713-95.35-96.69-225.62-151.18-361.383-151.18-278.451 0-507.552 229.133-507.552 507.552 0 2.203 0 4.373.032 6.576a523.81 523.81 0 0 0 76.612 268.14l12.768 19.153-51.074 188.337 192.806-46.925z"
                                                                                fill="#00E676" fill-rule="nonzero" />
                                                                            <path
                                                                                d="M1003.29 172.378C894.597 61.482 745.49-.732 590.225 0h-.99C269.479.001 6.35 263.131 6.35 582.888c0 1.5.032 2.969.032 4.47a616.759 616.759 0 0 0 76.612 290.485L-.003 1181.097l309.32-79.804a569.202 569.202 0 0 0 278.993 70.228c320.939-1.756 584.036-266.385 583.844-587.356.766-154.213-60.044-302.52-168.864-411.787m-413.065 900.186a473.935 473.935 0 0 1-245.476-67.035l-19.153-9.577-184.187 47.883 47.882-181.953-12.768-19.153a484.242 484.242 0 0 1-72.558-254.957c0-265.65 218.599-484.25 484.25-484.25 265.65 0 484.248 218.6 484.248 484.25 0 167.269-86.666 323.11-228.781 411.372a464.838 464.838 0 0 1-251.86 73.42m280.59-354.329l-35.114-15.96s-51.075-22.346-82.996-38.306c-3.192 0-6.384-3.192-9.577-3.192a46.308 46.308 0 0 0-22.345 6.384c-6.799 3.99-3.192 3.192-47.882 54.266-3.032 5.97-9.257 9.705-15.96 9.577h-3.193a24.328 24.328 0 0 1-12.768-6.384l-15.961-6.385a309.91 309.91 0 0 1-92.573-60.65c-6.384-6.385-15.96-12.77-22.345-19.154a357.13 357.13 0 0 1-60.65-76.611l-3.193-6.384a46.475 46.475 0 0 1-6.384-12.769 23.915 23.915 0 0 1 3.192-15.96c2.905-4.789 12.769-15.962 22.345-25.538 9.577-9.576 9.577-15.96 15.961-22.345a39.33 39.33 0 0 0 6.384-31.922 1246.398 1246.398 0 0 0-51.074-121.301 37.099 37.099 0 0 0-22.345-15.961H380.82c-6.384 0-12.768 3.192-19.153 3.192l-3.192 3.192c-6.384 3.192-12.768 9.577-19.153 12.769-6.384 3.192-9.576 12.769-15.96 19.153a162.752 162.752 0 0 0-35.114 98.956 189.029 189.029 0 0 0 15.96 73.42l3.193 9.576a532.111 532.111 0 0 0 118.11 162.8l12.768 12.769a193.037 193.037 0 0 1 25.537 25.537c66.141 57.554 144.7 99.052 229.516 121.302 9.576 3.192 22.345 3.192 31.921 6.384h31.922a118.126 118.126 0 0 0 47.882-12.769c7.82-3.543 15.29-7.82 22.345-12.768l6.384-6.385c6.385-6.384 12.769-9.576 19.153-15.96a84.393 84.393 0 0 0 15.961-19.153c6.129-14.301 10.438-29.304 12.769-44.69V724.62a40.107 40.107 0 0 0-9.577-6.385"
                                                                                fill="#fff" fill-rule="nonzero" />
                                                                        </svg></span>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <section aria-labelledby="section-1-title">
                            <h2 class="sr-only" id="section-1-title">{{ __('Parceiros') }}</h2>
                            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                                <div class="p-6">
                                    <h2 class="text-xl font-medium text-gray-900">
                                        {{ __('Parceiros') }}
                                    </h2>
                                    <p class="mb-6 text-gray-600">{{ __('Cadastre sua imobiliária!') }}</p>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="grid grid-cols-2 gap-4">
                                            <!-- Name -->
                                            <div>
                                                <x-label for="name" :value="__('Nome da imobiliária')" />

                                                <x-input id="name" class="block w-full mt-1" type="text" name="name"
                                                    :value="old('name')" required autofocus />
                                            </div>

                                            <!-- Email Address -->
                                            <div>
                                                <x-label for="email" :value="__('Email')" />

                                                <x-input id="email" class="block w-full mt-1" type="email" name="email"
                                                    :value="old('email')" required />
                                            </div>

                                            <!-- Phone Number -->
                                            <div>
                                                <x-label for="phone" :value="__('Telefone')" />

                                                <x-input id="phone" class="block w-full mt-1 phone-mask" type="text" name="phone"
                                                    :value="old('phone')" required autofocus />
                                            </div>

                                            <!-- Responsible -->
                                            <div>
                                                <x-label for="responsible" :value="__('Responsável')" />

                                                <x-input id="responsible" class="block w-full mt-1" type="text"
                                                    name="responsible" :value="old('responsible')" required autofocus />
                                            </div>

                                            <!-- CPF -->
                                            <div>
                                                <x-label for="cnpj" :value="__('CNPJ')" />

                                                <x-input id="cnpj" class="block w-full mt-1" type="text" name="cnpj"
                                                    data-mask="00.000.000/0000-00" :value="old('cnpj')" required
                                                    autofocus />
                                            </div>

                                            <!-- CRECI -->
                                            <div>
                                                <x-label for="creci" :value="__('CRECI')" />

                                                <x-input id="creci" class="block w-full mt-1" type="text" name="creci"
                                                    maxlength="11" :value="old('creci')" required autofocus />
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-4">
                                            <div class="flex flex-col items-end justify-end py-4 mt-4">
                                                <label for="accept_terms" class="inline-flex items-center">
                                                    <input id="accept_terms" type="checkbox"
                                                        class="text-red-700 border-gray-300 rounded shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50"
                                                        name="accept_terms">
                                                    <span
                                                        class="ml-2 text-md">{{ __('Eu li e aceito os termos ') }}<a href="#" id="open-broker-terms" class="font-medium text-red-600 underline">visualizar</a>{{ __(' de uso.') }}</span>
                                                </label>
                                                @error('accept_terms')
                                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-end mt-8">
                                            <a class="text-gray-600 underline text-md hover:text-gray-900"
                                                href="{{ route('login') }}">
                                                {{ __('Já possui cadastro?') }}
                                            </a>

                                            <x-button
                                                class="flex items-center justify-center px-4 py-2 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-700 border border-transparent rounded-md hover:bg-red-800 focus:outline-none disabled:opacity-25">
                                                {{ __('Registrar') }}
                                            </x-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="modal-lgpd" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-black bg-opacity-80" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full sm:p-6">
                <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                    <button type="button" id="close-lgpd-removal"
                        class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-0">
                        <span class="sr-only">{{ __('Fechar') }}</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="sm:flex sm:items-start">
                    <div
                        class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: outline/exclamation -->
                        <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="pt-2 mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h2 class="flex items-center text-2xl font-medium leading-6 text-gray-900" id="modal-title">
                            {{ __('LGPD') }}
                        </h2>
                        <div class="mt-4 mb-4">
                            <div class="space-y-2 text-sm text-gray-600">
                                <p>A Lei Geral de Proteção de Dados Pessoais, Lei nº 13.709/2018, é a legislação
                                    brasileira que regula as atividades de tratamento de dados pessoais e que também
                                    altera os artigos 7º e 16 do Marco Civil da Internet.</p>

                                <p>A legislação se fundamenta em diversos valores, como o respeito à privacidade; à
                                    autodeterminação informativa; à liberdade de expressão, de informação, comunicação e
                                    de opinião; à inviolabilidade da intimidade, da honra e da imagem; ao
                                    desenvolvimento econômico e tecnológico e a inovação; à livre iniciativa, livre
                                    concorrência e defesa do consumidor e aos direitos humanos de liberdade e dignidade
                                    das pessoas.</p>

                                <p>A LGPD cria um conjunto de novos conceitos jurídicos (e.g. "dados pessoais", "dados
                                    pessoais sensíveis"), estabelece as condições nas quais os dados pessoais podem ser
                                    tratados, define um conjunto de direitos para os titulares dos dados, gera
                                    obrigações específicas para os controladores dos dados e cria uma série de
                                    procedimentos e normas para que haja maior cuidado com o tratamento de dados
                                    pessoais e compartilhamento com terceiros.[7] A lei se aplica a toda informação
                                    relacionada a pessoa natural identificada ou que possa ser identificável e aos dados
                                    que tratem de origem racial ou étnica, convicção religiosa, opinião política,
                                    filiação a sindicato ou a organização de caráter religioso, filosófico ou político,
                                    dado referente à saúde ou à vida sexual, dado genético ou biométrico, sempre que os
                                    mesmos estiverem vinculados a uma pessoa natural.</p>

                                <p>
                                    Link para mais detalhes: <a class="text-red-700 hover:underline hover:text-red-500"
                                        href="http://www.planalto.gov.br/ccivil_03/_ato2015-2018/2018/lei/l13709.htm"
                                        target="_blank"><b>Lei Nº 13.709</b></a>
                                </p>

                            </div>
                        </div>
                        <hr />
                        <div class="mt-4">
                            <h2 class="flex items-center text-xl font-medium leading-6 text-gray-900" id="modal-title">
                                {{ __('Solicite a exclusão dos seus dados em nossos sistemas:') }}
                            </h2>
                        </div>
                        <div class="my-4">
                            <div class="grid grid-cols-8 gap-6 gap-y-2">
                                <div class="col-span-8 sm:col-span-2">
                                    <div class="sm:col-span-3">
                                        <label for="country" class="block text-sm font-medium text-left text-gray-700">
                                            {{ __('Você é') }}
                                        </label>
                                        <div class="mt-1">
                                            <select id="country" name="country" autocomplete="country-name"
                                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                                <option>{{ __('Imobiliária') }}</option>
                                                <option>{{ __('Corretor') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-8 sm:col-span-2">
                                    <label for="first-name"
                                        class="block text-sm font-medium text-left text-gray-700">{{ __('Nome') }}</label>
                                    <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                </div>
                                <div class="col-span-8 sm:col-span-2">
                                    <label for="last-name"
                                        class="block text-sm font-medium text-left text-gray-700">{{ __('Email') }}</label>
                                    <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                </div>
                                <div class="col-span-8 sm:col-span-2">
                                    <label for="first-name"
                                        class="block text-sm font-medium text-left text-gray-700">{{ __('Telefone') }}</label>
                                    <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                </div>
                                <div class="col-span-8 sm:col-span-8">
                                    <label for="message"
                                        class="block text-sm font-medium text-left text-gray-700">{{ __('Mensagem') }}</label>
                                    <textarea name="message" id="message" rows="3"
                                        placeholder="Escreva aqui o motivo de sua solicitação"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirm-lgpd-removal"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                        {{ __('Solicitar exclusão') }}
                    </button>
                    <button type="button" id="cancel-lgpd-removal"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                        {{ __('Fechar') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-broker-terms" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-black bg-opacity-80" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full sm:p-6">
                <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                    <button type="button" id="close-broker-terms"
                        class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-0">
                        <span class="sr-only">{{ __('Fechar') }}</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="sm:flex sm:items-start">
                    <div
                        class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: outline/exclamation -->
                        <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="pt-2 mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h2 class="flex items-center text-2xl font-medium leading-6 text-gray-900" id="modal-title">
                            {{ __('Termos de uso - Registro de Imobiliária') }}
                        </h2>
                        <div class="mt-8 mb-4">
                            <div class="pr-16 space-y-2 text-justify text-gray-600">
                                {!! $gdpr?->content ?? 'Termos ainda não disponíveis.' !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="button" id="cancel-broker-terms"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                        {{ __('Fechar') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('#cancel-lgpd-removal').on('click', function(e) {
            $('#modal-lgpd').fadeOut();
            e.preventDefault();
        });
        $('#close-lgpd-removal').on('click', function(e) {
            $('#modal-lgpd').fadeOut();
            e.preventDefault();
        });
        $('#open-lgpd-link').on('click', function(e) {
            $('#modal-lgpd').fadeIn();
            e.preventDefault();
        });

        $('#cancel-broker-terms').on('click', function(e) {
            $('#modal-broker-terms').fadeOut();
            e.preventDefault();
        });
        $('#close-broker-terms').on('click', function(e) {
            $('#modal-broker-terms').fadeOut();
            e.preventDefault();
        });
        $('#open-broker-terms').on('click', function(e) {
            $('#modal-broker-terms').fadeIn();
            e.preventDefault();
        });
    </script>
    @include('sweetalert::alert')
</body>

</html>
