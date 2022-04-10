<x-app-layout>
    <x-slot name="header">
        {{ __('Códigos de propostas') }}
    </x-slot>

    <div class="px-6 py-4 mt-2 mb-4 bg-white border border-gray-300 rounded-lg shadow-lg">
        <div class="flex flex-col items-center justify-between md:flex-row">
            <form class="flex-1 form-inline" method="GET">
                <div class="form-group">
                    <div>
                        <div class="flex rounded-md shadow-sm">
                            <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                <select id="product_id" name="product_id" id="access_profile"
                                    placeholder="{{ __('Selecione um produto') }}"
                                    class="block w-full h-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-l-md">
                                    <option {{ $product_id == null ? 'selected' : '' }} value="">Todos os produtos
                                    </option>
                                    @foreach ($products as $p)
                                        @if ($product_id == $p->id)
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
        </div>
    </div>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('product.name', __('Produto'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('broker.name', __('Corretor'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('prospect.name', __('Cliente'))
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-sm font-semibold tracking-wider text-center text-gray-500 uppercase whitespace-nowrap">
                        {{ __('Disponível') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-sm font-semibold tracking-wider text-center text-gray-500 uppercase whitespace-nowrap">
                        {{ __('Utilizado') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-sm font-semibold tracking-wider text-center text-gray-500 uppercase whitespace-nowrap">
                        {{ __('Código') }}
                    </th>
                    <th scope="col"
                        class="relative w-0 px-6 py-3 text-sm font-semibold tracking-wider text-center text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Ações') }}
                    </th>
                </tr>
            </thead>
            <tbody class="overflow-x-auto bg-white divide-y divide-gray-200">
                @if ($codes->isEmpty())
                    <tr class="bg-white">
                        <td class="px-6 py-8 text-sm font-medium text-center text-gray-900 whitespace-nowrap"
                            colspan="6">
                            {{ __('Nenhum código de proposta encontrado.') }}
                        </td>
                    </tr>
                @endif
                @foreach ($codes as $code)
                    <form action="{{ route('codes.update', ['code' => $code->id, 'filter' => 'filter']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <tr class="bg-white">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 rounded-b-lg whitespace-nowrap">
                                {{ $code->product->name }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 rounded-b-lg whitespace-nowrap">
                                {{ $code->broker->name }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 rounded-b-lg whitespace-nowrap">
                                {{ $code->prospect->name }}
                            </td>
                            <td class="w-1 px-6 py-4 text-sm font-medium text-gray-900 rounded-b-lg whitespace-nowrap">
                                <x-input id="available" class="block w-full mt-1 text-center" type="number"
                                    name="available" :value="old('available') ?? $code->available" required />
                            </td>
                            <td
                                class="w-1 px-6 py-4 text-sm font-medium text-center text-gray-900 rounded-b-lg whitespace-nowrap">
                                {{ $code->used }}
                            </td>
                            <td
                                class="w-1 px-6 py-4 text-sm font-bold text-center text-gray-900 rounded-b-lg whitespace-nowrap">
                                {{ $code->code }}
                            </td>
                            <td class="px-6 py-4 text-sm font-bold rounded-b-lg whitespace-nowrap">
                                <div class="flex justify-end gap-4">
                                    <button type="submit" title="{{ __('Alterar') }}"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-yellow-700 bg-yellow-100 border border-transparent rounded-lg hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                        <i class="mr-2 fas fa-edit"></i> {{ __('Alterar') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </form>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $codes->links('pagination::tailwind') }}
    </div>
</x-app-layout>
