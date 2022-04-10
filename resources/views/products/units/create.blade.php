<x-app-layout>
    <x-slot name="header">
        {{ __('Criar unidade') }}
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form action="{{ route('products.units.store', [$product->id, 'timestamp' => time()]) }}" method="POST">
            @csrf
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
                                        {{ old('unit_group_id') == $unitGroup->id ? 'selected' : '' }}>
                                        {{ $unitGroup->getTranslatedType() . ' ' . $unitGroup->number }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit_group_id')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-1">
                            <label for="size"
                                class="block text-sm font-medium text-gray-700">{{ __('Metragem (M²)') }}</label>
                            <input type="number" name="size" id="size" autocomplete="given-size"
                                placeholder="Ex.: 45,40" step="0.1"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                value="{{ old('size') }}">
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
                                value="{{ old('number') }}">
                            @error('number')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="sun"
                                class="block text-sm font-medium text-gray-700">{{ __('Sol') }}</label>
                            <select name="sun" id="sun" placeholder="{{ __('...') }}"
                                class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                <option value="morning" {{ old('sun') == 'morning' ? 'selected' : '' }}>
                                    {{ __('Sol da manhã') }}</option>
                                <option value="afternoon" {{ old('sun') == 'afternoon' ? 'selected' : '' }}>
                                    {{ __('Sol da tarde') }}</option>
                                <option value="any" {{ old('sun') == 'any' ? 'selected' : '' }}>
                                    {{ __('Indiferente') }}</option>
                            </select>
                            @error('sun')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-2">
                            <label for="price"
                                class="block text-sm font-medium text-gray-700">{{ __('Valor (R$)') }}</label>
                            <input type="number" name="price" id="price" autocomplete="given-pre_keys_monthly"
                                placeholder="Ex.: 100000,00" step="1"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                value="{{ old('price') }}">
                            @error('price')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="floor"
                                class="block text-sm font-medium text-gray-700">{{ __('Andar') }}</label>
                            <select name="floor" id="sun" placeholder="{{ __('...') }}"
                                class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                <option value="0" {{ old('floor') == '0' ? 'selected' : '' }}>
                                    {{ __('Térreo') }}</option>
                                @for ($i = 1; $i <= 30; $i++)
                                    <option value="{{ $i }}" {{ old('floor') == $i ? 'selected' : '' }}>
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
                            <input type="number" name="final_number" id="final_number" autocomplete="given-final_number"
                                placeholder="Ex.: 2" step="1"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                value="{{ old('final_number') }}">
                            @error('final_number')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-12 sm:col-span-1">
                            <label for="parking_lots"
                                class="block text-sm font-medium text-gray-700">{{ __('Vagas') }}</label>
                            <input type="number" name="parking_lots" id="final_number"
                                autocomplete="given-parking_lots" placeholder="Ex.: 2" step="1"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                value="{{ old('parking_lots') }}">
                            @error('parking_lots')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-12 md:col-span-12">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700">{{ __('Descritivo') }}</label>
                            <x-tinymce-editor id="description" name="description" rows="6"
                                :content="old('description')"
                                class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </x-tinymce-editor>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                    <a href="{{ route('products.unit_groups.index', $product->id) }}"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('Voltar') }}</a>
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('Criar') }}
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
            });
        </script>
    @endsection
</x-app-layout>
