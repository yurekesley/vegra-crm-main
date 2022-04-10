<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    @yield('styles')
</head>

<body class="h-full font-sans antialiased print:invisible">
    <div x-data="{ open: false }" @keydown.window.escape="open = false">
        <div x-show="open" class="fixed inset-0 z-40 lg:hidden" role="dialog" aria-modal="true">
            <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-description="Off-canvas menu overlay, show/hide based on off-canvas menu state."
                class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="open = false" aria-hidden="true">
            </div>
            <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                x-description="Off-canvas menu, show/hide based on off-canvas menu state."
                class="relative flex flex-col flex-1 w-full h-full max-w-xs bg-red-900">

                <div x-show="open" x-transition:enter="ease-in-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    x-description="Close button, show/hide based on off-canvas menu state."
                    class="absolute top-0 right-0 pt-2 -mr-12">
                    <button type="button" @click="open = false"
                        class="flex items-center justify-center w-10 h-10 ml-1 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center justify-center flex-shrink-0 px-4">
                        <img class="w-auto h-8 my-2" src="{{ asset('images/logo-vegra-white.png') }}"
                            alt="Logo Vegra">
                    </div>
                    @include('layouts.navigation')
                </div>
                <div class="flex flex-shrink-0 p-4 bg-red-700">
                    <a href="#" class="flex-shrink-0 block group">
                        <div class="flex items-center">
                            <div>
                                <img class="inline-block w-10 h-10 rounded-full"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="">
                            </div>
                            <div class="ml-3">
                                <p class="text-base font-medium text-white">Tom Cook</p>
                                <p class="text-sm font-medium text-red-400 group-hover:text-red-300">View profile</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="flex-shrink-0 w-14">
            </div>
        </div>
        <div class="hidden shadow-md lg:flex lg:w-64 lg:flex-col lg:fixed lg:inset-y-0 print:hidden">
            <div class="flex flex-col flex-1 min-h-0 bg-red-900">
                <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center justify-center flex-shrink-0 px-4">
                        <img class="w-auto h-8 my-4" src="{{ asset('images/logo-vegra-white.png') }}"
                            alt="Logo Vegra">
                    </div>
                    @include('layouts.navigation')
                </div>
                <div class="flex flex-shrink-0 p-4 bg-red-700">
                    <x-user-profile-link />
                </div>
            </div>
        </div>
        <div class="flex flex-col flex-1 print:lg:pl-0 lg:pl-64">
            <div class="sticky top-0 z-10 items-center px-1 py-1 bg-red-800 lg:hidden sm:px-3 sm:py-3 print:hidden">
                <button type="button" @click="open = true"
                    class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-white hover:text-red-200 focus:outline-none">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <main class="flex-1">
                <div class="py-6">
                    <div class="px-4 mx-auto sm:px-6 lg:px-8 print:visible">
                        <h1 class="text-2xl font-semibold text-red-900 print:text-center">{{ $header }}</h1>
                    </div>
                    <div class="px-4 mx-auto sm:px-6 md:px-8">
                        <div class="py-4">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @include('sweetalert::alert')
    <x-tinymce-config/>
    @yield('scripts')
</body>

</html>
