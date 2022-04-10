<x-app-layout>
    <x-slot name="header">
        {{ __('Produtos') }}
    </x-slot>

    <div class="px-6 py-4 mt-2 mb-4 bg-white border border-gray-300 rounded-lg shadow-lg">
        <div class="flex flex-col items-center justify-between md:flex-row">
            <form class="flex-1 form-inline" method="GET">
                <div class="form-group">
                    <div>
                        <div class="flex rounded-md shadow-sm">
                            <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                <input type="text" name="filter" id="filter" value="{{ $filter }}"
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
            <a href="{{ route('products.create') }}"
                class="flex items-center justify-center px-4 py-2 ml-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-700 border border-transparent rounded-md hover:bg-red-800 focus:outline-none disabled:opacity-25">{{ 'Criar' }}</a>
        </div>
    </div>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('name', __('Produto'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('slug', __('Chave Web'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Pastas') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('# pastas') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-sm font-semibold tracking-wider text-center text-gray-500 uppercase whitespace-nowrap">
                        {{ __('Propostas') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('# propostas') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Situação') }}
                    </th>
                    <th scope="col"
                        class="relative w-0 px-6 py-3 text-sm font-semibold tracking-wider text-center text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Ações') }}
                    </th>
                </tr>
            </thead>
            <tbody class="overflow-x-auto bg-white divide-y divide-gray-200">
                @if ($products->isEmpty())
                    <tr class="bg-white">
                        <td class="px-6 py-8 text-sm font-medium text-center text-gray-900 whitespace-nowrap"
                            colspan="6">
                            {{ __('Nenhum produto encontrado.') }}
                        </td>
                    </tr>
                @endif
                @foreach ($products as $product)
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                            {{ $product->name }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                            {{ $product->slug }}
                        </td>
                        <td class="w-1 px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            @if ($product->enable_prospects)
                                <span
                                    class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">sim
                                @else
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">não
                            @endif
                            </span>
                        </td>
                        <td class="w-1 px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            0
                        </td>
                        <td class="w-1 px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            @if ($product->allow_proposals)
                                <span
                                    class="inline-flex px-2 text-sm font-semibold leading-5 text-green-800 bg-green-100 rounded-full">sim
                                @else
                                    <span
                                        class="inline-flex px-2 text-sm font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">não
                            @endif
                            </span>
                        </td>
                        <td class="w-1 px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            0
                        </td>
                        <td class="w-3 px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            @if ($product->show_for_customers)
                                <span
                                    class="inline-flex px-2 text-sm font-semibold leading-5 text-green-800 bg-green-100 rounded-full">visível
                                @else
                                    <span
                                        class="inline-flex px-2 text-sm font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">inativo
                            @endif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-bold rounded-b-lg whitespace-nowrap">
                            <div class="flex justify-end gap-4">
                                <a href="{{ route('products.unit_groups.index', $product->id) }}" title="{{ __('Unidades') }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-700 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <i class="mr-2 fas fa-th"></i>{{ __('Unidades') }}
                                </a>
                                <a href="{{ route('products.edit', $product->id) }}" title="{{ __('Editar') }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-yellow-700 bg-yellow-100 border border-transparent rounded-lg hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                    <i class="mr-2 fas fa-edit"></i> {{ __('Editar') }}
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    class="delete-form" data-id="{{ $product->id }}"
                                    data-description="{{ $product->name }}"
                                    data-msg="{{ __('Deseja remover o produto ') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="{{ __('Remover') }}"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-700 bg-red-100 border border-transparent rounded-lg hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <i class="mr-2 fas fa-times"></i> {{ __('Remover') }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $products->links('pagination::tailwind') }}
    </div>
    <div class="hidden text-red-800 bg-red-200"></div>
    <div class="hidden text-gray-800 bg-gray-200"></div>
    <div class="hidden text-green-800 bg-green-200"></div>
    <div class="hidden text-yellow-800 bg-yellow-200"></div>
</x-app-layout>
