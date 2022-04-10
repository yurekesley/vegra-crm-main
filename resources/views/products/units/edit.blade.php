<x-app-layout>
    <x-slot name="header">
        {{ __('Editar unidade') }}
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form
            action="{{ route('products.units.update', ['product' => $product->id, 'unit' => $unit->id, 'timestamp' => time()]) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 sm:col-span-2">
                                <label for="unit_group_id"
                                    class="block text-sm font-medium text-gray-700 whitespace-nowrap">{{ __('Bloco / Torre / Vila / Quadra') }}</label>
                                <select name="unit_group_id" id="unit_group_id" placeholder="{{ __('...') }}"
                                    class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                    @foreach ($unitGroups as $unitGroup)
                                        <option value="{{ $unitGroup->id }}"
                                            {{ (old('unit_group_id') ?? $unit->unit_group_id) == $unitGroup->id ? 'selected' : '' }}>
                                            {{ $unitGroup->getTranslatedType() . ' ' . $unitGroup->number }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('unit_group_id')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-2">
                                <label for="size"
                                    class="block text-sm font-medium text-gray-700">{{ __('Metragem (M²)') }}</label>
                                <input type="number" name="size" id="size" autocomplete="given-size"
                                    placeholder="Ex.: 45,40" step="0.1"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('size') ?? $unit->size }}">
                                @error('size')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-1">
                                <label for="number"
                                    class="block text-sm font-medium text-gray-700">{{ __('Número') }}</label>
                                <input type="text" name="number" id="number" autocomplete="given-pre_keys_monthly"
                                    placeholder="Ex.: 1, 5, 10..." step="1"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('number') ?? $unit->number }}">
                                @error('number')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-4">
                            <div class="col-span-12 sm:col-span-2">
                                <label for="price"
                                    class="block text-sm font-medium text-gray-700">{{ __('Valor (R$)') }}</label>
                                <input type="number" name="price" id="price" autocomplete="given-pre_keys_monthly"
                                    placeholder="Ex.: 100000,00" step="1"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('price') ?? $unit->price }}">
                                @error('price')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-2">
                                <label for="sun"
                                    class="block text-sm font-medium text-gray-700">{{ __('Sol') }}</label>
                                <select name="sun" id="sun" placeholder="{{ __('...') }}"
                                    class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                    <option value="morning"
                                        {{ (old('sun') ?? $unit->sun) == 'morning' ? 'selected' : '' }}>
                                        {{ __('Sol da manhã') }}</option>
                                    <option value="afternoon"
                                        {{ (old('sun') ?? $unit->sun) == 'afternoon' ? 'selected' : '' }}>
                                        {{ __('Sol da tarde') }}</option>
                                    <option value="any" {{ (old('sun') ?? $unit->sun) == 'any' ? 'selected' : '' }}>
                                        {{ __('Indiferente') }}</option>
                                </select>
                                @error('sun')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <label for="floor"
                                    class="block text-sm font-medium text-gray-700">{{ __('Andar') }}</label>
                                <select name="floor" id="floor" placeholder="{{ __('...') }}"
                                    class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                    <option value="0" {{ (old('floor') ?? $unit->floor) == '0' ? 'selected' : '' }}>
                                        {{ __('Térreo') }}</option>
                                    @for ($i = 1; $i <= 30; $i++)
                                        <option value="{{ $i }}"
                                            {{ (old('floor') ?? $unit->floor) == $i ? 'selected' : '' }}>
                                            {{ $i . __('º andar') }}</option>
                                    @endfor
                                </select>
                                @error('floor')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-1">
                                <label for="final_number"
                                    class="block text-sm font-medium text-gray-700">{{ __('Final') }}</label>
                                <input type="number" name="final_number" id="final_number"
                                    autocomplete="given-final_number" placeholder="Ex.: 2" step="1"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('final_number') ?? $unit->final_number }}">
                                @error('final_number')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-1">
                                <label for="parking_lots"
                                    class="block text-sm font-medium text-gray-700">{{ __('Vagas') }}</label>
                                <input type="number" name="parking_lots" id="parking_lots"
                                    autocomplete="given-parking_lots" placeholder="Ex.: 2" step="1"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('parking_lots') ?? $unit->parking_lots }}">
                                @error('parking_lots')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <hr class="mt-5 mb-2" />
                        <div class="grid grid-cols-6 gap-6 mt-4">
                            <div class="col-span-6 sm:col-span-1">
                                <label for="delivery_forecast"
                                    class="block text-sm font-medium text-gray-700">{{ __('Previsão de entrega') }}</label>
                                <input type="text" name="delivery_forecast" id="delivery_forecast"
                                    autocomplete="given-delivery_forecast" placeholder="MM/AAAA"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('delivery_forecast') ?? $unit->delivery_forecast }}"
                                    data-mask="00/0000">
                                @error('delivery_forecast')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="has_pre_keys"
                                    class="block text-sm font-medium text-gray-700">{{ __('Possui Pré-Chaves') }}</label>
                                <select id="has_pre_keys" name="has_pre_keys" placeholder="{{ __('...') }}"
                                    class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                    <option value="yes"
                                        {{ old('has_pre_keys') ?? ($unit->has_pre_keys ? 'yes' : 'no') == 'yes' ? 'selected' : '' }}>
                                        Sim</option>
                                    <option value="no"
                                        {{ old('has_pre_keys') ?? ($unit->has_pre_keys ? 'yes' : 'no') == 'no' ? 'selected' : '' }}>
                                        Não</option>
                                </select>
                                @error('has_pre_keys')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-6 mt-4">
                            <h2 class="col-span-6 mt-3 font-semibold leading-tight text-gray-600 text-md">
                                {{ __('Fluxo - Pré-Chaves') }}
                            </h2>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="pre_keys_spot_month"
                                    class="block text-sm font-medium text-gray-700">{{ __('Mês Pgto. Ato') }}</label>
                                <input type="text" name="pre_keys_spot_month" id="pre_keys_spot_month"
                                    autocomplete="given-pre_keys_spot_month" placeholder="MM/AAAA"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('pre_keys_spot_month') ?? $unit->pre_keys_spot_month?->format('mY') }}"
                                    data-mask="00/0000">
                                @error('pre_keys_spot_month')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="inflow"
                                    class="block text-sm font-medium text-gray-700">{{ __('Valor de entrada') }}</label>
                                <input type="number" name="inflow" id="inflow" autocomplete="given-inflow"
                                    placeholder="Ex.: 31000,00" step="1"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('inflow') ?? $unit->inflow }}">
                                @error('inflow')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="pre_keys_monthly_qty"
                                    class="block text-sm font-medium text-gray-700">{{ __('Quantidade mensais') }}</label>
                                <input type="number" name="pre_keys_monthly_qty" id="pre_keys_monthly_qty"
                                    autocomplete="given-pre_keys_monthly_qty" placeholder="Ex.: 40" step="1"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('pre_keys_monthly_qty') ?? $unit->pre_keys_monthly_qty }}">
                                @error('pre_keys_monthly_qty')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="pre_keys_monthly_value"
                                    class="block text-sm font-medium text-gray-700">{{ __('Valor das mensais (R$)') }}</label>
                                <input type="number" name="pre_keys_monthly_value" id="pre_keys_monthly_value"
                                    autocomplete="given-pre_keys_monthly_value" placeholder="Ex.: 1000,00" step="1"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('pre_keys_monthly_value') ?? $unit->pre_keys_monthly_value }}">
                                @error('pre_keys_monthly_value')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="pre_keys_monthly_start"
                                    class="block text-sm font-medium text-gray-700">{{ __('Data de início das mensais') }}</label>
                                <input type="text" name="pre_keys_monthly_start" id="pre_keys_monthly_start"
                                    autocomplete="given-pre_keys_monthly_start" placeholder="MM/AAAA"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('pre_keys_monthly_start') ?? $unit->pre_keys_monthly_start?->format('mY') }}"
                                    data-mask="00/0000">
                                @error('pre_keys_monthly_start')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-6 mt-5">
                            <div class="col-span-6 sm:col-span-1">
                                <label for="pre_keys_intermediate_value"
                                    class="block text-sm font-medium text-gray-700">{{ __('Valor das intermediárias') }}</label>
                                <input type="number" name="pre_keys_intermediate_value" id="pre_keys_intermediate_value"
                                    autocomplete="given-pre_keys_intermediate_value" placeholder="Ex.: 10000,00"
                                    step="1"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('pre_keys_intermediate_value') ?? $unit->pre_keys_intermediate_value }}">
                                @error('pre_keys_intermediate_value')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-6 mt-5">
                            <div class="col-span-6 sm:col-span-1">
                                <label for="intermediate_start_1"
                                    class="block text-sm font-medium text-gray-700">{{ __('Pgto. intermediária 1') }}</label>
                                <input type="text" name="intermediate_start_1" id="intermediate_start_1"
                                    autocomplete="given-intermediate_start_1" placeholder="MM/AAAA"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('intermediate_start_1') ?? $unit->intermediate_start_1?->format('mY') }}"
                                    data-mask="00/0000">
                                @error('intermediate_start_1')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="intermediate_start_2"
                                    class="block text-sm font-medium text-gray-700">{{ __('Pgto. intermediária 2') }}</label>
                                <input type="text" name="intermediate_start_2" id="intermediate_start_2"
                                    autocomplete="given-intermediate_start_2" placeholder="MM/AAAA"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('intermediate_start_2') ?? $unit->intermediate_start_2?->format('mY') }}"
                                    data-mask="00/0000">
                                @error('intermediate_start_2')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="intermediate_start_2"
                                    class="block text-sm font-medium text-gray-700">{{ __('Pgto. intermediária 3') }}</label>
                                <input type="text" name="intermediate_start_3" id="intermediate_start_3"
                                    autocomplete="given-intermediate_start_3" placeholder="MM/AAAA"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('intermediate_start_3') ?? $unit->intermediate_start_3?->format('mY') }}"
                                    data-mask="00/0000">
                                @error('intermediate_start_3')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="intermediate_start_4"
                                    class="block text-sm font-medium text-gray-700">{{ __('Pgto. intermediária 4') }}</label>
                                <input type="text" name="intermediate_start_4" id="intermediate_start_4"
                                    autocomplete="given-intermediate_start_4" placeholder="MM/AAAA"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('intermediate_start_4') ?? $unit->intermediate_start_4?->format('mY') }}"
                                    data-mask="00/0000">
                                @error('intermediate_start_4')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="intermediate_start_5"
                                    class="block text-sm font-medium text-gray-700">{{ __('Pgto. intermediária 5') }}</label>
                                <input type="text" name="intermediate_start_5" id="intermediate_start_5"
                                    autocomplete="given-intermediate_start_5" placeholder="MM/AAAA"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('intermediate_start_5') ?? $unit->intermediate_start_5?->format('mY') }}"
                                    data-mask="00/0000">
                                @error('intermediate_start_5')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="intermediate_start_6"
                                    class="block text-sm font-medium text-gray-700">{{ __('Pgto. intermediária 6') }}</label>
                                <input type="text" name="intermediate_start_6" id="intermediate_start_6"
                                    autocomplete="given-intermediate_start_6" placeholder="MM/AAAA"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('intermediate_start_6') ?? $unit->intermediate_start_6?->format('mY') }}"
                                    data-mask="00/0000">
                                @error('intermediate_start_6')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-6 mt-4">
                            <h2 class="col-span-6 mt-3 font-semibold leading-tight text-gray-600 text-md">
                                {{ __('Fluxo - Pós-Chaves') }}
                            </h2>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="post_keys_financing_type"
                                    class="block text-sm font-medium text-gray-700">{{ __('Financiamento') }}</label>
                                <select id="post_keys_financing_type" name="post_keys_financing_type"
                                    placeholder="{{ __('...') }}"
                                    class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                    <option value="incorporator"
                                        {{ old('post_keys_financing_type') ?? $unit->post_keys_financing_type == 'incorporator' ? 'selected' : '' }}>
                                        Próprio</option>
                                    <option value="bank"
                                        {{ old('post_keys_financing_type') ?? $unit->post_keys_financing_type == 'bank' ? 'selected' : '' }}>
                                        Bancário</option>
                                </select>
                                @error('post_keys_financing_type')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-6 mt-4">
                            <div class="col-span-6 sm:col-span-1">
                                <label for="financing_monthly_qty"
                                    class="block text-sm font-medium text-gray-700">{{ __('Meses financiamento') }}</label>
                                <input type="number" name="financing_monthly_qty" id="financing_monthly_qty"
                                    autocomplete="given-financing_monthly_qty" placeholder="Ex.: 40" step="1"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('financing_monthly_qty') ?? $unit->financing_monthly_qty }}">
                                @error('financing_monthly_qty')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="financing_monthly_value"
                                    class="block text-sm font-medium text-gray-700">{{ __('Valor das mensais (R$)') }}</label>
                                <input type="number" name="financing_monthly_value" id="financing_monthly_value"
                                    autocomplete="given-financing_monthly_value" placeholder="Ex.: 1000,00" step="1"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('financing_monthly_value') ?? $unit->financing_monthly_value }}">
                                @error('financing_monthly_value')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="financing_monthly_start"
                                    class="block text-sm font-medium text-gray-700">{{ __('Data de início das mensais') }}</label>
                                <input type="text" name="financing_monthly_start" id="financing_monthly_start"
                                    autocomplete="given-financing_monthly_start" placeholder="MM/AAAA"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('financing_monthly_start') ?? $unit->financing_monthly_start?->format('mY') }}"
                                    data-mask="00/0000">
                                @error('financing_monthly_start')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-6 mt-4">
                            <div class="col-span-6 sm:col-span-1">
                                <label for="financing_yearly_qty"
                                    class="block text-sm font-medium text-gray-700">{{ __('Anos financiamento') }}</label>
                                <input type="number" name="financing_yearly_qty" id="financing_yearly_qty"
                                    autocomplete="given-financing_yearly_qty" placeholder="Ex.: 40" step="1"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('financing_yearly_qty') ?? $unit->financing_yearly_qty }}">
                                @error('financing_yearly_qty')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="financing_yearly_value"
                                    class="block text-sm font-medium text-gray-700">{{ __('Valor das anuais (R$)') }}</label>
                                <input type="number" name="financing_yearly_value" id="financing_yearly_value"
                                    autocomplete="given-financing_yearly_value" placeholder="Ex.: 1000,00" step="1"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('financing_yearly_value') ?? $unit->financing_yearly_value }}">
                                @error('financing_yearly_value')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-1">
                                <label for="financing_yearly_start"
                                    class="block text-sm font-medium text-gray-700">{{ __('Data de início das anuais') }}</label>
                                <input type="text" name="financing_yearly_start" id="financing_yearly_start"
                                    autocomplete="given-financing_yearly_start" placeholder="MM/AAAA"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                    value="{{ old('financing_yearly_start') ?? $unit->financing_yearly_start?->format('mY') }}"
                                    data-mask="00/0000">
                                @error('financing_yearly_start')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-6 mt-4">
                            <div class="col-span-12 md:col-span-12">
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700">{{ __('Descritivo') }}</label>
                                <x-tinymce-editor id="description" name="description" rows="6"
                                    :content="old('description') ?? $unit->description"
                                    class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </x-tinymce-editor>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                    <a href="{{ route('products.unit_groups.index', $product->id) }}"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('Voltar') }}</a>
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('Alterar') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', (e) => {
                $('#number').on('input', function() {
                    $('#final_number').val(this.value.substring(this.value.length - 1, this.value.length));
                });

                $('#has_pre_keys').on('change', function() {
                    if ($('#has_pre_keys option:selected').val() == 'no') {
                        $('#pre_keys_spot').val('');
                        $('#pre_keys_spot').prop('disabled', true);
                        $('#pre_keys_monthly_qty').val('');
                        $('#pre_keys_monthly_qty').prop('disabled', true);
                        $('#pre_keys_monthly_value').val('');
                        $('#pre_keys_monthly_value').prop('disabled', true);
                        $('#pre_keys_monthly_start').val('');
                        $('#pre_keys_monthly_start').prop('disabled', true);
                        $('#pre_keys_spot_month').prop('disabled', false);
                        $('#pre_keys_intermediate_value').val('');
                        $('#pre_keys_intermediate_value').prop('disabled', true);
                        $('#inflow').val('');
                        $('#inflow').prop('disabled', true);
                        $('#monthly_qty').val('');
                        $('#monthly_qty').prop('disabled', true);
                        $('#monthly_start').val('');
                        $('#monthly_start').prop('disabled', true);
                        $('#intermediate_start_1').val('');
                        $('#intermediate_start_1').prop('disabled', true);
                        $('#intermediate_start_2').val('');
                        $('#intermediate_start_2').prop('disabled', true);
                        $('#intermediate_start_3').val('');
                        $('#intermediate_start_3').prop('disabled', true);
                        $('#intermediate_start_4').val('');
                        $('#intermediate_start_4').prop('disabled', true);
                        $('#intermediate_start_5').val('');
                        $('#intermediate_start_5').prop('disabled', true);
                        $('#intermediate_start_6').val('');
                        $('#intermediate_start_6').prop('disabled', true);
                    } else {
                        $('#pre_keys_spot').val('');
                        $('#pre_keys_spot').prop('disabled', false);
                        $('#pre_keys_monthly_qty').val('');
                        $('#pre_keys_monthly_qty').prop('disabled', false);
                        $('#pre_keys_monthly_value').val('');
                        $('#pre_keys_monthly_value').prop('disabled', false);
                        $('#pre_keys_monthly_start').val('');
                        $('#pre_keys_monthly_start').prop('disabled', false);
                        $('#pre_keys_spot_month').prop('disabled', false);
                        $('#pre_keys_intermediate_value').val('');
                        $('#pre_keys_intermediate_value').prop('disabled', false);
                        $('#inflow').val('');
                        $('#inflow').prop('disabled', false);
                        $('#monthly_qty').val('');
                        $('#monthly_qty').prop('disabled', false);
                        $('#monthly_start').val('');
                        $('#monthly_start').prop('disabled', false);
                        $('#intermediate_start_1').val('');
                        $('#intermediate_start_1').prop('disabled', false);
                        $('#intermediate_start_2').val('');
                        $('#intermediate_start_2').prop('disabled', false);
                        $('#intermediate_start_3').val('');
                        $('#intermediate_start_3').prop('disabled', false);
                        $('#intermediate_start_4').val('');
                        $('#intermediate_start_4').prop('disabled', false);
                        $('#intermediate_start_5').val('');
                        $('#intermediate_start_5').prop('disabled', false);
                        $('#intermediate_start_6').val('');
                        $('#intermediate_start_6').prop('disabled', false);
                    }
                });

                $('#post_keys_financing_type').on('change', function() {
                    if ($("#post_keys_financing_type option:selected").val() == 'incorporator') {
                        $('#financing_monthly_qty').prop('disabled', false);
                        $('#financing_monthly_value').prop('disabled', false);
                        $('#financing_monthly_start').prop('disabled', false);
                        $('#financing_monthly_has_interest_rate').prop('disabled', false);
                        $('#financing_monthly_interest_rate').prop('disabled', false);
                        $('#financing_yearly_qty').prop('disabled', false);
                        $('#financing_yearly_value').prop('disabled', false);
                        $('#financing_yearly_start').prop('disabled', false);
                        $('#financing_yearly_has_interest_rate').prop('disabled', false);
                        $('#financing_yearly_interest_rate').prop('disabled', false);
                    } else {
                        $('#financing_monthly_qty').prop('disabled', true);
                        $('#financing_monthly_value').prop('disabled', true);
                        $('#financing_monthly_start').prop('disabled', true);
                        $('#financing_monthly_has_interest_rate').prop('disabled', true);
                        $('#financing_monthly_interest_rate').prop('disabled', true);
                        $('#financing_yearly_qty').prop('disabled', true);
                        $('#financing_yearly_value').prop('disabled', true);
                        $('#financing_yearly_start').prop('disabled', true);
                        $('#financing_yearly_has_interest_rate').prop('disabled', true);
                        $('#financing_yearly_interest_rate').prop('disabled', true);
                        $('#financing_monthly_qty').val('');
                        $('#financing_monthly_value').val('');
                        $('#financing_monthly_start').val('');
                        $('#financing_monthly_has_interest_rate').prop('checked', false);
                        $('#financing_monthly_interest_rate').val('');
                        $('#financing_yearly_qty').val('');
                        $('#financing_yearly_value').val('');
                        $('#financing_yearly_start').val('');
                        $('#financing_yearly_has_interest_rate').prop('checked', false);
                        $('#financing_yearly_interest_rate');
                    }
                });

                $(() => {
                    $('#type').trigger('change');
                    $('#has_pre_keys').trigger('change');
                    $('#post_keys_financing_type').trigger('change');
                });
            });
        </script>
    @endsection
</x-app-layout>
