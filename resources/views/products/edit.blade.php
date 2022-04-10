<x-app-layout>
    <x-slot name="header">
        {{ __('Ediar produto') }}
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nome') }}</label>
                            <input type="text" name="name" id="name" autocomplete="given-name"
                                placeholder="Informe um nome para o produto"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                value="{{ old('name') ?? $product->name }}" autofocus>
                            @error('name')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-1">
                            <label for="slug"
                                class="block text-sm font-medium text-gray-700">{{ __('Chave Web') }}</label>
                            <input type="text" name="slug" id="slug" autocomplete="given-slug"
                                placeholder="Vamos sugerir a chave com base no nome" readonly
                                class="block w-full mt-1 text-gray-500 bg-gray-200 border-gray-300 rounded-md shadow-sm sm:text-sm"
                                value="{{ old('slug') ?? $product->slug }}" autofocus>
                            @error('slug')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 md:col-span-2">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block w-full mt-1" type="email" name="email"
                                :value="$product->email" required />
                        </div>
                        <div class="col-span-6 md:col-span-1">
                            <x-label for="phone" :value="__('Telefone')" />

                            <x-input id="phone" class="block w-full mt-1 phone-mask" type="text" name="phone"
                                :value="old('phone') ?? $product->phone" required autofocus />
                        </div>
                        <hr class="col-span-6 mt-2" />
                        <h2 class="col-span-6 mb-2 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Comissões') }}
                        </h2>
                        <div class="col-span-6 md:col-span-1">
                            <x-label for="house_commission_value" :value="__('% Equipe Gestora')" />

                            <x-input id="house_commission_value" class="block w-full mt-1" type="number" step=".01"
                                placeholder="00,00" name="house_commission_value"
                                :value="$product->house_commission_value" required />
                        </div>
                        <div class="col-span-6 md:col-span-1">
                            <x-label for="partner_commission_value" :value="__('% Equipe Parceiro')" />

                            <x-input id="partner_commission_value" class="block w-full mt-1" type="number" step="0.01"
                                placeholder="00,00" name="partner_commission_value"
                                :value="$product->partner_commission_value" required />
                        </div>
                        <div class="col-span-6 md:col-span-1">
                            <label for="commission_payer"
                                class="block text-sm font-medium text-gray-700">{{ __('Quem paga') }}</label>
                            <select name="commission_payer" id="commission_payer"
                                placeholder="{{ __('Selecione um pagador') }}"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                <option value="incorporator" @if ($product->commission_payer == 'incorporator') selected @endif>
                                    Incorporadora</option>
                                <option value="customer" @if ($product->commission_payer == 'customer') selected @endif>Cliente
                                </option>
                            </select>
                            @error('commission_payer')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 md:col-span-1">
                            <label for="show_commission_on_proposals"
                                class="block text-sm font-medium text-gray-700">{{ __('Exibir valor nas propostas') }}</label>
                            <select name="show_commission_on_proposals" id="show_commission_on_proposals"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                <option value="true" @if ($product->show_commission_on_proposals) selected @endif>Sim</option>
                                <option value="false" @if (!$product->show_commission_on_proposals) selected @endif>Não</option>
                            </select>
                            @error('show_commission_on_proposals')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <hr class="col-span-6 mt-2" />
                        <h2 class="col-span-6 mb-2 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Configurações') }}
                        </h2>
                        <div class="col-span-6 md:col-span-1">
                            <label for="show_for_customers"
                                class="block text-sm font-medium text-gray-700">{{ __('Situação') }}</label>
                            <select name="show_for_customers" id="show_for_customers"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                <option value="true" @if ($product->show_for_customers) selected @endif>Ativo</option>
                                <option value="false" @if (!$product->show_for_customers) selected @endif>Inativo</option>
                            </select>
                            @error('show_for_customers')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 md:col-span-1">
                            <label for="enable_prospects"
                                class="block text-sm font-medium text-gray-700">{{ __('Habilitar Pastas') }}</label>
                            <select name="enable_prospects" id="enable_prospects"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                <option value="true" @if ($product->enable_prospects) selected @endif>Sim</option>
                                <option value="false" @if (!$product->enable_prospects) selected @endif>Não</option>
                            </select>
                            @error('enable_prospects')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 md:col-span-1">
                            <label for="sort_prospects"
                                class="block text-sm font-medium text-gray-700">{{ __('Informar ordem de Pastas') }}</label>
                            <select name="sort_prospects" id="sort_prospects"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                <option value="true" @if ($product->sort_prospects) selected @endif>Sim</option>
                                <option value="false" @if (!$product->sort_prospects) selected @endif>Não</option>
                            </select>
                            @error('sort_prospects')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-6 md:col-span-1">
                            <label for="allow_customer_without_broker"
                                class="block text-sm font-medium text-gray-700">{{ __('Cliente sem Corretor') }}</label>
                            <select name="allow_customer_without_broker" id="allow_customer_without_broker"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                <option value="true" @if ((old('allow_customer_without_broker') ?? $product->allow_customer_without_broker)) selected @endif>Permitir
                                </option>
                                <option value="false" @if (!(old('allow_customer_without_broker') ?? $product->allow_customer_without_broker)) selected @endif>Não permitir
                                </option>
                            </select>
                            @error('allow_customer_without_broker')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="hidden col-span-6 md:col-span-2" id="container_fake_broker">
                            <x-label for="fake_broker" :value="__('Corretor Geral')" />

                            <x-input id="fake_broker" class="block w-full mt-1" type="email" name="fake_broker"
                                :value="old('fake_broker') ?? $fakeBroker?->email" />
                        </div>
                        <div class="col-span-6 md:col-span-1">
                            <label for="allow_proposals"
                                class="block text-sm font-medium text-gray-700">{{ __('Habilitar propostas') }}</label>
                            <select name="allow_proposals" id="show_commission_on_proposals"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                <option value="true" @if ($product->allow_proposals) selected @endif>Sim</option>
                                <option value="false" @if (!$product->allow_proposals) selected @endif>Não</option>
                            </select>
                            @error('allow_proposals')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <hr class="col-span-6 mt-2" />
                        <h2 class="col-span-6 mb-2 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Imagens') }}
                        </h2>
                        <div class="col-span-6 md:col-span-2">
                            <label
                                class="inline-block mb-2 text-gray-700">{{ __('Logo do Produto (Clique para alterar)') }}</label>
                            <div class="flex items-center justify-center w-full">
                                <label
                                    class="flex flex-col w-full h-32 cursor-pointer hover:bg-gray-100 hover:border-gray-300">
                                    <div class="relative flex flex-col items-center justify-center pt-7">
                                        <img id="preview_logo" class="absolute inset-0 object-contain w-full h-32"
                                            {{ $product->logo_url != null ? 'src=' . $product->logo_url . '' : '' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-12 h-12 text-gray-400 group-hover:text-gray-600"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                            Selecionar imagem (jpg, png)</p>
                                    </div>
                                    <input id="logo" name="logo" type="file" class="opacity-0 image-upload"
                                        accept="image/*" />
                                </label>
                            </div>
                        </div>
                        <hr class="col-span-6 mt-2" />
                        <h2 class="col-span-6 mb-2 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Textos informativos') }}
                        </h2>
                        <div class="col-span-6 md:col-span-6">
                            <label for="welcome_text"
                                class="block text-sm font-medium text-gray-700">{{ __('Texto de Boas Vindas') }}</label>
                            <x-tinymce-editor id="welcome_text" name="welcome_text" rows="6"
                                :content="old('welcome_text') ?? $product->welcome_text"
                                class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </x-tinymce-editor>
                        </div>
                        <div class="col-span-6 md:col-span-6">
                            <label for="qualification_text"
                                class="block text-sm font-medium text-gray-700">{{ __('Texto de Qualificação') }}</label>
                            <x-tinymce-editor id="qualification_text" name="qualification_text" rows="6"
                                :content="old('qualification_text') ?? $product->qualification_text"
                                class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </x-tinymce-editor>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                    <a href="{{ route('products.index') }}"
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
                $('#allow_customer_without_broker').on('change', function() {
                    if ($('#allow_customer_without_broker option:selected').val() == 'true') {
                        $('#container_fake_broker').removeClass('hidden');
                    } else {
                        $('#container_fake_broker').addClass('hidden');
                        $('#fake_broker').val('');
                    }
                });

                if ($('#allow_customer_without_broker option:selected').val() == 'true') {
                    $('#container_fake_broker').removeClass('hidden');
                } else {
                    $('#container_fake_broker').addClass('hidden');
                    $('#fake_broker').val('');
                }
            });
        </script>
    @endsection
</x-app-layout>
