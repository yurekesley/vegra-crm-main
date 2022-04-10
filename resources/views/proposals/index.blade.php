<x-app-layout>
    <x-slot name="header">
        {{ __('Propostas') }}
    </x-slot>

    <div class="px-6 py-4 mt-2 mb-4 bg-white border border-gray-300 rounded-lg shadow-lg">
        <div class="flex flex-col items-center justify-between md:flex-row">
            <form class="w-full form-inline" method="GET">
                <div class="w-full form-group">
                    <div class="flex flex-col gap-6 md:flex-row">
                        <div class="flex rounded-md shadow-sm max-w-7xl">
                            <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                <select name="status" id="status" placeholder="{{ __('Selecione um status') }}"
                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                    <option @if ($status == 'open') selected @endif }} value="open">
                                        {{ __('Abertas') . ' (' . $open . ')' }}</option>
                                    <option @if ($status == 'approved') selected @endif value="approved">
                                        {{ __('Aprovados') . ' (' . $approved . ')' }}</option>
                                    <option @if ($status == 'rejected') selected @endif value="rejected">
                                        {{ __('Reprovadas') . ' (' . $rejected . ')' }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-1 rounded-md shadow-sm max-w-7xl">
                            <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                <select name="product_id" id="product_id"
                                    placeholder="{{ __('Selecione um produto') }}"
                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                    <option value="null">{{ __('Todos os Produtos') }}</option>
                                    @foreach ($products as $product)
                                        <option {{ $product_id == $product->id ? 'selected' : '' }}
                                            value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-1 rounded-md shadow-sm max-w-7xl">
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
        </div>
    </div>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" colspan="7" class="py-2 text-center bg-{{ $status_color }}-400">
                        {{ __($proposal_status) }} ({{ $proposals->count() }})
                    </th>
                </tr>
            </thead>
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                        @sortablelink('product.name', __('Produto'))
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                        @sortablelink('unit', __('Unidade'))
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                        @sortablelink('partner.name', __('Imobiliária'))
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                        @sortablelink('broker.name', __('Corretor'))
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                        @sortablelink('name', __('Cliente'))
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                        @sortablelink('created_at', __('Data'))
                    </th>
                    <th scope="col" class="relative px-6 py-3">

                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if ($proposals->isEmpty())
                    <tr class="bg-white">
                        <td class="px-6 py-8 text-sm font-medium text-center text-gray-900 whitespace-nowrap"
                            colspan="6">
                            {{ __('Nenhuma proposta encontrada.') }}
                        </td>
                    </tr>
                @endif
                @foreach ($proposals as $proposal)
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                            {{ $proposal->product->name }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                            {{ $proposal->unit->unit_group->getTranslatedType() .' ' .$proposal->unit->unit_group->number .' / ' .$proposal->unit->number }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                            {{ $proposal->broker->partner?->name ?? 'Corretor interno' }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                            {{ $proposal->broker->name }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                            {{ $proposal->prospect->name }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                            {{ $proposal->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="flex px-6 py-4 text-sm font-bold whitespace-nowrap justify-evenly">
                            <a href="#" title="Visualizar proposta" target="_blank"
                                data-id="{{ $proposal->id }}"
                                data-url="{{ route('proposals.show', $proposal->id) }}"
                                class="inline-flex items-center px-4 py-3 text-sm font-medium text-indigo-700 bg-indigo-100 border border-transparent rounded-md view_proposal hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-file"></i>
                            </a>
                            @if (($proposal->status == 'open' || $proposal->status == 'rejected') && auth()->user()->access_profile?->permissions->where('key', 'proposals_status')->isNotEmpty())
                                <form method="POST"
                                    action="{{ route('proposals.approve', ['proposal' => $proposal->id]) }}">
                                    @csrf
                                    <button type="submit" title="Aprovar proposta"
                                        class="inline-flex items-center px-4 py-3 text-sm font-medium text-green-700 bg-green-100 border border-transparent rounded-md hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @endif
                            @if (($proposal->status == 'open' || $proposal->status == 'approved') && auth()->user()->access_profile?->permissions->where('key', 'proposals_status')->isNotEmpty())
                                <form method="POST"
                                    action="{{ route('proposals.reject', ['proposal' => $proposal->id]) }}">
                                    @csrf
                                    <button type="submit" title="Reprovar proposta"
                                        class="inline-flex items-center px-4 py-3 text-sm font-medium text-red-700 bg-red-100 border border-transparent rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </form>
                            @endif
                            @if (($proposal->status == 'rejected' || $proposal->status == 'approved') && auth()->user()->access_profile?->permissions->where('key', 'proposals_status')->isNotEmpty())
                                <form method="POST"
                                    action="{{ route('proposals.open', ['proposal' => $proposal->id]) }}">
                                    @csrf
                                    <button type="submit" title="Reabrir proposta"
                                        class="inline-flex items-center px-4 py-3 text-sm font-medium text-yellow-700 bg-yellow-100 border border-transparent rounded-md hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                        <i class="fas fa-hourglass"></i>
                                    </button>
                                </form>
                            @endif
                            @if (auth()->user()->access_profile?->permissions->where('key', 'proposals_delete')->isNotEmpty())
                                <form method="POST"
                                    action="{{ route('proposals.destroy', ['proposal' => $proposal->id]) }}"
                                    class="delete-form" data-id="{{ $proposal->id }}"
                                    data-description="{{ $proposal->prospect->name }} ({{ $proposal->unit->unit_group->getTranslatedType() .' ' .$proposal->unit->unit_group->number .' / ' .$proposal->unit->number }})"
                                    data-msg="{{ __('Deseja remover a proposta do cliente ') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Excluir proposta"
                                        class="inline-flex items-center px-4 py-3 text-sm font-medium text-red-700 bg-red-100 border border-transparent rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $proposals->links('pagination::tailwind') }}
    </div>
    <div class="hidden bg-green-400"></div>
    <div class="hidden bg-yellow-400"></div>
    <div class="hidden bg-red-400"></div>
    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', (e) => {
                $(document).on('click', '.view_proposal', function (e) {
                    var id = $(this).data('id');
                    var url = $(this).data('url');
                    window.open(url, `proposal_view`,
                        "resizable=no, toolbar=no, scrollbars=no, menubar=no, status=no, directories=no")
                });
            });
        </script>
    @endsection
</x-app-layout>
