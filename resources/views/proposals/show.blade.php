<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100 print:bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Proposta {{ $proposal->id }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="h-full">
    <div class="min-h-full">
        <main>
            <div class="px-4 pb-12 mx-auto sm:px-6 lg:px-8">
                <div class="grid items-center grid-cols-12 gap-4">
                    <div class="grid grid-cols-1 col-span-12 gap-4 mt-4 md:col-span-10 md:col-start-2">
                        <section aria-labelledby="section-1-title">
                            <h2 class="sr-only" id="section-1-title">Section title</h2>
                            <div class="overflow-hidden bg-white border border-gray-300 rounded-lg shadow-md">
                                <div>
                                    <div class="flex items-center justify-between px-6 py-4 bg-red-700">
                                        <p class="text-lg text-justify text-white">
                                            {{ $proposal->product->name }} - Proposta
                                        </p>
                                        <img class="w-auto h-8 my-2" src="{{ asset('images/logo-vegra-white.png') }}"
                                            alt="Logo Vegra">
                                    </div>
                                </div>
                                <div class="flex items-center justify-between px-8 ">
                                    <h1
                                        class="mt-8 mb-2 text-lg font-semibold text-gray-700 uppercase print:text-center">
                                        Proposta {{ $proposal->getTranslatedPaymentMethod() }}</h1>
                                    <a href="#" onclick="javascript:window.print();"
                                        class="flex items-center justify-center px-4 py-2 mt-8 mb-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-600 border border-transparent rounded-md print:invisible hover:bg-gray-700 focus:outline-none disabled:opacity-25">{{ 'Imprimir' }}</a>
                                </div>
                                <hr class="mx-8 mb-8" />
                                <div
                                    class="mx-8 mb-8 overflow-hidden bg-white border border-gray-300 divide-y divide-gray-200 rounded-lg shadow-lg">
                                    <div
                                        class="flex justify-between items-center px-4 py-4 sm:px-6 bg-{{ $proposal->getStatusColor() }}-400 print:bg-white">
                                        <h1
                                            class="text-lg font-bold text-left text-white uppercase print:text-gray-700">
                                            {{ __('Dados da proposta') }}
                                        </h1>
                                        <h1
                                            class="text-lg font-bold text-left text-white uppercase print:text-gray-700">
                                            {{ $proposal->translateStatus(false) }}
                                        </h1>
                                    </div>
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="grid grid-cols-12 gap-4">
                                            <div class="col-span-12 sm:col-span-6 lg:col-span-4 print:col-span-6">
                                                {{ __('Código aprovado') }}: <strong
                                                    class="uppercase">{{ $proposal->code->code }}</strong>
                                            </div>
                                            <div class="col-span-12 sm:col-span-6 lg:col-span-4 print:col-span-6">
                                                {{ $proposal->unit->unit_group->getTranslatedType() }}: <strong
                                                    class="uppercase">{{ $proposal->unit->unit_group->number }}</strong>
                                            </div>
                                            <div
                                                class="col-span-12 sm:col-start-1 md:col-span-6 lg:col-span-4 print:col-span-6">
                                                {{ __('Nome') }}: <strong
                                                    class="uppercase">{{ $proposal->prospect->name }}</strong>
                                            </div>
                                            <div class="col-span-12 sm:col-span-6 lg:col-span-4 print:col-span-6">
                                                {{ __('Unidade') }}: <strong
                                                    class="uppercase">{{ $proposal->unit->getTranslatedFloor() . ' / ' . $proposal->unit->number }}</strong>
                                            </div>
                                            <div
                                                class="col-span-12 sm:col-start-1 md:col-span-6 lg:col-span-4 print:col-span-6">
                                                {{ __('Renda pré-aprovada') }}: <strong class="uppercase">R$
                                                    {{ number_format($proposal->prospect->total_incoming, 2, ',', '.') }}</strong>
                                            </div>
                                            <div class="col-span-12 sm:col-span-6 lg:col-span-4 print:col-span-6">
                                                {{ __('Metragem') }}: <strong
                                                    class="uppercase">{{ number_format($proposal->unit->size, 2, ',', '') }}
                                                    m²</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mx-8 mb-8 overflow-hidden bg-white border border-gray-300 divide-y divide-gray-200 rounded-lg shadow-lg">
                                    <div
                                        class="flex items-center justify-between px-4 py-4 bg-gray-400 sm:px-6 print:bg-white">
                                        <h1
                                            class="text-lg font-bold text-left text-white uppercase print:text-gray-700">
                                            {{ __('Fluxo de pagamento') }}
                                        </h1>
                                    </div>
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="grid grid-cols-12 gap-4">
                                            <div class="col-span-12 sm:col-span-6 lg:col-span-4 print:col-span-6">
                                                {{ __('Valor da Unidade') }}: <strong class="uppercase">R$
                                                    {{ number_format($proposal->unit_price, 2, ',', '.') }}</strong>
                                            </div>
                                            <div class="col-span-12 sm:col-span-6 lg:col-span-4 print:col-span-6">
                                                {{ __('Comissão') }}: <strong class="uppercase">R$
                                                    {{ number_format($proposal->partner_commission_value, 2, ',', '.') }}</strong>
                                            </div>
                                        </div>
                                        @if ($proposal->payments->where('section', 'pre_keys')->isNotEmpty())
                                            <div class="grid grid-cols-12 gap-4">
                                                <div class="col-span-12">
                                                    <h1
                                                        class="mt-8 mb-2 font-semibold text-gray-700 uppercase text-md print:text-left">
                                                        {{ __('Pré-chaves') }}</h1>
                                                    <hr />
                                                </div>
                                                @foreach ($proposal->payments->where('section', 'pre_keys')->where('type', 'cash') as $payment)
                                                    <div class="col-span-12">
                                                        <h1
                                                            class="font-semibold text-red-700 uppercase text-md print:text-left">
                                                            {{ $payment->getTranslatedTypePreKeys() }}</h1>
                                                    </div>
                                                    <div
                                                        class="col-span-12 sm:col-span-4 lg:col-span-4 print:col-span-4">
                                                        {{ __('Parcela(s)') }}: <strong class="uppercase">
                                                            {{ $payment->installments }}</strong>
                                                    </div>
                                                    <div
                                                        class="col-span-12 sm:col-span-4 lg:col-span-4 print:col-span-4">
                                                        {{ __('Valor') }}: <strong class="uppercase">R$
                                                            {{ number_format($payment->installment_value, 2, ',', '.') }}</strong>
                                                    </div>
                                                    <div
                                                        class="col-span-12 sm:col-span-4 lg:col-span-4 print:col-span-4">
                                                        {{ __('Mês do pgto.') }}: <strong class="uppercase">
                                                            {{ $payment->start_date?->format('m/Y') }}</strong>
                                                    </div>
                                                @endforeach
                                                @foreach ($proposal->payments->where('section', 'pre_keys')->where('type', 'monthly') as $payment)
                                                    <div class="col-span-12">
                                                        <h1
                                                            class="font-semibold text-red-700 uppercase text-md print:text-left">
                                                            {{ $payment->getTranslatedTypePreKeys() }}</h1>
                                                    </div>
                                                    <div
                                                        class="col-span-12 sm:col-span-4 lg:col-span-4 print:col-span-4">
                                                        {{ __('Parcela(s)') }}: <strong class="uppercase">
                                                            {{ $payment->installments }}</strong>
                                                    </div>
                                                    <div
                                                        class="col-span-12 sm:col-span-4 lg:col-span-4 print:col-span-4">
                                                        {{ __('Valor') }}: <strong class="uppercase">R$
                                                            {{ number_format($payment->installment_value, 2, ',', '.') }}</strong>
                                                    </div>
                                                    <div
                                                        class="col-span-12 sm:col-span-4 lg:col-span-4 print:col-span-4">
                                                        {{ __('Mês do pgto.') }}: <strong class="uppercase">
                                                            {{ $payment->start_date?->format('m/Y') }}</strong>
                                                    </div>
                                                @endforeach
                                                @if ($proposal->payments->where('section', 'pre_keys')->where('type', 'intermediate')->isNotEmpty())
                                                    <div class="col-span-12">
                                                        <h1
                                                            class="font-semibold text-red-700 uppercase text-md print:text-left">
                                                            {{ $proposal->payments->where('section', 'pre_keys')->where('type', 'intermediate')->first()->getTranslatedTypePreKeys() }}</h1>
                                                    </div>
                                                @endif
                                                @foreach ($proposal->payments->where('section', 'pre_keys')->where('type', 'intermediate')->sortBy('start_date') as $payment)
                                                    <div
                                                        class="col-span-12 sm:col-span-4 lg:col-span-4 print:col-span-4">
                                                        {{ __('Parcela(s)') }}: <strong class="uppercase">
                                                            {{ $payment->installments }}</strong>
                                                    </div>
                                                    <div
                                                        class="col-span-12 sm:col-span-4 lg:col-span-4 print:col-span-4">
                                                        {{ __('Valor') }}: <strong class="uppercase">R$
                                                            {{ number_format($payment->installment_value, 2, ',', '.') }}</strong>
                                                    </div>
                                                    <div
                                                        class="col-span-12 sm:col-span-4 lg:col-span-4 print:col-span-4">
                                                        {{ __('Mês do pgto.') }}: <strong class="uppercase">
                                                            {{ $payment->start_date?->format('m/Y') }}</strong>
                                                    </div>
                                                @endforeach
                                                <div class="col-span-12">
                                                    {{ __('Valor total Pré-chaves') }}: <strong
                                                        class="uppercase">R$
                                                        {{ number_format($proposal->getTotalPreKeysValue(), 2, ',', '.') }}</strong>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($proposal->payment_method != 'cash')
                                            <div class="grid grid-cols-12 gap-4">
                                                <div class="col-span-12">
                                                    <h1
                                                        class="mt-8 mb-2 font-semibold text-gray-700 uppercase text-md print:text-left">
                                                        {{ __('Pós-chaves') }}
                                                    </h1>
                                                    <hr />
                                                </div>
                                                @if ($proposal->payments->where('section', 'post_keys')->isNotEmpty())
                                                    <div class="col-span-12">
                                                        <h1
                                                            class="mt-4 mb-2 font-semibold text-gray-700 uppercase text-md print:text-left">
                                                            {{ __('Financiamento') }} <strong
                                                                class="font-bold text-red-700">{{ $proposal->getTranslatedFinancingType() }}</strong>
                                                        </h1>
                                                        <h1 />
                                                    </div>
                                                    @foreach ($proposal->payments->where('section', 'post_keys')->sortByDesc('type') as $payment)
                                                        <div class="col-span-12">
                                                            <h1
                                                                class="font-semibold text-red-700 uppercase text-md print:text-left">
                                                                {{ $payment->getTranslatedTypePostKeys() }}</h1>
                                                        </div>
                                                        <div
                                                            class="col-span-12 sm:col-span-4 lg:col-span-4 print:col-span-4">
                                                            {{ __('Parcela(s)') }}: <strong class="uppercase">
                                                                {{ $payment->installments }}</strong>
                                                        </div>
                                                        <div
                                                            class="col-span-12 sm:col-span-4 lg:col-span-4 print:col-span-4">
                                                            {{ __('Valor') }}: <strong class="uppercase">R$
                                                                {{ number_format($payment->installment_value, 2, ',', '.') }}</strong>
                                                        </div>
                                                        <div
                                                            class="col-span-12 sm:col-span-4 lg:col-span-4 print:col-span-4">
                                                            {{ __('Mês do pgto.') }}: <strong class="uppercase">
                                                                {{ $payment->start_date?->format('m/Y') }}</strong>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if ($proposal->financing_type == 'incorporator')
                                                    <div class="col-span-12">
                                                        {{ __('Valor total financiado') }}: <strong
                                                            class="uppercase">R$
                                                            {{ number_format($proposal->getTotalPostKeysValue(), 2, ',', '.') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                        <hr class="mt-12 mb-2" />
                                        <div class="grid grid-cols-12 gap-4">
                                            <div class="col-span-12">
                                                <p class="mt-4 text-sm font-semibold text-center text-gray-700">
                                                    {{ __('A efetivação da venda vai depender da aprovação do departamento comercial da') }}
                                                    <span class="font-bold text-red-700">VEGRA</span>
                                                </p>
                                                <p class="mb-4 text-sm font-bold text-center text-gray-700">
                                                    {{ __('A correção monetária das parcelas e o saldo devedor terão como base o mês: ') .$proposal->payments->where('section', 'pre_keys')->where('type', 'cash')?->first()?->start_date?->format('m/Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="hidden bg-red-400"></div>
    <div class="hidden bg-gray-400"></div>
    <div class="hidden bg-green-400"></div>
    <div class="hidden bg-yellow-400"></div>
    <script src="{{ asset('js/app.js') }}"></script>
    @include('sweetalert::alert')
</body>

</html>
