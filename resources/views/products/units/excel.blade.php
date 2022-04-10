<x-app-layout>
    <x-slot name="header">
        {{ __('Importar / Atualizar unidades com Excel') }}
    </x-slot>

    <div class="px-6 py-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-lg">
        <div class="flex flex-col items-center justify-end md:flex-row">
            <a href="{{ route('products.units.excel.download', ['product' => $product->id]) }}"
                class="flex items-center justify-center px-4 py-2 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-700 border border-transparent rounded-md hover:bg-green-800 focus:outline-none disabled:opacity-25"><i
                    class="mr-2 fas fa-download"></i> {{ 'Download da planilha' }}</a>
            <a href="#" id="upload_spreadsheet_link"
                class="flex items-center justify-center px-4 py-2 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-700 border border-transparent rounded-md hover:bg-indigo-800 focus:outline-none disabled:opacity-25"><i
                    class="mr-2 fas fa-upload"></i> {{ 'Upload da planilha' }}</a>
            @if ($tempUnits->isNotEmpty())
                <a href="{{ route('products.units.excel.confirm', ['product' => $product->id]) }}" id="upload_spreadsheet_link"
                    class="flex items-center justify-center px-4 py-2 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-700 border border-transparent rounded-md hover:bg-red-800 focus:outline-none disabled:opacity-25"><i
                        class="mr-2 fas fa-check"></i> {{ 'Confirmar importação' }}</a>
            @endif
            <a href="{{ route('products.units.excel.cancel', ['product' => $product->id]) }}" id="upload_spreadsheet_link"
                    class="flex items-center justify-center px-4 py-2 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-700 border border-transparent rounded-md hover:bg-gray-800 focus:outline-none disabled:opacity-25"><i
                        class="mr-2 fas fa-times"></i> {{ 'Cancelar' }}</a>
        </div>
    </div>
    <div class="mt-8 overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('line', __('Linha'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('status', __('Ação'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('status', __('Situação'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('type', __('Tipo'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('type_number', __('Num. Tipo'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('number', __('Num. Unidade'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Tamanho') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('price', __('Valor'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('sun', __('Sol'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Previsão entrega') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Pré-chaves?') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Mês ato') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Entrada') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Pré-chaves mensais') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Pré-chaves valor mensais') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Pré-chaves início mensais') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Valor intermediárias') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Data intermediária 1') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Data intermediária 2') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Data intermediária 3') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Data intermediária 4') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Data intermediária 5') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Data intermediária 6') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Tipo financiamento') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Quantidade mensais') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Valor mensais') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Início mensais') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Quantidade anuais') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Valor anuais') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Início anuais') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Descritivo') }}
                    </th>
                </tr>
            </thead>
            <tbody class="overflow-x-auto bg-white divide-y divide-gray-200">
                @if ($tempUnits->isEmpty())
                    <tr class="bg-white">
                        <td class="px-6 py-8 text-sm font-medium text-center text-gray-900 whitespace-nowrap"
                            colspan="6">
                            {{ __('Nenhum dado para pré-validação.') }}
                        </td>
                    </tr>
                @endif
                @foreach ($tempUnits as $unit)
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            {{ $unit->line }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            {{ $unit->getTranslatedStatus() }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            {{ $unit->unit_status }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                            {{ $unit->type }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            {{ $unit->type_number }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            {{ $unit->unit_number }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            {{ number_format($unit->size, 2, ',', '.') }} m²
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            R$ {{ number_format($unit->price, 2, ',', '.') ?? 0 }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                            {{ $unit->sun }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            @dateortext($unit->delivery_forecast)
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            {{ $unit->has_pre_keys ? 'Sim' : 'Não' }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            @dateortext($unit->pre_keys_spot_month)
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            R$ {{ number_format($unit->inflow, 2, ',', '.') ?? 0 }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            {{ $unit->pre_keys_monthly_qty }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            R$ {{ number_format($unit->pre_keys_monthly_value, 2, ',', '.') ?? 0 }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            @dateortext($unit->pre_keys_monthly_start)
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            R$ {{ number_format($unit->pre_keys_intermediate_value, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                            @dateortext($unit->intermediate_start_1)
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            @dateortext($unit->intermediate_start_2)
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            @dateortext($unit->intermediate_start_3)
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            @dateortext($unit->intermediate_start_4)
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            @dateortext($unit->intermediate_start_5)
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            @dateortext($unit->intermediate_start_6)
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                            {{ $unit->financing_type }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            {{ $unit->financing_monthly_qty }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            R$ {{ number_format($unit->financing_monthly_value, 2, ',', '.') ?? 0 }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            @dateortext($unit->financing_monthly_start)
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            {{ $unit->financing_yearly_qty }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            R$ {{ number_format($unit->financing_yearly_value, 2, ',', '.') ?? 0 }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            @dateortext($unit->financing_yearly_start)
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap overflow-ellipsis">
                            {{ $unit->description }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $tempUnits->links('pagination::tailwind') }}
    </div>
    <div id="modal-broker-terms" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-black bg-opacity-80" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full sm:p-6">
                <form action="{{ route('products.units.excel.upload', ['product' => $product->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                        <button type="button" id="close-broker-terms"
                            class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-0">
                            <span class="sr-only">{{ __('Fechar') }}</span>
                            <!-- Heroicon name: outline/x -->
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <div class="w-full pt-2 mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h2 class="flex items-center text-2xl font-medium leading-6 text-gray-900" id="modal-title">
                                {{ __('Carregar planilha de unidades') }}
                            </h2>
                            <div class="mt-8 mb-4">
                                <div class="pr-16 space-y-2 text-justify text-gray-600">
                                    <div class="col-span-12">
                                        <div class="flex items-center justify-center w-full">
                                            <label
                                                class="flex flex-col w-full h-32 cursor-pointer hover:bg-gray-100 hover:border-gray-300">
                                                <div class="relative flex flex-col items-center justify-center pt-7">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-12 h-12 text-gray-400 group-hover:text-gray-600"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600"
                                                        id="preview_units_spreadsheet">
                                                        Selecionar planilha (xls, xlsx)</p>
                                                </div>
                                                <input id="units_spreadsheet" name="units_spreadsheet" type="file"
                                                    class="opacity-0 file-upload" accept="*.xls,*.xlsx" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gap-4 mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button type="button" id="cancel-broker-terms"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            {{ __('Fechar') }}
                        </button>
                        <button type="submit"
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            {{ __('Carregar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('scripts')
        <script>
            $('#cancel-broker-terms').on('click', function(e) {
                $('#modal-broker-terms').fadeOut();
                e.preventDefault();
            });
            $('#close-broker-terms').on('click', function(e) {
                $('#modal-broker-terms').fadeOut();
                e.preventDefault();
            });
            $('#upload_spreadsheet_link').on('click', function(e) {
                $('#modal-broker-terms').fadeIn();
                e.preventDefault();
            });
        </script>
    @endsection
</x-app-layout>
