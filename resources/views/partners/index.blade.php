<x-app-layout>
    <x-slot name="header">
        {{ __('Parceiros') }}
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
        </div>
    </div>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Foto') }}
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('email', __('Email'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('name', __('Imobiliária'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('cnpj', __('CNPJ'))
                    </th>
                    <th scope="col"
                        class="px-6 py-4 text-sm font-semibold tracking-wider text-left text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        @sortablelink('creci', __('CRECI'))
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-sm font-semibold tracking-wider text-center text-gray-500 uppercase whitespace-nowrap">
                        @sortablelink('status', __('Situação'))
                    </th>
                    <th scope="col"
                        class="relative w-0 px-6 py-3 text-sm font-semibold tracking-wider text-center text-gray-500 uppercase rounded-t-lg whitespace-nowrap">
                        {{ __('Ações') }}
                    </th>
                </tr>
            </thead>
            <tbody class="overflow-x-auto bg-white divide-y divide-gray-200">
                @if ($partners->isEmpty())
                    <tr class="bg-white">
                        <td class="px-6 py-8 text-sm font-medium text-center text-gray-900 whitespace-nowrap"
                            colspan="6">
                            {{ __('Nenhum parceiro encontrado.') }}
                        </td>
                    </tr>
                @endif
                @foreach ($partners as $partner)
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 rounded-b-lg whitespace-nowrap">
                            <img class="inline-block object-cover rounded-full h-9 w-9" src="{{ $partner->picture_url ?? asset('images/blank-profile-picture.png') }}"
                                alt="{{ $partner->name }} picture" loading="lazy">
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 rounded-b-lg whitespace-nowrap">
                            {{ $partner->email }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 rounded-b-lg whitespace-nowrap">
                            {{ $partner->name }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 rounded-b-lg whitespace-nowrap">
                            {{ $partner->formattedCnpj() }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 rounded-b-lg whitespace-nowrap">
                            {{ $partner->creci }}
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap">
                            <span
                                class="px-2 py-1 text-sm font-semibold leading-5 text-{{ $partner->user->translatedUserStatusColor() }}-800 bg-{{ $partner->user->translatedUserStatusColor() }}-200 rounded-lg">
                                {{ $partner->user->translatedUserStatus() }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-bold rounded-b-lg whitespace-nowrap">
                            <div class="flex justify-end gap-4">
                                @if ($partner->user->user_status == 'pending')
                                    <form id="delete_form" action="{{ route('partners.approve', $partner->id) }}"
                                        method="POST" class="delete-form" data-id="{{ $partner->id }}"
                                        data-description="{{ $partner->name }}"
                                        data-msg="{{ __('Deseja aprovar o parceiro ') }}">
                                        @csrf
                                        <button type="submit" title="{{ __('Aprovar') }}"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-green-700 bg-green-100 border border-transparent rounded-md hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <i class="mr-2 fas fa-check"></i>{{ __('Aprovar') }}
                                        </button>
                                    </form>
                                @endif
                                @if ($partner->user->user_status != 'pending')
                                    <a href="{{ route('partners.brokers.index', $partner->id) }}"
                                        title="{{ __('Corretores') }} ({{ $partner->users_count }})"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-700 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                        <i class="mr-2 fas fa-users"></i>
                                        {{ $partner->getBrokerCountText($partner->users_count) }}
                                    </a>
                                @endif
                                <a href="{{ route('partners.edit', $partner->id) }}" title="{{ __('Editar') }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-yellow-700 bg-yellow-100 border border-transparent rounded-lg hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                    <i class="mr-2 fas fa-edit"></i> {{ __('Editar') }}
                                </a>
                                @if ($partner->user->id != auth()->id())
                                    <form action="{{ route('partners.destroy', $partner->id) }}" method="POST"
                                        class="delete-form" data-id="{{ $partner->id }}"
                                        data-description="{{ $partner->name }}"
                                        data-msg="{{ __('Deseja remover o parceiro ') }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="{{ __('Remover') }}"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-700 bg-red-100 border border-transparent rounded-lg hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <i class="mr-2 fas fa-times"></i> {{ __('Remover') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $partners->links('pagination::tailwind') }}
    </div>
    <div class="hidden text-red-800 bg-red-200"></div>
    <div class="hidden text-gray-800 bg-gray-200"></div>
    <div class="hidden text-green-800 bg-green-200"></div>
    <div class="hidden text-yellow-800 bg-yellow-200"></div>
</x-app-layout>
