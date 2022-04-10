<x-app-layout>
    <x-slot name="header">
        <div id="crud_title">{{ __('Criar bloco') }}</div>
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form action="{{ route('products.unit_groups.store', $product->id) }}" method="POST">
            @csrf
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-1">
                            <label for="type" class="block text-sm font-medium text-gray-700">{{ __('Tipo') }}</label>
                            <select name="type" id="type" placeholder="{{ __('...') }}"
                                class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                <option value="block" {{ old('type') == 'block' ? 'selected' : '' }}>Bloco</option>
                                <option value="tower" {{ old('type') == 'tower' ? 'selected' : '' }}>Torre</option>
                                <option value="village" {{ old('type') == 'village' ? 'selected' : '' }}>Vila</option>
                                <option value="square" {{ old('type') == 'square' ? 'selected' : '' }}>Quadra</option>
                            </select>
                            @error('type')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-1">
                            <label for="number"
                                class="block text-sm font-medium text-gray-700">{{ __('Número') }}</label>
                            <input type="text" name="number" id="number" autocomplete="given-number"
                                placeholder="Ex.: 1, 01, A01..."
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                value="{{ old('number') }}">
                            @error('number')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
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
                $('#type').on('change', function() {
                    var content = "{{ __('Criar ') }}" + $("#type option:selected").text();
                    $('#crud_title').text(content);
                });

                $('#type').trigger('change');
        </script>
    @endsection
</x-app-layout>
