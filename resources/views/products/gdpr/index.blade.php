<x-app-layout>
    <x-slot name="header">
        {{ __('LGPD') . ' - ' . $product->name }}
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form action="{{ route('products.gdpr.store', $product->id) }}" method="POST">
            @csrf
            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="space-y-8 sm:space-y-5">
                        <div>
                            <div>
                                <h3 class="text-lg font-medium leading-6 text-gray-900">
                                    Cadastro de Clientes
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Esta informação será apresentada aos clientes durante cadastro no site (Pastas).
                                </p>
                                <hr class="w-full mt-2" />
                                <div class="w-full sm:items-start sm:pt-5">
                                    <div class="mt-1 sm:mt-0">
                                        <x-tinymce-editor id="customer" name="customer" rows="6"
                                            :content="old('customer') ?? ($customer != null ? $customer->content : '')"
                                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        </x-tinymce-editor>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="pt-6 text-lg font-medium leading-6 text-gray-900">
                                    Cadastro de Sócio / Coparticipante
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Esta informação será apresentada aos clientes em sociedade / coparticipantes
                                    durante cadastro no site (Pastas).
                                </p>
                                <hr class="w-full mt-2" />
                                <div class="w-full sm:items-start sm:pt-5">
                                    <div class="mt-1 sm:mt-0">
                                        <x-tinymce-editor id="coparticipant" name="coparticipant" rows="6"
                                            :content="old('coparticipant') ?? ($coparticipant != null ? $coparticipant->content : '')"
                                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        </x-tinymce-editor>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="pt-6 text-lg font-medium leading-6 text-gray-900">
                                    Propostas
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Esta informação será apresentada durante o preenchimento e envio de propostas.
                                </p>
                                <hr class="w-full mt-2" />
                                <div class="w-full sm:items-start sm:pt-5">
                                    <div class="mt-1 sm:mt-0">
                                        <x-tinymce-editor id="proposal" name="proposal" rows="6"
                                            :content="old('proposal') ?? ($proposal != null ? $proposal->content : '')"
                                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        </x-tinymce-editor>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="pt-6 text-lg font-medium leading-6 text-gray-900">
                                    Texto Legal
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Esta informação será apresentada aos clientes durante uso do sistema.
                                </p>
                                <hr class="w-full mt-2" />
                                <div class="w-full sm:items-start sm:pt-5">
                                    <div class="mt-1 sm:mt-0">
                                        <x-tinymce-editor id="legal_text" name="legal_text" rows="6"
                                            :content="old('legal_text') ?? ($legal_text != null ? $legal_text->content : '')"
                                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        </x-tinymce-editor>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-6 text-right bg-gray-50 sm:px-6">
                    <a href="{{ route('gdpr.index') }}"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Voltar</a>
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Gravar
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
