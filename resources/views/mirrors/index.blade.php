<x-app-layout>
    <x-slot name="header">
        {{ __('Espelho de vendas') }} {{ $product != null ? '- ' . $product->name : '' }}
    </x-slot>

    <div class="px-6 py-4 mt-2 mb-4 bg-white border border-gray-300 rounded-lg shadow-lg print:hidden">
        <div class="flex flex-col items-center justify-between md:flex-row">
            <form class="flex-1 form-inline print:hidden" method="GET">
                <div class="form-group">
                    <div>
                        <div class="flex max-w-2xl rounded-md shadow-sm">
                            <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                <select id="product_id" name="product_id" id="access_profile"
                                    placeholder="{{ __('Selecione um produto') }}"
                                    class="block w-full h-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-l-md">
                                    <option disabled {{ $product == null ? 'selected' : '' }}>Selecione um produto
                                    </option>
                                    @foreach ($products as $p)
                                        @if ($product?->id == $p->id)
                                            <option value="{{ $p->id }}" selected>
                                                {{ $p->name }}</option>
                                        @else
                                            <option value="{{ $p->id }}">{{ $p->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit"
                                class="relative inline-flex items-center px-4 py-2 -ml-px space-x-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-r-md bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-red-500 focus:red-indigo-500">
                                <span>{{ __('Filtrar') }}<i class="fas fas-sort"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <a href="#" onclick="javascript:window.print();"
                class="flex items-center justify-center px-4 py-2 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-600 border border-transparent rounded-md hover:bg-gray-700 focus:outline-none disabled:opacity-25">{{ 'Imprimir' }}</a>
        </div>
    </div>

    <div
        class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg print:visible print:border-none print:shadow-none">
        <div class="p-6 bg-white border-b border-gray-200 print:border-none print:shadow-none">
            @if ($product != null)
                <div class="flex justify-end mb-8">
                    <span class="relative z-0 inline-flex rounded-md shadow-sm">
                        <button type="button" disabled
                            class="relative inline-flex items-center px-6 py-2 text-sm font-medium text-white bg-green-600 border border-gray-300 rounded-l-md">{{ __('Livre') }}
                            ({{ $free }})</button>
                        <button type="button" disabled
                            class="relative inline-flex items-center px-6 py-2 -ml-px text-sm font-medium text-white bg-indigo-600 border border-gray-300">{{ __('Reservada') }}
                            ({{ $booked }})</button>
                        <button type="button" disabled
                            class="relative inline-flex items-center px-6 py-2 -ml-px text-sm font-medium text-white bg-red-600 border border-gray-300 rounded-r-md">{{ __('Vendida') }}
                            ({{ $sold }})</button>
                    </span>
                </div>
            @endif
            @foreach ($unit_groups as $unit_group)
                @if (!$unit_group->units->isEmpty())
                    <h2 class="col-span-6 mb-2 text-lg font-semibold leading-tight text-center text-gray-500">
                        {{ $unit_group->getTranslatedType() . ' ' . $unit_group->number }}
                    </h2>
                    <hr class="col-span-6 mt-2" />
                    <ul role="list"
                        class="grid grid-cols-1 gap-4 mt-2 sm:gap-2 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-6 print:grid-cols-3">
                        @foreach ($unit_group->units->sortBy([['floor', 'asc'], ['number', 'asc']]) as $unit)
                            <li class="flex col-span-1 rounded-md shadow-sm cursor-help"
                                data-bs-title="<strong>{{ $unit_group->getTranslatedType() . ' ' . $unit_group->number . ' - Unidade ' . $unit->number }}</strong>"
                                data-bs-content="{{ $unit->getPopoverContent() }}"
                                data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-html="true">
                                <div
                                    class="text-center flex-shrink-0 flex flex-col items-center justify-center w-16 bg-{{ $unit->getStatusColor() }}-600 text-white text-sm print:text-xs font-medium rounded-l-md">
                                    <div>{{ $unit->number }}</div>
                                    <div class="block">({{ $unit->getStatusChar() }})</div>
                                </div>
                                <div
                                    class="flex items-center justify-between flex-1 truncate bg-white border-t border-b border-r border-gray-200 rounded-r-md">
                                    <div class="flex-1 px-4 py-2 text-sm truncate print:text-xs">
                                        <p class="font-medium text-gray-900 hover:text-gray-600">
                                            {{ $unit->size }} m²</p>
                                        <p class="text-gray-500">R$
                                            {{ number_format($unit->price, 2, ',', '.') }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
    </div>
    <div class="hidden text-red-800 bg-red-200"></div>
    <div class="hidden text-gray-800 bg-gray-200"></div>
    <div class="hidden text-green-800 bg-green-200"></div>
    <div class="hidden text-yellow-800 bg-yellow-200"></div>
    @section('scripts')
        <script>
            var popoverTriggerList = [].slice.call(
                document.querySelectorAll('[data-bs-toggle="popover"]')
            );
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new Popover(popoverTriggerEl);
            });
        </script>
    @endsection
    @section('styles')
        <style>
            .popover {
                border: 1px solid gainsboro;
            }
            .popover-header {
                text-align: center;
            }
            .popover-body {
                text-align: justify;
            }
            .popover-body hr {
                margin: 10px 0;
            }
        </style>
    @endsection
</x-app-layout>
