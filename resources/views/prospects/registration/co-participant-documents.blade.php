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
        <div class="pb-48 bg-red-900">
            <nav class="bg-red-900 border-b border-red-300 border-opacity-25 lg:border-none">
                <div class="px-2 mx-auto sm:px-4 lg:px-8">
                    <div
                        class="relative flex items-center w-full h-16 lg:border-b lg:border-red-400 lg:border-opacity-25">
                        <div class="flex items-center justify-end w-full px-2 lg:px-0">
                            <div class="hidden lg:block lg:ml-10">
                                <div class="flex space-x-4">
                                    <a href="{{ route('welcome') }}"
                                        class="px-3 py-2 font-medium text-white rounded-md text-md hover:bg-red-500 hover:bg-opacity-75">
                                        {{ __('Voltar') }}
                                    </a>
                                    <a href="#" id="open-lgpd-link"
                                        class="flex items-center px-3 py-2 text-sm font-medium text-white rounded-md hover:bg-red-500 hover:bg-opacity-75">
                                        {{ __('LGPD') }}
                                    </a>
                                    <p
                                        class="px-2 py-2 font-medium text-white rounded-md md:px-4 lg:px-16 text-md hover:bg-red-500 hover:bg-opacity-75">
                                        {{ $product->name }}
                                    </p>

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
            {{-- <header class="py-1">
                <div class="flex justify-center px-4 mx-auto sm:px-6 lg:px-8 my-[-20px]">
                    <img src="https://yata-apix-ee4bc549-f13e-4202-9855-4f92b3d3d704.lss.locawebcorp.com.br/dcbda08f55254bdc850c17721bf800d9.png"
                        alt="Logo Vegra">
                </div>
            </header> --}}
        </div>

        <main class="-mt-40">
            <div class="px-4 pb-12 mx-auto sm:px-6 lg:px-8">
                <div class="grid items-center grid-cols-12 gap-4">
                    <div class="grid grid-cols-1 col-span-12 gap-4 mt-4 md:col-span-10 md:col-start-2">
                        <section aria-labelledby="section-header-navigation mb-4">
                            <x-registration-step :step="5" :has_coparticipant="$prospect->has_coparticipant" />
                        </section>
                        <section aria-labelledby="section-1-title">
                            <h2 class="sr-only" id="section-1-title">Section title</h2>
                            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                                <div class="p-6">
                                    <div class="flex justify-center px-4 mx-auto mb-8 sm:px-6 lg:px-8">
                                        <img src="{{ $product->logo_url }}" alt="Logo {{ $product->name }}">
                                    </div>
                                    <hr class="pb-4" />
                                    <h1 class="mt-4 text-xl font-bold text-justify text-gray-700 uppercase">
                                        {{ __('Intenção de compra') }}
                                    </h1>
                                    <p class="text-lg text-justify text-gray-500">
                                        Esta página é destinada ao envio da documentação necessária para análise de
                                        crédito do cliente na compra de uma unidade no empreendimento <strong>{{ $product->name }}</strong>.
                                        O
                                        envio dos dados não caracterizam a reserva de uma unidade e todas as
                                        informações
                                        disponibilizadas aqui serão utilizadas somente para cadastro de compra deste
                                        empreendimento. Caso a compra não seja efetivada, todos os documentos serão
                                        excluídos da base de dados da empresa. Qualquer dúvida, consulte nossa
                                        equipe
                                        comercial.
                                    </p>
                                </div>
                                <hr class="col-span-6 mx-4 my-4" />
                                <div class="flex flex-col items-center py-5 bg-white">
                                    <form method="POST" enctype="multipart/form-data"
                                        action="{{ route('prospects.registration.co-participant.documents.store', ['product' => $product->id,'prospect' => $prospect->id,'timestamp' => time()]) }}"
                                        class="flex flex-col w-full">
                                        @csrf
                                        <div
                                            class="flex flex-col items-center w-full px-4 py-8 text-center bg-gray-50 sm:px-6">
                                            <h2
                                                class="col-span-6 mb-4 text-xl font-semibold leading-tight text-gray-600">
                                                {{ __('Upload de documentos') }}
                                            </h2>
                                            <h2
                                                class="col-span-6 mb-4 font-semibold leading-tight text-justify text-gray-400 text-md">
                                                {{ __('Aceitamos arquivos nos formatos PDF, JPG e PNG com até 5mb. Cada campo aceita 1 arquivo.') }}
                                                <br />
                                                {{ __('Caso seu documento tenha mais de uma página, como comprovante de renda e documentos frente-verso,') }}
                                                <br />
                                                {{ __(' tente incluir tudo em um arquivo PDF único.') }}
                                            </h2>
                                            <div class="grid w-full grid-cols-12 gap-4 mt-4 md:max-w-7xl lg:max-w-6xl">
                                                <div class="col-span-12 md:col-span-2">
                                                    <div class="flex items-center justify-center w-full">
                                                        <label
                                                            class="flex flex-col w-full h-32 cursor-pointer hover:bg-gray-100 hover:border-gray-300">
                                                            <div
                                                                class="relative flex flex-col items-center justify-center pt-7">
                                                                <img id="preview"
                                                                    class="absolute inset-0 object-contain w-full h-32">
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                                    width="32" height="32" fill="gray" y="0px"
                                                                    viewBox="0 0 1000 1000"
                                                                    enable-background="new 0 0 1000 1000"
                                                                    xml:space="preserve">
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
                                                                <p
                                                                    class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                                    CPF ou CNH</p>
                                                                <p id="label_cpf_cnh"
                                                                    class="pt-1 text-sm tracking-wider text-red-400 group-hover:text-red-600">
                                                                    {{ basename($prospect->prospect_copart_documents->where('type', 'cpf_cnh')->first()?->url ?? '') }}
                                                                </p>
                                                            </div>
                                                            <input id="cpf_cnh" name="cpf_cnh" type="file"
                                                                class="opacity-0" />
                                                        </label>
                                                    </div>
                                                    @error('cpf_cnh')
                                                        <small class="text-red-700 font-sm">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-span-12 md:col-span-2">
                                                    <div class="flex items-center justify-center w-full">
                                                        <label
                                                            class="flex flex-col w-full h-32 cursor-pointer hover:bg-gray-100 hover:border-gray-300">
                                                            <div
                                                                class="relative flex flex-col items-center justify-center pt-7">
                                                                <img id="preview"
                                                                    class="absolute inset-0 object-contain w-full h-32">
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                                    width="32" height="32" fill="gray" y="0px"
                                                                    viewBox="0 0 1000 1000"
                                                                    enable-background="new 0 0 1000 1000"
                                                                    xml:space="preserve">
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
                                                                <p
                                                                    class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                                    RG</p>
                                                                <p id="label_rg"
                                                                    class="pt-1 text-sm tracking-wider text-red-400 group-hover:text-red-600">
                                                                    {{ basename($prospect->prospect_copart_documents->where('type', 'rg')->first()?->url ?? '') }}
                                                                </p>
                                                            </div>
                                                            <input id="rg" name="rg" type="file"
                                                                class="opacity-0" />
                                                        </label>
                                                    </div>
                                                    @error('rg')
                                                        <small class="text-red-700 font-sm">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-span-12 md:col-span-5">
                                                    <div class="flex items-center justify-center w-full">
                                                        <label
                                                            class="flex flex-col w-full h-32 cursor-pointer hover:bg-gray-100 hover:border-gray-300">
                                                            <div
                                                                class="relative flex flex-col items-center justify-center pt-7">
                                                                <img id="preview"
                                                                    class="absolute inset-0 object-contain w-full h-32">
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                                    width="32" height="32" fill="gray" y="0px"
                                                                    viewBox="0 0 1000 1000"
                                                                    enable-background="new 0 0 1000 1000"
                                                                    xml:space="preserve">
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
                                                                <p
                                                                    class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                                    Comprovante de residência em nome do coparticipante
                                                                    (últimos 3 meses)</p>
                                                                <p id="label_comp_res"
                                                                    class="pt-1 text-sm tracking-wider text-red-400 group-hover:text-red-600">
                                                                    {{ basename($prospect->prospect_copart_documents->where('type', 'comp_res')->first()?->url ?? '') }}
                                                                </p>
                                                            </div>
                                                            <input id="comp_res" name="comp_res" type="file"
                                                                class="opacity-0" />
                                                        </label>
                                                    </div>
                                                    @error('comp_res')
                                                        <small class="text-red-700 font-sm">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-span-6 md:col-span-3">
                                                    <div class="flex items-center justify-center w-full">
                                                        <label
                                                            class="flex flex-col w-full h-32 cursor-pointer hover:bg-gray-100 hover:border-gray-300">
                                                            <div
                                                                class="relative flex flex-col items-center justify-center pt-7">
                                                                <img id="preview"
                                                                    class="absolute inset-0 object-contain w-full h-32">
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                                    width="32" height="32" fill="gray" y="0px"
                                                                    viewBox="0 0 1000 1000"
                                                                    enable-background="new 0 0 1000 1000"
                                                                    xml:space="preserve">
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
                                                                <p
                                                                    class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                                    Comprovante de estado civil</p>
                                                                <p id="label_comp_est_civil"
                                                                    class="pt-1 text-sm tracking-wider text-red-400 group-hover:text-red-600">
                                                                    {{ basename($prospect->prospect_copart_documents->where('type', 'com_est_civil')->first()?->url ?? '') }}
                                                                </p>
                                                            </div>
                                                            <input id="comp_est_civil" name="comp_est_civil" type="file"
                                                                class="opacity-0" />
                                                        </label>
                                                    </div>
                                                    @error('comp_est_civil')
                                                        <small class="text-red-700 font-sm">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-span-6 md:col-span-3">
                                                    <div class="flex items-center justify-center w-full">
                                                        <label
                                                            class="flex flex-col w-full h-32 cursor-pointer hover:bg-gray-100 hover:border-gray-300">
                                                            <div
                                                                class="relative flex flex-col items-center justify-center pt-7">
                                                                <img id="preview"
                                                                    class="absolute inset-0 object-contain w-full h-32">
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                                    width="32" height="32" fill="gray" y="0px"
                                                                    viewBox="0 0 1000 1000"
                                                                    enable-background="new 0 0 1000 1000"
                                                                    xml:space="preserve">
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
                                                                <p
                                                                    class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                                    Adverbações de estado civil</p>
                                                                <p id="label_advb_est_civil"
                                                                    class="pt-1 text-sm tracking-wider text-red-400 group-hover:text-red-600">
                                                                    {{ basename($prospect->prospect_copart_documents->where('type', 'advb_est_civil')->first()?->url ?? '') }}
                                                                </p>
                                                            </div>
                                                            <input id="advb_est_civil" name="advb_est_civil" type="file"
                                                                class="opacity-0" />
                                                        </label>
                                                    </div>
                                                    @error('advb_est_civil')
                                                        <small class="text-red-700 font-sm">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-span-6 md:col-span-3">
                                                    <div class="flex items-center justify-center w-full">
                                                        <label
                                                            class="flex flex-col w-full h-32 cursor-pointer hover:bg-gray-100 hover:border-gray-300">
                                                            <div
                                                                class="relative flex flex-col items-center justify-center pt-7">
                                                                <img id="preview"
                                                                    class="absolute inset-0 object-contain w-full h-32">
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                                    width="32" height="32" fill="gray" y="0px"
                                                                    viewBox="0 0 1000 1000"
                                                                    enable-background="new 0 0 1000 1000"
                                                                    xml:space="preserve">
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
                                                                <p
                                                                    class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                                    Comprovante de renda</p>
                                                                <p id="label_com_renda"
                                                                    class="pt-1 text-sm tracking-wider text-red-400 group-hover:text-red-600">
                                                                    {{ basename($prospect->prospect_copart_documents->where('type', 'com_renda')->first()?->url ?? '') }}
                                                                </p>
                                                            </div>
                                                            <input id="com_renda" name="com_renda" type="file"
                                                                class="opacity-0" />
                                                        </label>
                                                    </div>
                                                    @error('com_renda')
                                                        <small class="text-red-700 font-sm">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-span-6 md:col-span-6">
                                                    <div class="flex items-center justify-center w-full">
                                                        <label
                                                            class="flex flex-col w-full h-32 cursor-pointer hover:bg-gray-100 hover:border-gray-300">
                                                            <div
                                                                class="relative flex flex-col items-center justify-center pt-7">
                                                                <img id="preview"
                                                                    class="absolute inset-0 object-contain w-full h-32">
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                                    width="32" height="32" fill="gray" y="0px"
                                                                    viewBox="0 0 1000 1000"
                                                                    enable-background="new 0 0 1000 1000"
                                                                    xml:space="preserve">
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
                                                                <p
                                                                    class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                                    Complemento de renda, Carteira de trabalho,
                                                                    Simulação Caixa e Simulado de proposta</p>
                                                                <p id="label_other"
                                                                    class="pt-1 text-sm tracking-wider text-red-400 group-hover:text-red-600">
                                                                    {{ basename($prospect->prospect_copart_documents->where('type', 'other')->first()?->url ?? '') }}
                                                                </p>
                                                            </div>
                                                            <input id="other" name="other" type="file"
                                                                class="opacity-0" />
                                                        </label>
                                                    </div>
                                                    @error('other')
                                                        <small class="text-red-700 font-sm">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full px-4 py-8 text-center bg-gray-50 sm:px-6">
                                            <a href="{{ route('prospects.registration.customer-data', ['product' => $product->id, 'prospect' => $prospect->id]) }}"
                                                class="inline-flex justify-center px-6 py-4 font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm text-medium hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                {{ __('Voltar') }}</a>
                                            <button type="submit"
                                                class="inline-flex justify-center px-6 py-4 font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm text-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                {{ __('Prosseguir') }}
                                            </button>
                                        </div>
                                    </form>
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


        $('#cpf_cnh').on('change', function(event) {
            if (event.target.files.length > 0) {
                var name = event.target.files[0].name;
                var nameElement = document.getElementById('label_cpf_cnh');
                nameElement.innerHTML = name;
            }
        });

        $('#rg').on('change', function(event) {
            if (event.target.files.length > 0) {
                var name = event.target.files[0].name;
                var nameElement = document.getElementById('label_rg');
                nameElement.innerHTML = name;
            }
        });

        $('#comp_res').on('change', function(event) {
            if (event.target.files.length > 0) {
                var name = event.target.files[0].name;
                var nameElement = document.getElementById('label_comp_res');
                nameElement.innerHTML = name;
            }
        });

        $('#comp_est_civil').on('change', function(event) {
            if (event.target.files.length > 0) {
                var name = event.target.files[0].name;
                var nameElement = document.getElementById('label_comp_est_civil');
                nameElement.innerHTML = name;
            }
        });

        $('#advb_est_civil').on('change', function(event) {
            if (event.target.files.length > 0) {
                var name = event.target.files[0].name;
                var nameElement = document.getElementById('label_advb_est_civil');
                nameElement.innerHTML = name;
            }
        });

        $('#com_renda').on('change', function(event) {
            if (event.target.files.length > 0) {
                var name = event.target.files[0].name;
                var nameElement = document.getElementById('label_com_renda');
                nameElement.innerHTML = name;
            }
        });

        $('#other').on('change', function(event) {
            if (event.target.files.length > 0) {
                var name = event.target.files[0].name;
                var nameElement = document.getElementById('label_other');
                nameElement.innerHTML = name;
            }
        });
    </script>
    @include('sweetalert::alert')
</body>

</html>
