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
                            <x-registration-step :step="7" :has_coparticipant="$prospect->has_coparticipant" />
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
                                    <form method="POST"
                                        action="{{ route('prospects.registration.finish', ['product' => $product->id,'prospect' => $prospect->id,'timestamp' => time()]) }}"
                                        class="flex flex-col w-full">
                                        @csrf
                                        <div
                                            class="flex flex-col items-center w-full px-4 py-8 text-center bg-white sm:px-6">
                                            <h2
                                                class="col-span-6 mb-2 text-3xl font-semibold leading-tight text-gray-600">
                                                {{ __('Declaração') }}
                                            </h2>
                                            <div class="grid w-full grid-cols-12 gap-4">
                                                <hr class="w-full col-span-12 mt-12 mb-4">
                                                <h2
                                                    class="col-span-12 mt-4 text-lg font-semibold leading-tight text-left text-gray-600">
                                                    {{ __('CONTROLADORA: VEGRA') }}
                                                </h2>
                                                <div class="flex flex-col col-span-12 gap-4">
                                                    <p class="text-justify">Este documento visa registrar a
                                                        manifestação livre, informada e
                                                        inequívoca pela qual o Titular (você) concorda com o tratamento
                                                        de seus dados pessoais para finalidade específica, em
                                                        conformidade com a Lei nº 13.709 – Lei Geral de Proteção de
                                                        Dados Pessoais (LGPD).</p>
                                                    <p class="text-justify">Ao manifestar sua aceitação para com o
                                                        presente termo, o Titular
                                                        consente e concorda que a CONTROLADORA, tome decisões referentes
                                                        ao tratamento de seus dados pessoais, envolvendo operações como
                                                        as que se referem a coleta, produção, recepção, classificação,
                                                        utilização, acesso, reprodução, transmissão, distribuição,
                                                        processamento, arquivamento, armazenamento, eliminação,
                                                        avaliação ou controle da informação, modificação, comunicação,
                                                        transferência, difusão ou extração.</p>
                                                </div>
                                            </div>
                                            <div class="grid w-full grid-cols-12 gap-4">
                                                <hr class="w-full col-span-12 mt-12 mb-4">
                                                <h2
                                                    class="col-span-12 mt-4 text-lg font-semibold leading-tight text-left text-gray-600">
                                                    {{ __('Finalidades do Tratamento dos Dados') }}
                                                </h2>
                                                <div class="flex flex-col col-span-12 gap-4">
                                                    <p class="text-justify">A CONTROLADORA poderá utilizar os dados
                                                        recebidos para as seguintes finalidades:</p>
                                                    <p class="text-justify">
                                                        • Possibilitar o envio de comunicações referentes ao
                                                        empreendimento.<br>
                                                        • Possibilitar a elaboração de contratos comerciais, emissão
                                                        cobranças e notas fiscais;<br>
                                                        • Possibilitar o envio propaganda de produtos e serviços,
                                                        personalizados ou não;<br>
                                                        • Possibilitar a utilização dos dados em pesquisas de
                                                        mercado;<br>
                                                        • Possibilitar a utilização dos dados na elaboração de
                                                        relatórios internos;<br>
                                                        • Possibilitar a utilização dos dados em peças de
                                                        comunicação;<br>
                                                        • Possibilitar a utilização dos dados em análises junto aos
                                                        órgãos de proteção ao crédito;<br>
                                                        • Possibilitar a utilização dos dados para facilitar a prestação
                                                        de serviços diversos.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="grid w-full grid-cols-12 gap-4">
                                                <hr class="w-full col-span-12 mt-12 mb-4">
                                                <h2
                                                    class="col-span-12 mt-4 text-lg font-semibold leading-tight text-left text-gray-600">
                                                    {{ __('Segurança dos Dados') }}
                                                </h2>
                                                <div class="flex flex-col col-span-12 gap-4">
                                                    <p class="text-justify">A CONTROLADORA responsabiliza-se pela
                                                        manutenção de medidas de segurança, técnicas e administrativas
                                                        aptas a proteger os dados pessoais de acessos não autorizados e
                                                        de situações acidentais ou ilícitas de destruição, perda,
                                                        alteração, comunicação ou qualquer forma de tratamento
                                                        inadequado ou ilícito.</p>
                                                    <p class="text-justify">Em conformidade ao art. 48 da Lei nº
                                                        13.709, a CONTROLADORA comunicará ao Titular e à Autoridade
                                                        Nacional de Proteção de Dados (ANPD) a ocorrência de incidente
                                                        de segurança que possa acarretar risco ou dano relevante ao
                                                        Titular.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="grid w-full grid-cols-12 gap-4">
                                                <hr class="w-full col-span-12 mt-12 mb-4">
                                                <h2
                                                    class="col-span-12 mt-4 text-lg font-semibold leading-tight text-left text-gray-600">
                                                    {{ __('Término do Tratamento dos Dados') }}
                                                </h2>
                                                <div class="flex flex-col col-span-12 gap-4">
                                                    <p class="text-justify">A CONTROLADORA poderá manter e tratar os
                                                        dados pessoais do Titular durante todo o período em que os
                                                        mesmos forem pertinentes ao alcance das finalidades listadas
                                                        neste termo. Dados pessoais anonimizados, sem possibilidade de
                                                        associação ao indivíduo, poderão ser mantidos por período
                                                        indefinido.</p>
                                                </div>
                                            </div>
                                            <div class="grid w-full grid-cols-12 gap-4">
                                                <hr class="w-full col-span-12 mt-12 mb-4">
                                                <h2
                                                    class="col-span-12 mt-4 text-lg font-semibold leading-tight text-left text-gray-600">
                                                    {{ __('Direitos do Titular') }}
                                                </h2>
                                                <div class="flex flex-col col-span-12 gap-4">
                                                    <p class="text-justify">O Titular tem direito a obter da
                                                        CONTROLADORA, em relação aos dados por ele tratados, a qualquer
                                                        momento e mediante requisição:</p>
                                                    <p class="text-justify">
                                                        • Confirmação da existência de tratamento;<br />
                                                        • Acesso aos dados;<br />
                                                        • Correção de dados incompletos, inexatos ou
                                                        desatualizados;<br />
                                                        • Anonimização, bloqueio ou eliminação de dados desnecessários,
                                                        excessivos ou tratados em desconformidade com o disposto na Lei
                                                        nº 13.709;<br />
                                                        • Portabilidade dos dados a outro fornecedor de serviço ou
                                                        produto, mediante requisição expressa e observados os segredos
                                                        comercial e industrial, de acordo com a regulamentação do órgão
                                                        controlador;<br />
                                                        • Eliminação dos dados pessoais tratados com o consentimento do
                                                        titular, exceto nas hipóteses previstas no art. 16 da Lei nº
                                                        13.709;<br />
                                                        • Informação das entidades públicas e privadas com as quais a
                                                        CONTROLADORA realizou uso compartilhado de dados;<br />
                                                        • Informação sobre a possibilidade de não fornecer consentimento
                                                        e sobre as consequências da negativa;<br />
                                                        • Revogação do consentimento, nos termos do § 5º do art. 8º da
                                                        Lei nº 13.709.<br />
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="grid w-full grid-cols-12 gap-4">
                                                <hr class="w-full col-span-12 mt-12 mb-4">
                                                <h2
                                                    class="col-span-12 mt-4 text-lg font-semibold leading-tight text-left text-gray-600">
                                                    {{ __('Direito de Revogação do Consentimento') }}
                                                </h2>
                                                <div class="flex flex-col col-span-12 gap-4">
                                                    <p class="text-justify">Este consentimento poderá ser revogado
                                                        pelo Titular, a qualquer momento, mediante solicitação via
                                                        e-mail ou correspondência a CONTROLADORA. O Titular fica ciente
                                                        de que poderá ser inviável a CONTROLADORA continuar o
                                                        fornecimento de produtos ou serviços ao Titular a partir da
                                                        eliminação dos dados pessoais.</p>
                                                </div>
                                            </div>
                                            <div class="grid w-full grid-cols-12 gap-4">
                                                <hr class="w-full col-span-12 mt-12 mb-4">
                                                <h2
                                                    class="col-span-12 mt-4 text-lg font-semibold leading-tight text-left text-gray-600">
                                                    {{ __('Autorizações no processo de compra') }}
                                                </h2>
                                                <div class="flex flex-col col-span-12 gap-4">
                                                    <p class="text-justify">Autorizo a consulta da minha situação
                                                        junto ao órgão de proteção ao crédito e o tratamento de meus
                                                        dados pessoais para os fins da atividade de compra e venda do
                                                        imóvel.</p>
                                                    <p class="text-justify">Autorizo a incorporadora a fornecer meu
                                                        nome completo, endereço e número do meu RG e CPF assim como os
                                                        mesmos dados do coparticipante, se houver, para a imobiliária
                                                        que fez a intermediação da venda para confecção do contrato de
                                                        intermediação imobiliária referente ao pagamento da comissão.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="grid w-full grid-cols-12 gap-4">
                                                <hr class="w-full col-span-12 mt-12 mb-4">
                                                <div class="col-span-6">
                                                    <label for="accept_terms"
                                                        class="block mb-2 text-sm font-medium text-left text-gray-700">{{ __('Você aceita os termos descritos acima?') }}</label>
                                                    <select name="accept_terms" id="accept_terms"
                                                        class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                                        <option @if (old('accept_terms') == null) selected @endif disabled>Selecione uma opção
                                                        </option>
                                                        <option value="true" @if (old('accept_terms')) selected @endif>Eu
                                                            <strong>aceito</strong>
                                                        </option>
                                                        <option value="false" @if (old('accept_terms')) selected @endif>Eu <strong>não
                                                                aceito</strong></option>
                                                    </select>
                                                    @error('accept_terms')
                                                        <small class="text-red-700 font-sm">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-span-6">
                                                    <label for="accept_privacy"
                                                        class="block mb-2 text-sm font-medium text-left text-gray-700">{{ __('Você está de acordo com as Políticas de Privacidade da VEGRA (') }}<a
                                                            class="font-medium text-red-600 underline"
                                                            href="#" id="open-privacy-link">{{ __('visualizar') }}</a>{{ __(')?') }}
                                                    </label>
                                                    <select name="accept_privacy" id="accept_privacy"
                                                        class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                                        <option @if (old('accept_privacy') == null) selected @endif disabled>Selecione uma opção
                                                        </option>
                                                        <option value="true" @if (old('accept_privacy')) selected @endif>Eu <strong>estou
                                                                de acordo</strong></option>
                                                        <option value="false" @if (old('accept_privacy')) selected @endif>Eu <strong>não
                                                                estou de acordo</strong></option>
                                                    </select>
                                                    @error('accept_privacy')
                                                        <small class="text-red-700 font-sm">*{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-full gap-4 px-4 py-8 text-center bg-gray-50 sm:px-6">
                                            <a href="{{ route('prospects.registration.co-participant', ['product' => $product->id, 'prospect' => $prospect->id]) }}"
                                                class="inline-flex justify-center px-6 py-4 font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm text-medium hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                {{ __('Voltar') }}</a>
                                            <button type="submit" id="btn-finish"
                                                class="inline-flex justify-center px-6 py-4 font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm text-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                {{ __('Finalizar') }}
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
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm disabled:bg-gray-100 disabled:text-gray-700 focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                </div>
                                <div class="col-span-8 sm:col-span-2">
                                    <label for="last-name"
                                        class="block text-sm font-medium text-left text-gray-700">{{ __('Email') }}</label>
                                    <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm disabled:bg-gray-100 disabled:text-gray-700 focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                </div>
                                <div class="col-span-8 sm:col-span-2">
                                    <label for="first-name"
                                        class="block text-sm font-medium text-left text-gray-700">{{ __('Telefone') }}</label>
                                    <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm disabled:bg-gray-100 disabled:text-gray-700 focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                </div>
                                <div class="col-span-8 sm:col-span-8">
                                    <label for="message"
                                        class="block text-sm font-medium text-left text-gray-700">{{ __('Mensagem') }}</label>
                                    <textarea name="message" id="message" rows="3"
                                        placeholder="Escreva aqui o motivo de sua solicitação"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm disabled:bg-gray-100 disabled:text-gray-700 focus:ring-red-500 focus:border-red-500 sm:text-sm"></textarea>
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
    <div id="modal-privacy" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-black bg-opacity-80" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full sm:p-6">
                <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                    <button type="button" id="close-privacy-removal"
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
                    <div class="pt-2 mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h2 class="flex items-center text-2xl font-medium leading-6 text-gray-900" id="modal-title">
                            {{ __('Políticas de Privacidade da VEGRA') }}
                        </h2>
                        <div class="mt-4 mb-4">
                            <div class="space-y-2 text-sm text-gray-600">
                                {!! $privacy?->content ?? 'Termos ainda não publicados.' }
                            </div>
                        </div>
                    </div>
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

        $('#cancel-privacy-removal').on('click', function(e) {
            $('#modal-privacy').fadeOut();
            e.preventDefault();
        });
        $('#close-privacy-removal').on('click', function(e) {
            $('#modal-privacy').fadeOut();
            e.preventDefault();
        });
        $('#open-privacy-link').on('click', function(e) {
            $('#modal-privacy').fadeIn();
            e.preventDefault();
        });

        var options = {
            onKeyPress: function(phone, e, field, options) {
                var masks = ['(00) 0000-00009', '(00) 00000-0000'];
                var mask = (phone.length > 14) ? masks[1] : masks[0];
                $('#phone').mask(mask, options);
            }
        };

        $('#phone').mask('00000-000', options);


        var optionsCpfCnpj = {
            onKeyPress: function(phone, e, field, options) {
                var masks = ['000.000.000-009', '00.000.000/0000-00'];
                var mask = (phone.length > 14) ? masks[1] : masks[0];
                $('#cpf_cnpj').mask(mask, options);
            }
        };

        $('#accept_terms').on('change', function() {
            if ($("#accept_terms option:selected").val() == 'true' && $("#accept_privacy option:selected").val() ==
                'true') {
                $('#btn-finish').show();
            } else {
                $('#btn-finish').hide();
            }
        });

        $('#accept_privacy').on('change', function() {
            if ($("#accept_terms option:selected").val() == 'true' && $("#accept_privacy option:selected").val() ==
                'true') {
                $('#btn-finish').show();
            } else {
                $('#btn-finish').hide();
            }
        });

        $(() => {
            if ($("#accept_terms option:selected").val() == 'true' && $("#accept_privacy option:selected").val() ==
                'true') {
                $('#btn-finish').show();
            } else {
                $('#btn-finish').hide();
            }
        });
    </script>
    @include('sweetalert::alert')
</body>

</html>
