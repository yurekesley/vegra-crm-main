<x-app-layout>
    <x-slot name="header">
        {{ __('LGPD - Imobiliárias e Corretores') }}
    </x-slot>

    <div class="overflow-hidden bg-white border border-gray-300 rounded-lg shadow-lg">
        <form method="POST" action="{{ route('gdpr.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="space-y-8 sm:space-y-5">
                        <div>
                            <div>
                                <h3 class="text-lg font-medium leading-6 text-gray-900">
                                    Parceiros
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Esta informação é apresentada a novos parceiros que irão se registrar, como
                                    termos de uso de aceite obrigatório.
                                </p>
                                <hr class="w-full mt-2" />
                                <div class="w-full sm:items-start sm:pt-5">
                                    <div class="mt-1 sm:mt-0">
                                        <x-tinymce-editor id="real_state_registration" name="real_state_registration"
                                            rows="6"
                                            :content="old('real_state_registration') ?? ($real_state_registration != null ? $real_state_registration->content : '')"
                                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        </x-tinymce-editor>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="pt-6 text-lg font-medium leading-6 text-gray-900">
                                    Corretores
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Esta informação é apresentada a novos corretores que irão se registrar, como
                                    termos de uso de aceite obrigatório.
                                </p>
                                <hr class="w-full mt-2" />
                                <div class="w-full sm:items-start sm:pt-5">
                                    <div class="mt-1 sm:mt-0">
                                        <x-tinymce-editor id="broker_registration" name="broker_registration" rows="6"
                                            :content="old('broker_registration') ?? ($broker_registration != null ? $broker_registration->content : '')"
                                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        </x-tinymce-editor>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="pt-6 text-lg font-medium leading-6 text-gray-900">
                                    Política de Privacidade
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Este conteúdo ou link é visível para qualquer usuário do sistema, inclusive
                                    clientes.
                                </p>
                                <hr class="w-full mt-2" />
                                <div class="w-full sm:items-start sm:pt-5">
                                    <div class="mt-1 sm:mt-0">
                                        <x-tinymce-editor id="privacy" name="privacy" rows="6"
                                            :content="old('broker_registration') ?? ($privacy != null ? $privacy->content : '')"
                                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        </x-tinymce-editor>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-6 overflow-hidden bg-white border border-gray-300 rounded-lg shadow-lg">
        <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Produtos
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Nesta seção informações sobre LGDP de cada produto poderão ser atualizadas para clientes
                        no processo de cadastro ou propostas.
                        as prospects or doing proposals.
                    </p>
                    <hr class="w-full pb-6 mt-2" />
                    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        @foreach ($products as $product)
                            <li
                                class="col-span-1 bg-[url('https://images.unsplash.com/photo-1516156008625-3a9d6067fab5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=300&q=80')] bg-cover rounded-lg shadow-md divide-y divide-gray-200">
                                <div
                                    class="flex items-center justify-between w-full p-6 pb-12 space-x-6 bg-black bg-opacity-50 rounded-t-md">
                                    <div class="flex-1 truncate">
                                        <div class="flex items-center justify-between space-x-3">
                                            <h3
                                                class="text-sm font-bold text-white truncate drop-shadow-md shadow-gray-200">
                                                {{ $product->name }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex -mt-px bg-white divide-x divide-gray-150 rounded-b-md">
                                        <div class="flex flex-1 w-0 rounded-b-lg">
                                            <a href="{{ route('products.gdpr.index', $product->id) }}"
                                                class="relative inline-flex items-center justify-center flex-1 w-0 py-4 text-sm font-medium text-red-700 rounded-b-lg hover:text-white hover:bg-red-700">
                                                <span class="ml-1">LGPD</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
