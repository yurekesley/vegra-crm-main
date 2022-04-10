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

        <main class="-mt-32">
            <div class="px-4 pb-12 mx-auto sm:px-6 lg:px-8">
                <div class="grid items-center grid-cols-12 gap-4">
                    <div class="grid grid-cols-1 col-span-12 gap-4 mt-4 md:col-span-10 md:col-start-2">
                        <section aria-labelledby="section-header-navigation mb-4">
                            <nav aria-label="Progress">
                                <ol role="list"
                                    class="bg-white border border-gray-300 divide-y divide-gray-300 rounded-md md:flex md:divide-y-0">
                                    <li class="relative md:flex-1 md:flex">
                                        <!-- Completed Step -->
                                        <p href="#" class="flex items-center w-full group">
                                            <span class="flex items-center px-6 py-4 text-sm font-medium">
                                                <span
                                                    class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-red-600 border-2 border-red-600 rounded-full">
                                                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span class="ml-4 text-sm font-bold text-red-700">Código de
                                                    participação</span>
                                            </span>
                                        </p>

                                        <!-- Arrow separator for lg screens and up -->
                                        <div class="absolute top-0 right-0 hidden w-5 h-full md:block"
                                            aria-hidden="true">
                                            <svg class="w-full h-full text-gray-300" viewBox="0 0 22 80" fill="none"
                                                preserveAspectRatio="none">
                                                <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke"
                                                    stroke="currentcolor" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </li>

                                    <li class="relative hidden md:flex-1 md:flex md:visible">
                                        <!-- Current Step -->
                                        <p href="#" class="flex items-center px-6 py-4 text-sm font-medium"
                                            aria-current="step">
                                            <span
                                                class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-red-600 border-2 border-red-600 rounded-full">
                                                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                            <span
                                                class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">Confirmação
                                                do código</span>
                                        </p>

                                        <!-- Arrow separator for lg screens and up -->
                                        <div class="absolute top-0 right-0 hidden w-5 h-full md:block"
                                            aria-hidden="true">
                                            <svg class="w-full h-full text-gray-300" viewBox="0 0 22 80" fill="none"
                                                preserveAspectRatio="none">
                                                <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke"
                                                    stroke="currentcolor" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </li>

                                    <li class="relative hidden md:flex-1 md:flex md:visible">
                                        <!-- Current Step -->
                                        <p href="#" class="flex items-center px-6 py-4 text-sm font-medium"
                                            aria-current="step">
                                            <span
                                                class="flex items-center justify-center flex-shrink-0 w-10 h-10 border-2 border-gray-300 rounded-full group-hover:border-gray-400">
                                                <span class="text-gray-500 group-hover:text-gray-900">03</span>
                                            </span>
                                            <span
                                                class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">Seleção
                                                de unidade</span>
                                        </p>

                                        <!-- Arrow separator for lg screens and up -->
                                        <div class="absolute top-0 right-0 hidden w-5 h-full md:block"
                                            aria-hidden="true">
                                            <svg class="w-full h-full text-gray-300" viewBox="0 0 22 80" fill="none"
                                                preserveAspectRatio="none">
                                                <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke"
                                                    stroke="currentcolor" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </li>

                                    <li class="relative hidden md:flex-1 md:flex md:visible">
                                        <!-- Upcoming Step -->
                                        <p href="#" class="flex items-center group">
                                            <span class="flex items-center px-6 py-4 text-sm font-medium">
                                                <span
                                                    class="flex items-center justify-center flex-shrink-0 w-10 h-10 border-2 border-gray-300 rounded-full group-hover:border-gray-400">
                                                    <span class="text-gray-500 group-hover:text-gray-900">04</span>
                                                </span>
                                                <span
                                                    class="ml-4 text-sm font-medium text-gray-500 group-hover:text-gray-900">Enviar
                                                    proposta</span>
                                            </span>
                                        </p>
                                    </li>
                                </ol>
                            </nav>
                        </section>
                        <section aria-labelledby="section-1-title">
                            <h2 class="sr-only" id="section-1-title">Section title</h2>
                            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                                <div class="p-6">
                                    <div class="flex justify-center px-4 mx-auto mb-8 sm:px-6 lg:px-8">
                                        <img src="{{ $product->logo_url }}" alt="Logo {{ $product->name }}">
                                    </div>
                                    <h1 class="mt-4 text-lg font-bold text-center text-gray-700 uppercase">
                                        {{ __('Unidades disponíveis') }}
                                    </h1>
                                </div>
                                <form method="POST" class="w-full" id="form_book_unit">
                                    @csrf
                                    <div class="p-6">
                                        @foreach ($unit_groups as $unit_group)
                                            @if (!$unit_group->units->isEmpty())
                                                <h2
                                                    class="col-span-6 mb-2 text-lg font-semibold leading-tight text-center text-gray-500">
                                                    {{ $unit_group->getTranslatedType() . ' ' . $unit_group->number }}
                                                </h2>
                                                <hr class="col-span-6 mt-2" />
                                                <ul role="list"
                                                    class="grid grid-cols-1 gap-4 mt-2 sm:gap-2 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-6 print:grid-cols-3">
                                                    @if ($unit_group->units->where('status', 'free')->sortBy([['floor', 'asc'], ['number', 'asc']])->isEmpty())
                                                        <h1 class="col-span-6 px-6 py-8 font-medium text-center text-gray-900 text-md whitespace-nowrap">
                                                            {{ __('Nenhuma unidade disponível no ') . $unit_group->getTranslatedType() . ' ' . $unit_group->number }}
                                                        </h1>
                                                    @endif
                                                    @foreach ($unit_group->units->where('status', 'free')->sortBy([['floor', 'asc'], ['number', 'asc']]) as $unit)
                                                        <li class="flex col-span-1 rounded-md shadow-sm cursor-pointer unit"
                                                            data-unit-id="{{ $unit->id }}"
                                                            data-unit-number="{{ $unit->number }}"
                                                            data-unit-group-type="{{ $unit_group->getTranslatedType() }}"
                                                            data-unit-group-number="{{ $unit_group->number }}">
                                                            <div
                                                                class="text-center flex-shrink-0 flex items-center justify-center w-16 bg-{{ $unit->getStatusColor() }}-600 text-white text-sm print:text-xs font-medium rounded-l-md">
                                                                {{ $unit->number }}<br />({{ $unit->getStatusChar() }})
                                                            </div>
                                                            <div
                                                                class="flex items-center justify-between flex-1 truncate bg-white border-t border-b border-r border-gray-200 rounded-r-md">
                                                                <div
                                                                    class="flex-1 px-4 py-2 text-sm truncate print:text-xs">
                                                                    <p
                                                                        class="font-medium text-gray-900 hover:text-gray-600">
                                                                        {{ $unit->size }} m²</p>
                                                                    <p class="text-gray-500">R$
                                                                        {{ number_format($unit->price, 2, ',', '.') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
                                        <div class="mt-4 text-sm text-center" id="legal_text">{!! $product->gdprs->where('type', 'legal_text')->first()?->content !!}</div>
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

        $(() => {
            var shownDeletePopup = false;
            $(document).on('click', '.unit', function(e) {
                if (shownDeletePopup == false) {
                    e.preventDefault();
                    shownDeletePopup = true;
                    var form = $('#form_book_unit');
                    var unit_id = $(this).data('unit-id');
                    var unit_number = $(this).data('unit-number');
                    var unit_group_type = $(this).data('unit-group-type');
                    var unit_group_number = $(this).data('unit-group-number');
                    return Swal.fire({
                        title: `Reservar a unidade ${unit_number} do ${unit_group_type} ${unit_group_number}?`,
                        text: 'Ao confirmar, seu cadastro precisa ser finalizado em até 10 minutos. Após este tempo, a unidade é liberada automaticamente para novas reservas.',
                        icon: 'question',
                        confirmButtonClass: 'btn-danger',
                        confirmButtonText: 'Sim',
                        showCancelButton: true,
                        cancelButtonText: 'Não'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(form).attr('action',
                                `/public/proposals/{{ $product->id }}/{{ $code->id }}/book/${unit_id}`
                            );
                            form.trigger('submit');
                            shownDeletePopup = false;
                        } else {
                            shownDeletePopup = false;
                        }
                    });
                }
            });
        });
    </script>
    @include('sweetalert::alert')
</body>

</html>
