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
        <div class="pb-32 bg-red-700">
            <nav class="bg-red-700 border-b border-red-300 border-opacity-25 lg:border-none">
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
            <header class="py-8">
                <div class="flex justify-center px-4 mx-auto sm:px-6 lg:px-8 my-[-20px]">
                    <img src="https://yata-apix-ee4bc549-f13e-4202-9855-4f92b3d3d704.lss.locawebcorp.com.br/dcbda08f55254bdc850c17721bf800d9.png"
                        alt="Logo Vegra">
                </div>
            </header>
        </div>

        <main class="-mt-32">
            <div class="px-4 pb-12 mx-auto sm:px-6 lg:px-8">
                <div class="grid items-center grid-cols-12 gap-4">
                    <div class="grid grid-cols-1 col-span-12 gap-4 mt-4 md:col-span-10 md:col-start-2">
                        <section aria-labelledby="section-1-title">
                            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                                <form method="GET"
                                    action="{{ route('prospects.data.documents', ['timestamp' => time()]) }}"
                                    class="w-full">
                                    @csrf
                                    <div class="p-6">
                                        <div class="grid grid-cols-3">
                                            <div class="col-span-3 md:col-span-1 md:col-start-2">
                                                <h1 class="col-span-3 my-4 text-xl font-bold text-center text-gray-700">
                                                    {{ __('Envio de documentação') }}
                                                </h1>
                                            </div>
                                            <hr class="col-span-3" />
                                            <div class="col-span-3 mt-6 md:col-span-1 md:col-start-2">
                                                <h2 class="my-4 font-bold text-center text-gray-700 text-md">
                                                    {{ __('Informe o código fornecido pelo corretor ou responsável') }}
                                                </h2>
                                                <x-input id="code"
                                                    class="block w-full mt-1 disabled:bg-gray-200 disabled:text-gray-500"
                                                    type="text" name="code" :value="old('code')" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-8 text-center bg-gray-50 sm:px-6">
                                        {{-- <a href="{{ route('products.index') }}"
                                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        {{ __('Voltar') }}</a> --}}
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
        $('#havent_broker').on('change', function() {
            if (this.checked) {
                $('#broker_email').prop('disabled', true);
                $('#broker_email').val('');
            } else {
                $('#broker_email').prop('disabled', false);
            }
        })
        $(() => {
            if (document.getElementById('havent_broker').checked) {
                $('#broker_email').prop('disabled', true);
                $('#broker_email').val('');
            } else {
                $('#broker_email').prop('disabled', false);
            }
        })
    </script>
    @include('sweetalert::alert')
</body>

</html>
