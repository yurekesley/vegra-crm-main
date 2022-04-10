<x-app-layout>
    <x-slot name="header">
        {{ __('Unidades') }}
    </x-slot>

    <div class="px-6 py-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-lg">
        <div class="flex flex-col items-center justify-end md:flex-row">
            <a href="{{ route('products.units.excel', ['product' => $product->id]) }}"
                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-green-700 border border-transparent rounded-md hover:bg-green-800 focus:outline-none disabled:opacity-25">{{ 'Importar / Atualizar via Excel' }}</a>
            <a href="{{ route('products.index') }}"
                class="inline-flex justify-center px-4 py-2 ml-4 text-sm font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                {{ __('Voltar') }}</a>
        </div>
    </div>

    <div class="py-12">
        <div class="w-full mx-auto">
            <div class="grid items-start grid-cols-3 gap-4 lg:grid-cols-5 lg:gap-8">
                <div class="grid grid-cols-1 gap-4 lg:col-span-2">
                    <section aria-labelledby="section-2-title">
                        <h2 class="sr-only" id="section-2-title">Section title</h2>
                        <div class="overflow-hidden bg-white border border-gray-300 rounded-lg shadow-lg">
                            <div class="flex items-center justify-between p-6">
                                <h2 class="flex mr-4 text-xl font-semibold leading-tight text-gray-800">
                                    {{ __('Blocos') }}
                                </h2>
                                <form class="flex-1 form-inline" method="GET">
                                    <div class="form-group">
                                        <div>
                                            <div class="flex rounded-md shadow-sm max-w-7xl">
                                                <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                                    <input type="text" name="filter_blocks" id="filter_blocks"
                                                        value="{{ $filter_blocks }}"
                                                        class="block w-full border-gray-300 rounded-none focus:ring-red-500 focus:border-red-500 rounded-l-md sm:text-sm"
                                                        placeholder="{{ __('Informe um conteúdo para filtro') }}">
                                                </div>
                                                <button type="submit"
                                                    class="relative inline-flex items-center px-4 py-2 -ml-px space-x-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-r-md bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-red-500 focus:red-indigo-500">
                                                    <span>{{ __('Filtrar') }}<i class="fas fas-sort"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <a href="{{ route('products.unit_groups.create', $product->id) }}"
                                    class="flex items-center justify-center px-4 py-2 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none disabled:opacity-25">{{ 'Criar' }}</a>
                            </div>
                            <hr />
                            <div>
                                <ul role="list" class="divide-y divide-gray-200">
                                    @if ($unitGroups->isEmpty())
                                        <li>
                                            <div
                                                class="flex justify-center px-6 py-8 text-sm font-medium text-gray-900 hover:bg-gray-50 whitespace-nowrap">
                                                {{ __('Nenhuma bloco encontrado') }}
                                            </div>
                                        </li>
                                    @endif
                                    @foreach ($unitGroups as $unitGroup)
                                        <li>
                                            <div class="block hover:bg-gray-50">
                                                <div class="px-4 sm:px-6">
                                                    <div class="flex items-center justify-between">
                                                        <p class="py-6 text-sm font-bold text-gray-800 truncate">
                                                            {{ $unitGroup->getTranslatedType() }}
                                                            {{ $unitGroup->number }}
                                                        </p>
                                                        <div class="flex items-center flex-shrink-0 h-full ml-2">
                                                            <a href="{{ route('products.unit_groups.edit', [$product->id, $unitGroup->id]) }}"
                                                                title="{{ __('Editar') }}"
                                                                class="inline-flex items-center h-full px-4 py-2 ml-4 text-sm font-medium text-yellow-700 bg-yellow-100 border border-transparent rounded-md hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route('products.unit_groups.destroy', [$product->id, $unitGroup->id]) }}"
                                                                method="POST" data-id="{{ $unitGroup->id }}"
                                                                data-description="{{ $unitGroup->number }}"
                                                                data-msg="{{ __('Deseja remover o ') . $unitGroup->getTranslatedType() . ' ' }}"
                                                                class="delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" title="{{ __('Remover') }}"
                                                                    class="inline-flex items-center h-full px-4 py-2 ml-2 text-sm font-medium text-red-700 bg-red-100 border border-transparent rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </form>
                                                            <a href="{{ route('products.unit_groups.index', [$product->id,'selected_unit_group_id' =>$selected_unit_group_id == null || $selected_unit_group_id != $unitGroup->id ? $unitGroup->id : null]) }}"
                                                                title="{{ __('Selecionar ') . $unitGroup->getTranslatedType() }}"
                                                                class="inline-flex items-center h-full px-4 py-2 ml-2 text-sm font-medium text-blue-700 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                <i
                                                                    class="{{ $selected_unit_group_id == $unitGroup->id ? 'fas fa-check-square' : 'far fa-square' }}"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                </d>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Right column -->
                <div class="grid grid-cols-1 gap-4 lg:col-span-3">
                    <section aria-labelledby="section-1-title">
                        <h2 class="sr-only" id="section-1-title">Section title</h2>
                        <div class="overflow-hidden bg-white border border-gray-300 rounded-lg shadow-lg">
                            <div class="flex items-center justify-between p-6">
                                <h2 class="flex mr-4 text-xl font-semibold leading-tight text-gray-800">
                                    {{ __('Unidades') }} -
                                    {{ $unit_group != null ? $unit_group->getTranslatedType() . ' ' . $unit_group->number : 'Todas' }}
                                </h2>
                                <form class="flex-1 form-inline" method="GET">
                                    <div class="form-group">
                                        <div>
                                            <div class="flex rounded-md shadow-sm max-w-7xl">
                                                <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                                    <input type="text" name="filter_blocks" id="filter_blocks"
                                                        value="{{ $filter_blocks }}"
                                                        class="block w-full border-gray-300 rounded-none focus:ring-red-500 focus:border-red-500 rounded-l-md sm:text-sm"
                                                        placeholder="{{ __('Informe um conteúdo para filtro') }}">
                                                </div>
                                                <button type="submit"
                                                    class="relative inline-flex items-center px-4 py-2 -ml-px space-x-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-r-md bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-red-500 focus:red-indigo-500">
                                                    <span>{{ __('Filtrar') }}<i class="fas fas-sort"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <a href="{{ route('products.units.create', $product->id) }}"
                                    class="flex items-center justify-center px-4 py-2 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none disabled:opacity-25">{{ 'Criar' }}</a>
                            </div>
                            <div>
                                <hr />
                                <div>
                                    <ul role="list" class="divide-y divide-gray-200">
                                        @if ($units->isEmpty())
                                            <li>
                                                <div
                                                    class="flex justify-center px-6 py-8 text-sm font-medium text-gray-900 hover:bg-gray-50 whitespace-nowrap">
                                                    {{ $unit_group == null? __('Nenhuma unidade encontrada'): __('Nenhum unidade encontrada no') . ' ' . $unit_group->getTranslatedType() . ' ' . $unit_group->number }}
                                                </div>
                                            </li>
                                        @endif
                                        @foreach ($units as $unit)
                                            <li>
                                                <div class="flex hover:bg-gray-50">
                                                    <div class="flex-1 px-4 py-4 sm:px-6">
                                                        <div class="flex items-center justify-between">
                                                            <p class="text-sm font-bold text-gray-800 truncate">
                                                                {{ __('Tipo / Bloco / Torre') }}:
                                                                {{ $unit->unit_group->getTranslatedType() . ' ' . $unit->unit_group->number }}
                                                            </p>
                                                            <div class="flex flex-shrink-0 ml-2">
                                                                <p
                                                                    class="inline-flex px-2 py-1 text-sm font-semibold leading-5 text-white bg-gray-600 rounded-full">
                                                                    R$ {{ number_format($unit->price, 2, ',', '.') }}
                                                                </p>
                                                                <p
                                                                    class="inline-flex px-2 py-1 ml-2 text-sm font-semibold leading-5 text-white bg-{{ $unit->getStatusColor() }}-600 rounded-full">
                                                                    {{ $unit->getTranslatedStatus() }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 sm:flex sm:justify-between">
                                                            <div class="sm:flex">
                                                                <p class="flex items-center text-sm text-gray-500">
                                                                    <strong>{{ __('Andar') }}</strong>:
                                                                    {{ $unit->floor == 0 ? 'Térreo' : $unit->floor . 'º andar' }}
                                                                </p>
                                                                <p
                                                                    class="flex items-center mt-2 text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                                                    <strong>{{ __('Número') }}</strong>:
                                                                    {{ $unit->number }}
                                                                </p>
                                                                <p
                                                                    class="flex items-center mt-2 text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                                                    <strong>{{ __('Sol') }}</strong>:
                                                                    {{ $unit->getTranslatedSun() }}
                                                                </p>
                                                            </div>
                                                            <div
                                                                class="flex items-center mt-2 text-sm text-gray-500 sm:mt-0">

                                                                <p>
                                                                    <strong>{{ __('Tamanho') }}</strong>:
                                                                    {{ $unit->size }} m²
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="flex justify-end gap-3 px-6 py-4 text-sm font-bold whitespace-nowrap">
                                                        <a href="{{ route('products.units.edit', [$product->id, $unit->id]) }}"
                                                            title="{{ __('Editar') }}"
                                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-yellow-700 bg-yellow-100 border border-transparent rounded-md hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('products.units.destroy', [$product->id, $unit->id]) }}"
                                                            method="POST" data-id="{{ $unit->id }}"
                                                            data-description="{{ $unit->number }}"
                                                            data-msg="{{ __('Deseja remover a unidade ') }}"
                                                            class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="{{ __('Remover') }}"
                                                                class="inline-flex items-center h-full px-4 py-2 text-sm font-medium text-red-700 bg-red-100 border border-transparent rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden text-red-800 bg-red-200"></div>
    <div class="hidden text-gray-800 bg-gray-200"></div>
    <div class="hidden text-green-800 bg-green-200"></div>
    <div class="hidden text-yellow-800 bg-yellow-200"></div>
    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', (e) => {

            });
        </script>
    @endsection
</x-app-layout>
