<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            {{ __('Pasta # ') . $prospect->id . ' - Cliente: ' . $prospect->name }}
            <span
                class="inline-flex items-center px-6 py-1 ml-4 text-xl font-bold text-{{ $prospect->getStatusColor() }}-800 bg-{{ $prospect->getStatusColor() }}-100 rounded-full">
                {{ $prospect->translateStatus(false) }} </span>
        </div>
    </x-slot>

    <div class="overflow-x-auto bg-white border border-gray-300 rounded-lg shadow-lg">
        <form method="POST" action="{{ route('prospects.data.update', $prospect->id) }}" id="form_user_store">
            @csrf
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-12 gap-4">
                        @if (!empty($prospect->notes))
                            <div class="col-span-12">
                                <div class="p-4 rounded-md bg-{{ $prospect->getStatusColor() }}-50">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-{{ $prospect->getStatusColor() }}-400" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 ml-3 md:flex md:justify-between">
                                            <p class="text-sm text-{{ $prospect->getStatusColor() }}-700">{{ $prospect->notes }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <h2 class="col-span-12 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Corretor') }}
                        </h2>
                        <div class="col-span-12 md:col-span-4">
                            <x-label for="broker_name" :value="__('Nome do corretor')" />

                            <x-input id="broker_name" disabled
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="broker_name" :value="$prospect->broker->name" />
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="broker_email" :value="__('Email do corretor')" />

                            <x-input id="broker_email" disabled
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="broker_email" :value="$prospect->broker->email" />
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="broker_creci" :value="__('CRECI')" />

                            <x-input id="broker_creci" disabled
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="broker_creci" :value="$prospect->broker->creci ?? '...'" />
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4">
                        <h2 class="col-span-12 mt-4 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Imobiliária') }}
                        </h2>
                        <div class="col-span-12 md:col-span-4">
                            <x-label for="partner_name" :value="__('Imobiliária')" />

                            <x-input id="partner_name" disabled
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="partner_name" :value="$prospect->broker->partner?->name ?? 'Corretor interno'" />
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="partner_type" :value="__('Tipo da Imobiliária')" />

                            <x-input id="partner_type" disabled
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="partner_type"
                                :value="$prospect->broker->partner?->getTranslatedType() ?? 'Corretor interno'" />
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="partner_type" :value="__('Responsável')" />

                            <x-input id="partner_type" disabled
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="partner_type"
                                :value="$prospect->broker->partner?->responsible ?? 'Corretor interno'" />
                        </div>
                    </div>
                    <hr class="col-span-6 mt-8 mb-4" />
                    <div class="grid grid-cols-12 gap-4">
                        <h2 class="col-span-12 mt-4 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Dados de pré cadastro') }}
                        </h2>
                        <div class="col-span-12 md:col-span-4">
                            <x-label for="name" :value="__('Nome')" />

                            <x-input id="name" class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700"
                                type="text" name="name" :value="old('name') ?? $prospect->name" required autofocus />
                        </div>
                        <!-- CPF -->
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="cpf_cnpj" :value="__('CPF / CNPJ')" />

                            <x-input id="cpf_cnpj" class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700"
                                type="text" name="cpf_cnpj" :value="old('cpf_cnpj') ?? $prospect->cpf_cnpj" required />
                        </div>

                        <!-- Phone Number -->
                        <div class="col-span-12 md:col-span-2">
                            <x-label for="phone" :value="__('Telefone')" />

                            <x-input id="phone" class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700"
                                type="text" name="phone" :value="$prospect->phone" required />
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700"
                                type="email" name="email" :value="old('email') ?? $prospect->email" required />
                        </div>

                        <div class="col-span-12 md:col-span-4">
                            <x-label for="occupation" :value="__('Profissão')" />

                            <x-input id="occupation"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="occupation" :value="old('occupation') ?? $prospect->occupation" required />
                        </div>

                        <div class="col-span-12 md:col-span-2">
                            <label for="marital_state"
                                class="block text-sm font-medium text-gray-700">{{ __('Situação') }}</label>
                            <select name="marital_state" id="marital_state"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-bas border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md disabled:bg-gray-100 disabled:text-gray-700">
                                <option @if ($prospect->marital_state == 'single') selected @endif value="single" )>Solteiro(a)
                                </option>
                                <option @if ($prospect->marital_state == 'married') selected @endif value="married" )>Casado(a)
                                </option>
                                <option @if ($prospect->marital_state == 'divorced') selected @endif value="divorced" )>
                                    Divorciado(a)
                                </option>
                                <option @if ($prospect->marital_state == 'widowed') selected @endif value="widowed" )>Viúvo(a)
                                </option>
                                <option @if ($prospect->marital_state == 'undefined') selected @endif value="undefined" )>Não
                                    definido
                                </option>
                            </select>
                            @error('marital_state')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-12 md:col-span-2">
                            <label for="has_coparticipant"
                                class="block text-sm font-medium text-gray-700">{{ __('Possui Coparticipante?') }}</label>
                            <select name="has_coparticipant" id="has_coparticipant"
                                class="disabled:bg-gray-200 disabled:text-gray-500 mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                <option value="true" @if (old('has_coparticipant') ?? $prospect->has_coparticipant) selected @endif>Sim</option>
                                <option value="false" @if (!(old('has_coparticipant') ?? $prospect->has_coparticipant)) selected @endif>Não</option>
                            </select>
                            @error('has_coparticipant')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-12">
                            <label for="preferences"
                                class="block text-sm font-medium text-gray-700">{{ __('Preferências') }}</label>
                            <textarea name="preferences" id="preferences"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm disabled:bg-gray-100 disabled:text-gray-700 focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                rows="5">{{ $prospect->customer_preferences }}</textarea>
                            @error('preferences')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <h2 class="col-span-12 mt-4 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Dados de contrato') }}
                        </h2>
                        <div class="col-span-12 md:col-span-2 lg:col-span-1">
                            <x-label for="zip_code" :value="__('CEP')" />

                            <x-input id="zip_code" class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700"
                                type="text" name="zip_code" :value="old('zip_code') ?? $prospect->zip_code"
                                data-mask="00.000-000" />
                        </div>
                        <div class="col-span-12 md:col-span-3 lg:col-span-3">
                            <x-label for="address" :value="__('Endereço')" />

                            <x-input id="address" class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700"
                                type="text" name="address" :value="old('address') ?? $prospect->address" />
                        </div>
                        <div class="col-span-12 md:col-span-2 lg:col-span-1">
                            <x-label for="number" :value="__('Número')" />

                            <x-input id="number" class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700"
                                type="text" name="number" :value="old('number') ?? $prospect->number" />
                        </div>
                        <div class="col-span-12 md:col-span-2 lg:col-span-2">
                            <x-label for="complement" :value="__('Complemento')" />

                            <x-input id="complement"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="complement" :value="old('complement') ?? $prospect->complement" />
                        </div>
                        <div class="col-span-12 md:col-span-2 lg:col-span-2">
                            <x-label for="neighborhood" :value="__('Bairro')" />

                            <x-input id="neighborhood"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="neighborhood" :value="old('neighborhood') ?? $prospect->neighborhood" />
                        </div>
                        <div class="col-span-12 md:col-span-2 lg:col-span-2">
                            <x-label for="city" :value="__('Cidade')" />

                            <x-input id="city" class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700"
                                type="text" name="city" :value="old('city') ?? $prospect->city" />
                        </div>
                        <div class="col-span-12 md:col-span-2 lg:col-span-1">
                            <x-label for="state" :value="__('Estado')" />

                            <x-input id="state" class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700"
                                type="text" name="state" :value="old('state') ?? $prospect->state" maxlength="2" />
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <label for="marriage_regime"
                                class="block text-sm font-medium text-gray-700">{{ __('Regime de matrimônio') }}</label>
                            <select name="marriage_regime" id="marriage_regime"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-bas border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md disabled:bg-gray-100 disabled:text-gray-700">
                                <option @if ((old('marriage_regime') ?? $prospect->marriage_regime) == 'none') selected @endif value="none" )>
                                    {{ __('Escolher') }}
                                </option>
                                <option @if ((old('marriage_regime') ?? $prospect->marriage_regime) == 'partial_goods_community') selected @endif
                                    value="partial_goods_community" )>
                                    {{ __('Comunhão parcial de bens') }}
                                </option>
                                <option @if ((old('marriage_regime') ?? $prospect->marriage_regime) == 'universal_goods_community') selected @endif
                                    value="universal_goods_community" )>
                                    {{ __('Comunhão universal de bens') }}
                                </option>
                                <option @if ((old('marriage_regime') ?? $prospect->marriage_regime) == 'goods_separation') selected @endif value="goods_separation" )>
                                    {{ __('Separação de bens') }}
                                </option>
                                <option @if ((old('marriage_regime') ?? $prospect->marriage_regime) == 'final_participation_in_aquests') selected @endif
                                    value="final_participation_in_aquests" )>
                                    {{ __('Participação final nos aquestos') }}
                                </option>
                            </select>
                            @error('marriage_regime')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-12 md:col-span-2">
                            <x-label for="rg" :value="__('RG')" />

                            <x-input id="rg" class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700"
                                type="text" name="rg" :value="old('rg') ?? $prospect->rg" />
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="nationality" :value="__('Nacionalidade')" />

                            <x-input id="nationality"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="nationality" :value="old('nationality') ?? $prospect->nationality" />
                        </div>
                        <div class="col-span-12 sm:col-span-2">
                            <label for="birth_date"
                                class="block text-sm font-medium text-gray-700">{{ __('Data de nascimento') }}</label>
                            <input type="text" name="birth_date" id="birth_date" autocomplete="given-birth_date"
                                placeholder="DD/MM/AAAA"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                value="{{ old('birth_date') ?? $prospect->birth_date?->format('d/m/Y') }}"
                                data-mask="00/00/0000">
                            @error('birth_date')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <hr class="col-span-6 mt-8 mb-4" />
                    <div class="grid grid-cols-12 gap-4">
                        <h2 class="col-span-12 mt-4 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Documentos') }}
                        </h2>
                        @foreach ($prospect->prospect_documents as $prospect_document)
                            <div class="col-span-12 md:col-span-3">
                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col w-full h-32 hover:bg-gray-100 hover:border-gray-300">
                                        <a href="{{ route('prospects.data.get-document', [$prospect->id, $prospect_document->id]) }}"
                                            target="_blank" rel="noopener noreferrer nofollow"
                                            class="relative flex flex-col items-center justify-center pt-4">
                                            <img id="preview" class="absolute inset-0 object-contain w-full h-32">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" width="32"
                                                height="32" fill="gray" y="0px" viewBox="0 0 1000 1000"
                                                enable-background="new 0 0 1000 1000" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M888.4,229.2c-21.3-29-50.9-62.9-83.4-95.4c-32.5-32.5-66.4-62.2-95.4-83.4c-49.4-36.2-73.3-40.4-87-40.4H147.8c-42.2,0-76.6,34.3-76.6,76.6v826.9c0,42.2,34.3,76.6,76.6,76.6h704.4c42.2,0,76.6-34.3,76.6-76.6V316.3C928.8,302.5,924.6,278.6,888.4,229.2z M761.6,177.1c29.4,29.4,52.4,55.9,69.5,77.9H683.8V107.7C705.7,124.7,732.3,147.7,761.6,177.1L761.6,177.1z M867.5,913.4c0,8.3-7,15.3-15.3,15.3H147.8c-8.3,0-15.3-7-15.3-15.3V86.6c0-8.3,7-15.3,15.3-15.3c0,0,474.6,0,474.7,0v214.4c0,16.9,13.7,30.6,30.6,30.6h214.4V913.4z" />
                                                        <path
                                                            d="M714.4,806.3H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,806.3,714.4,806.3z" />
                                                        <path
                                                            d="M714.4,683.8H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,683.8,714.4,683.8z" />
                                                        <path
                                                            d="M714.4,561.3H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,561.3,714.4,561.3z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <p
                                                class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                {{ $prospect_document->getTranslatedType() }}
                                            </p>
                                            <p id="label_comp_res"
                                                class="pt-1 text-xs tracking-wider text-gray-400 group-hover:text-gray-600">
                                                {{ basename($prospect_document->url ?? '') }}
                                                <p id="label_comp_res"
                                                    class="pt-1 text-xs tracking-wider text-gray-400 group-hover:text-gray-600">
                                                    Carregado em:
                                                    {{ $prospect_document->updated_at->format('d/m/y H:i:s') }}
                                                </p>
                                        </a>
                                    </label>
                                </div>
                                @error('comp_res')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        @endforeach
                        @if (!$prospect->prospect_documents->isEmpty())
                            <div class="col-span-12 md:col-span-3">
                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col w-full h-32 hover:bg-gray-100 hover:border-gray-300">
                                        <a href="{{ route('prospects.data.get-zip-documents', ['prospect' => $prospect->id]) }}"
                                            target="_blank" rel="noopener noreferrer nofollow"
                                            class="relative flex flex-col items-center justify-center pt-4">
                                            <img id="preview" class="absolute inset-0 object-contain w-full h-32">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" width="32"
                                                height="32" fill="gray" y="0px" viewBox="0 0 1000 1000"
                                                enable-background="new 0 0 1000 1000" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M888.4,229.2c-21.3-29-50.9-62.9-83.4-95.4c-32.5-32.5-66.4-62.2-95.4-83.4c-49.4-36.2-73.3-40.4-87-40.4H147.8c-42.2,0-76.6,34.3-76.6,76.6v826.9c0,42.2,34.3,76.6,76.6,76.6h704.4c42.2,0,76.6-34.3,76.6-76.6V316.3C928.8,302.5,924.6,278.6,888.4,229.2z M761.6,177.1c29.4,29.4,52.4,55.9,69.5,77.9H683.8V107.7C705.7,124.7,732.3,147.7,761.6,177.1L761.6,177.1z M867.5,913.4c0,8.3-7,15.3-15.3,15.3H147.8c-8.3,0-15.3-7-15.3-15.3V86.6c0-8.3,7-15.3,15.3-15.3c0,0,474.6,0,474.7,0v214.4c0,16.9,13.7,30.6,30.6,30.6h214.4V913.4z" />
                                                        <path
                                                            d="M714.4,806.3H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,806.3,714.4,806.3z" />
                                                        <path
                                                            d="M714.4,683.8H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,683.8,714.4,683.8z" />
                                                        <path
                                                            d="M714.4,561.3H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,561.3,714.4,561.3z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <p
                                                class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                ZIP
                                            </p>
                                            <p id="label_comp_res"
                                                class="pt-1 text-xs tracking-wider text-gray-400 group-hover:text-gray-600">
                                                Obter todos em formato ZIP
                                            </p>
                                        </a>
                                    </label>
                                </div>
                                @error('comp_res')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <hr class="col-span-6 mt-8 mb-4" id="hr_copart" />
                    <div class="grid grid-cols-12 gap-4" id="div_copart">
                        <h2 class="col-span-12 mt-4 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Coparticipante') }}
                        </h2>
                        <div class="col-span-12 md:col-span-4">
                            <x-label for="copart_name" :value="__('Nome')" />

                            <x-input id="copart_name"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="copart_name" :value="old('copart_name') ?? $prospect->copart_name" />
                        </div>
                        <!-- CPF -->
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="copart_cpf_cnpj" :value="__('CPF / CNPJ')" />

                            <x-input id="copart_cpf_cnpj"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="copart_cpf_cnpj" :value="old('copart_cpf_cnpj') ?? $prospect->copart_cpf_cnpj" />
                        </div>

                        <!-- Phone Number -->
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="copart_phone" :value="__('Telefone')" />

                            <x-input id="copart_phone"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="copart_phone" :value="$prospect->copart_phone" />
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="copart_email"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="email"
                                name="copart_email" :value="old('copart_email') ?? $prospect->copart_email" />
                        </div>

                        <div class="col-span-12 md:col-span-4">
                            <x-label for="copart_occupation" :value="__('Profissão')" />

                            <x-input id="copart_occupation"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="copart_occupation"
                                :value="old('copart_occupation') ?? $prospect->copart_occupation" />
                        </div>

                        <div class="col-span-12 md:col-span-4">
                            <label for="copart_marital_state"
                                class="block text-sm font-medium text-gray-700">{{ __('Situação') }}</label>
                            <select name="copart_marital_state" id="copart_marital_state"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-bas border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md disabled:bg-gray-100 disabled:text-gray-700">
                                <option @if ($prospect->copart_marital_state == 'single') selected @endif value="single" )>Solteiro(a)
                                </option>
                                <option @if ($prospect->copart_marital_state == 'married') selected @endif value="married" )>Casado(a)
                                </option>
                                <option @if ($prospect->copart_marital_state == 'divorced') selected @endif value="divorced" )>
                                    Divorciado(a)
                                </option>
                                <option @if ($prospect->copart_marital_state == 'widowed') selected @endif value="widowed" )>Viúvo(a)
                                </option>
                                <option @if ($prospect->copart_marital_state == 'undefined') selected @endif value="undefined" )>Não
                                    definido
                                </option>
                                <option @if ($prospect->copart_marital_state == null) selected @endif value="null" )>
                                </option>
                            </select>
                            @error('marital_state')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <h2 class="col-span-12 mt-4 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Dados de contrato - Coparticipante') }}
                        </h2>
                        <div class="col-span-12 md:col-span-2 lg:col-span-1">
                            <x-label for="copart_zip_code" :value="__('CEP')" />

                            <x-input id="copart_zip_code"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="copart_zip_code" :value="old('copart_zip_code') ?? $prospect->copart_zipcode"
                                data-mask="00.000-000" />
                        </div>
                        <div class="col-span-12 md:col-span-3 lg:col-span-3">
                            <x-label for="copart_address" :value="__('Endereço')" />

                            <x-input id="copart_address"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="copart_address" :value="old('copart_address') ?? $prospect->copart_address" />
                        </div>
                        <div class="col-span-12 md:col-span-2 lg:col-span-1">
                            <x-label for="copart_number" :value="__('Número')" />

                            <x-input id="copart_number"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="copart_number" :value="old('copart_number') ?? $prospect->copart_number" />
                        </div>
                        <div class="col-span-12 md:col-span-2 lg:col-span-2">
                            <x-label for="copart_complement" :value="__('Complemento')" />

                            <x-input id="copart_complement"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="copart_complement"
                                :value="old('copart_complement') ?? $prospect->copart_complement" />
                        </div>
                        <div class="col-span-12 md:col-span-2 lg:col-span-2">
                            <x-label for="copart_neighborhood" :value="__('Bairro')" />

                            <x-input id="copart_neighborhood"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="copart_neighborhood"
                                :value="old('copart_neighborhood') ?? $prospect->copart_neighborhood" />
                        </div>
                        <div class="col-span-12 md:col-span-2 lg:col-span-2">
                            <x-label for="copart_city" :value="__('Cidade')" />

                            <x-input id="copart_city"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="copart_city" :value="old('copart_city') ?? $prospect->copart_city" />
                        </div>
                        <div class="col-span-12 md:col-span-2 lg:col-span-1">
                            <x-label for="copart_state" :value="__('Estado')" />

                            <x-input id="state" class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700"
                                type="text" name="copart_state" :value="old('copart_state') ?? $prospect->copart_state"
                                maxlength="2" />
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <label for="copart_marriage_regime"
                                class="block text-sm font-medium text-gray-700">{{ __('Regime de matrimônio') }}</label>
                            <select name="copart_marriage_regime" id="copart_marriage_regime"
                                class="mt-1 block w-full pl-3 h-[42px] pr-10 py-2 text-bas border-gray-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md disabled:bg-gray-100 disabled:text-gray-700">
                                <option @if ((old('copart_marriage_regime') ?? $prospect->copart_marriage_regime) == null) selected @endif value="" )>
                                    {{ __('Escolher') }}
                                </option>
                                <option @if ((old('copart_marriage_regime') ?? $prospect->copart_marriage_regime) == 'partial_goods_community') selected @endif value="partial_goods_community" )>
                                    {{ __('Comunhão parcial de bens') }}
                                </option>
                                <option @if ((old('copart_marriage_regime') ?? $prospect->copart_marriage_regime) == 'universal_goods_community') selected @endif value="universal_goods_community" )>
                                    {{ __('Comunhão universal de bens') }}
                                </option>
                                <option @if ((old('copart_marriage_regime') ?? $prospect->copart_marriage_regime) == 'goods_separation') selected @endif value="goods_separation" )>
                                    {{ __('Separação de bens') }}
                                </option>
                                <option @if ((old('copart_marriage_regime') ?? $prospect->copart_marriage_regime) == 'final_participation_in_aquests') selected @endif value="final_participation_in_aquests" )>
                                    {{ __('Participação final nos aquestos') }}
                                </option>
                            </select>
                            @error('copart_marriage_regime')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-span-12 md:col-span-2">
                            <x-label for="copart_rg" :value="__('RG')" />

                            <x-input id="copart_rg"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="copart_rg" :value="old('copart_rg') ?? $prospect->copart_rg" />
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <x-label for="copart_nationality" :value="__('Nacionalidade')" />

                            <x-input id="copart_nationality"
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="copart_nationality"
                                :value="old('copart_nationality') ?? $prospect->copart_nationality" />
                        </div>
                        <div class="col-span-12 sm:col-span-2">
                            <label for="copart_birth_date"
                                class="block text-sm font-medium text-gray-700">{{ __('Data de nascimento') }}</label>
                            <input type="text" name="copart_birth_date" id="copart_birth_date"
                                autocomplete="given-birth_date" placeholder="DD/MM/AAAA"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm disabled:bg-gray-200 disabled:text-gray-500"
                                value="{{ old('copart_birth_date') ?? $prospect->copart_birth_date?->format('d/m/Y') }}"
                                data-mask="00/00/0000">
                            @error('birth_date')
                                <small class="text-red-700 font-sm">*{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <hr class="col-span-6 mt-8 mb-4" />
                    <div class="grid grid-cols-12 gap-4">
                        <h2 class="col-span-12 mt-4 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Documentos do coparticipante') }}
                        </h2>
                        @foreach ($prospect->prospect_copart_documents as $copart_document)
                            <div class="col-span-12 md:col-span-3">
                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col w-full h-32 hover:bg-gray-100 hover:border-gray-300">
                                        <a href="{{ route('prospects.data.get-document', [$prospect->id, $prospect_document->id]) }}"
                                            target="_blank" rel="noopener noreferrer nofollow"
                                            class="relative flex flex-col items-center justify-center pt-4">
                                            <img id="preview" class="absolute inset-0 object-contain w-full h-32">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" width="32"
                                                height="32" fill="gray" y="0px" viewBox="0 0 1000 1000"
                                                enable-background="new 0 0 1000 1000" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M888.4,229.2c-21.3-29-50.9-62.9-83.4-95.4c-32.5-32.5-66.4-62.2-95.4-83.4c-49.4-36.2-73.3-40.4-87-40.4H147.8c-42.2,0-76.6,34.3-76.6,76.6v826.9c0,42.2,34.3,76.6,76.6,76.6h704.4c42.2,0,76.6-34.3,76.6-76.6V316.3C928.8,302.5,924.6,278.6,888.4,229.2z M761.6,177.1c29.4,29.4,52.4,55.9,69.5,77.9H683.8V107.7C705.7,124.7,732.3,147.7,761.6,177.1L761.6,177.1z M867.5,913.4c0,8.3-7,15.3-15.3,15.3H147.8c-8.3,0-15.3-7-15.3-15.3V86.6c0-8.3,7-15.3,15.3-15.3c0,0,474.6,0,474.7,0v214.4c0,16.9,13.7,30.6,30.6,30.6h214.4V913.4z" />
                                                        <path
                                                            d="M714.4,806.3H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,806.3,714.4,806.3z" />
                                                        <path
                                                            d="M714.4,683.8H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,683.8,714.4,683.8z" />
                                                        <path
                                                            d="M714.4,561.3H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,561.3,714.4,561.3z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <p
                                                class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                {{ $copart_document->getTranslatedType() }}
                                            </p>
                                            <p id="label_comp_res"
                                                class="pt-1 text-xs tracking-wider text-gray-400 group-hover:text-gray-600">
                                                {{ basename($copart_document->url ?? '') }}
                                                <p id="label_comp_res"
                                                    class="pt-1 text-xs tracking-wider text-gray-400 group-hover:text-gray-600">
                                                    Carregado em:
                                                    {{ $copart_document->updated_at->format('d/m/y H:i:s') }}
                                                </p>
                                        </a>
                                    </label>
                                </div>
                                @error('comp_res')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        @endforeach
                        @if (!$prospect->prospect_copart_documents->isEmpty())
                            <div class="col-span-12 md:col-span-3">
                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col w-full h-32 hover:bg-gray-100 hover:border-gray-300">
                                        <a href="{{ route('prospects.data.get-zip-documents', ['prospect' => $prospect->id]) }}"
                                            target="_blank" rel="noopener noreferrer nofollow"
                                            class="relative flex flex-col items-center justify-center pt-4">
                                            <img id="preview" class="absolute inset-0 object-contain w-full h-32">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" width="32"
                                                height="32" fill="gray" y="0px" viewBox="0 0 1000 1000"
                                                enable-background="new 0 0 1000 1000" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M888.4,229.2c-21.3-29-50.9-62.9-83.4-95.4c-32.5-32.5-66.4-62.2-95.4-83.4c-49.4-36.2-73.3-40.4-87-40.4H147.8c-42.2,0-76.6,34.3-76.6,76.6v826.9c0,42.2,34.3,76.6,76.6,76.6h704.4c42.2,0,76.6-34.3,76.6-76.6V316.3C928.8,302.5,924.6,278.6,888.4,229.2z M761.6,177.1c29.4,29.4,52.4,55.9,69.5,77.9H683.8V107.7C705.7,124.7,732.3,147.7,761.6,177.1L761.6,177.1z M867.5,913.4c0,8.3-7,15.3-15.3,15.3H147.8c-8.3,0-15.3-7-15.3-15.3V86.6c0-8.3,7-15.3,15.3-15.3c0,0,474.6,0,474.7,0v214.4c0,16.9,13.7,30.6,30.6,30.6h214.4V913.4z" />
                                                        <path
                                                            d="M714.4,806.3H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,806.3,714.4,806.3z" />
                                                        <path
                                                            d="M714.4,683.8H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,683.8,714.4,683.8z" />
                                                        <path
                                                            d="M714.4,561.3H285.6c-16.9,0-30.6-13.7-30.6-30.6s13.7-30.6,30.6-30.6h428.8c16.9,0,30.6,13.7,30.6,30.6S731.3,561.3,714.4,561.3z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <p
                                                class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                ZIP
                                            </p>
                                            <p id="label_comp_res"
                                                class="pt-1 text-xs tracking-wider text-gray-400 group-hover:text-gray-600">
                                                Obter todos em formato ZIP
                                            </p>
                                        </a>
                                    </label>
                                </div>
                                @error('comp_res')
                                    <small class="text-red-700 font-sm">*{{ $message }}</small>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <hr class="col-span-6 mt-8 mb-4" />
                    <div class="grid grid-cols-12 gap-4">
                        <h2 class="col-span-12 mt-4 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Renda composta aprovada (R$)') }}
                        </h2>
                        <div class="col-span-12 md:col-span-4">
                            <x-input id="total_incoming"
                                class="block w-full mt-1 mb-2 disabled:bg-gray-100 disabled:text-gray-700"
                                type="number" name="total_incoming"
                                :value="old('total_incoming') ?? $prospect->total_incoming ?? 0" />
                            <small>Renda bruta familiar pré-aprovada pela empresa para fim de financiamento bancário ou
                                próprio, com base nos documentos apresentados pelo cliente.</small>
                        </div>
                    </div>
                    <hr class="col-span-6 mt-8 mb-4" />
                    <div class="grid grid-cols-12 gap-4">
                        <h2 class="col-span-12 mt-4 text-xl font-semibold leading-tight text-gray-600">
                            {{ __('Adicionar documentos') }}
                        </h2>
                        <div class="col-span-12 md:col-span-4">
                            <x-input id="document_code" disabled readonly
                                class="block w-full mt-1 disabled:bg-gray-100 disabled:text-gray-700" type="text"
                                name="document_code" :value="$prospect->document_code ?? '...'" />
                        </div>
                        <div class="flex items-center col-span-12 md:col-span-4">
                            <a href="{{ route('prospects.data.documents.code', ['code' => $prospect->document_code]) }}"
                                target="_blank" rel="noopener noreferrer nofollow"
                                class="font-medium text-red-700 underline hover:text-red-600">Adicionar
                                documentos</a>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-4 mt-4">
                        {{-- <div class="col-span-12 md:col-span-2">
                            <a href="#"
                                class="flex items-center justify-center h-full px-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none disabled:opacity-25">
                                {{ __('Enviar por email') }}
                            </a>
                        </div> --}}
                        <div class="col-span-12 md:col-span-3">
                            <a href="{{ $prospect->whatsAppDocumentUrl() }}" target="_blank"
                                rel="noopener noreferrer nofollow"
                                class="flex items-center justify-center h-full px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none disabled:opacity-25">
                                {{ __('Enviar por WhatsApp') }}
                            </a>
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <button type="button" id="proposal_code_button"
                                class="flex items-center justify-center w-full h-full px-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none disabled:opacity-25">
                                {{ __('Código de participação') }}
                            </button>
                        </div>
                        <div class="col-span-12 md:col-span-2">
                            <button type="button" id="button_history"
                                class="flex items-center justify-center h-full px-4 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-orange-600 border border-transparent rounded-md hover:bg-orange-700 focus:outline-none disabled:opacity-25">
                                {{ __('Histórico') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                <a href="{{ route('prospects.index', ['status' => $prospect->status]) }}"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    {{ __('Voltar') }}</a>
                <button type="submit"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-md shadow-sm hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    {{ __('Alterar dados') }}
                </button>
                @if ($prospect->status == 'approved')
                    <button type="button" id="button_open"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-yellow-600 border border-transparent rounded-md shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        {{ __('Solicitar correção') }}
                    </button>
                @endif
                @if ($prospect->status == 'open' || $prospect->status == 'rejected')
                    <button type="button" id="button_approve"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        {{ __('Aprovar') }}
                    </button>
                @endif
                @if ($prospect->status == 'open' || $prospect->status == 'approved')
                    <button type="button" id="button_repprove"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-400 border border-transparent rounded-md shadow-sm hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-300">
                        {{ __('Reprovar') }}
                    </button>
                @endif
                @if ($prospect->proposals->where('status', 'approved')->count() == 0 && $prospect->proposals->where('status', 'open')->count() == 0 && auth()->user()->access_profile?->permissions->where('key', 'prospects_delete')->isNotEmpty())
                    <button type="button" id="button_delete"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('Excluir cadastro') }}
                    </button>
                @endif
            </div>
        </form>
    </div>
    <div class="hidden text-green-700 text-green-800 bg-green-100"></div>
    <div class="hidden text-yellow-700 text-yellow-800 bg-yellow-100"></div>
    <div class="hidden text-red-700 text-red-800 bg-red-100"></div>
    <div id="modal-history" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-black bg-opacity-80" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full sm:p-6">
                <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                    <button type="button" id="close_history"
                        class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-0">
                        <span class="sr-only">{{ __('Fechar') }}</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="sm:flex sm:items-start">
                    <div
                        class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: outline/exclamation -->
                        <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="pt-2 mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h2 class="flex items-center text-2xl font-medium leading-6 text-gray-900" id="modal-title">
                            {{ __('Histórico da pasta') }}
                        </h2>
                        <div class="mt-8 mb-4">
                            <div class="pr-16 space-y-2 text-justify text-gray-600">
                                <ul>
                                    @foreach ($histories as $history)
                                        <li class="list-disc">
                                            <strong>{{ $history->created_at->format('d/m/Y H:i:s') }}</strong><br />{{ $history->content }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="button" id="cancel_history"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                        {{ __('Fechar') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-approve" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <form action="{{ route('prospects.approve', $prospect->id) }}" method="POST">
            @csrf
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-black bg-opacity-80" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full sm:p-6">
                    <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                        <button type="button" id="close_approve"
                            class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-0">
                            <span class="sr-only">{{ __('Fechar') }}</span>
                            <!-- Heroicon name: outline/x -->
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="sm:flex sm:items-start">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Heroicon name: outline/exclamation -->
                            <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="w-full pt-2 mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h2 class="flex items-center text-2xl font-medium leading-6 text-gray-900"
                                id="modal-title">
                                {{ __('Aprovar pasta') }}
                            </h2>
                            <div class="mt-8 mb-4">
                                <div class="pr-16 space-y-2 text-justify text-gray-600">
                                    <x-label for="notes" :value="__('Observações')" />
                                    <textarea name="notes" id="notes" rows="3"
                                        placeholder="Caso tenha alguma observação, insira neste campo"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gap-4 mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-white bg-green-600 border border-green-600 rounded-md shadow-sm hover:bg-green-700 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            {{ __('Aprovar') }}
                        </button>
                        <button type="button" id="cancel_approve"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            {{ __('Cancelar') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="modal-repprove" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <form action="{{ route('prospects.reject', $prospect->id) }}" method="POST">
            @csrf
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-black bg-opacity-80" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full sm:p-6">
                    <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                        <button type="button" id="close_repprove"
                            class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-0">
                            <span class="sr-only">{{ __('Fechar') }}</span>
                            <!-- Heroicon name: outline/x -->
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="sm:flex sm:items-start">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Heroicon name: outline/exclamation -->
                            <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="w-full pt-2 mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h2 class="flex items-center text-2xl font-medium leading-6 text-gray-900"
                                id="modal-title">
                                {{ __('Reprovar pasta') }}
                            </h2>
                            <div class="mt-8 mb-4">
                                <div class="pr-16 space-y-2 text-justify text-gray-600">
                                    <x-label for="notes" :value="__('Observações')" />
                                    <textarea name="notes" id="notes" rows="3"
                                        placeholder="Caso tenha alguma observação, insira neste campo"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gap-4 mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-white bg-red-600 border border-red-600 rounded-md shadow-sm hover:bg-red-700 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            {{ __('Rejeitar') }}
                        </button>
                        <button type="button" id="cancel_repprove"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            {{ __('Fechar') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="modal-open" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <form action="{{ route('prospects.open', $prospect->id) }}" method="POST">
            @csrf
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-black bg-opacity-80" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full sm:p-6">
                    <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                        <button type="button" id="close_open"
                            class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-0">
                            <span class="sr-only">{{ __('Fechar') }}</span>
                            <!-- Heroicon name: outline/x -->
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="sm:flex sm:items-start justify-items-stretch">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Heroicon name: outline/exclamation -->
                            <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="w-full pt-2 mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h2 class="flex items-center text-2xl font-medium leading-6 text-gray-900"
                                id="modal-title">
                                {{ __('Solicitar correção da pasta') }}
                            </h2>
                            <div class="mt-8 mb-4">
                                <div class="pr-16 space-y-2 text-justify text-gray-600">
                                    <x-label for="notes" :value="__('Observações')" />
                                    <textarea name="notes" id="notes" rows="3"
                                        placeholder="Caso tenha alguma observação, insira neste campo"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gap-4 mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-white bg-yellow-600 border border-yellow-600 rounded-md shadow-sm hover:bg-yellow-700 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            {{ __('Solicitar correção') }}
                        </button>
                        <button type="button" id="cancel_open"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            {{ __('Cancelar') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @if (auth()->user()->access_profile?->permissions->where('key', 'prospects_delete')->first() != null)
        <div id="modal-delete" class="fixed inset-0 z-10 hidden overflow-y-auto" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <form action="{{ route('prospects.destroy', $prospect->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity bg-black bg-opacity-80" aria-hidden="true"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div
                        class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full sm:p-6">
                        <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
                            <button type="button" id="close_delete"
                                class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-0">
                                <span class="sr-only">{{ __('Fechar') }}</span>
                                <!-- Heroicon name: outline/x -->
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="sm:flex sm:items-start justify-items-stretch">
                            <div
                                class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                <!-- Heroicon name: outline/exclamation -->
                                <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="w-full pt-2 mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h2 class="flex items-center text-2xl font-medium leading-6 text-gray-900"
                                    id="modal-title">
                                    {{ __('Excluir pasta') }}
                                </h2>
                                <div class="mt-8 mb-4">
                                    <div class="pr-16 space-y-2 text-justify text-gray-600">
                                        <x-label for="notes" :value="__('Observações')" />
                                        <textarea name="notes" id="notes" rows="3"
                                            placeholder="Caso tenha alguma observação, insira neste campo"
                                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gap-4 mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-white bg-yellow-600 border border-yellow-600 rounded-md shadow-sm hover:bg-yellow-700 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                                {{ __('Excluir') }}
                            </button>
                            <button type="button" id="cancel_delete"
                                class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                                {{ __('Cancelar') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="text-green-400 bg-green-50"></div>
        <div class="text-red-400 bg-red-50"></div>
        <div class="text-yellow-400 bg-yellow-50"></div>
    @endif
    @section('scripts')
        <script>
            $('#cancel_history').on('click', function(e) {
                $('#modal-history').fadeOut();
                e.preventDefault();
            });
            $('#close_history').on('click', function(e) {
                $('#modal-history').fadeOut();
                e.preventDefault();
            });
            $('#button_history').on('click', function(e) {
                $('#modal-history').fadeIn();
                e.preventDefault();
            });

            $('#cancel_approve').on('click', function(e) {
                $('#modal-approve').fadeOut();
                e.preventDefault();
            });
            $('#close_approve').on('click', function(e) {
                $('#modal-approve').fadeOut();
                e.preventDefault();
            });
            $('#button_approve').on('click', function(e) {
                $('#modal-approve').fadeIn();
                e.preventDefault();
            });

            $('#cancel_repprove').on('click', function(e) {
                $('#modal-repprove').fadeOut();
                e.preventDefault();
            });
            $('#close_repprove').on('click', function(e) {
                $('#modal-repprove').fadeOut();
                e.preventDefault();
            });
            $('#button_repprove').on('click', function(e) {
                $('#modal-repprove').fadeIn();
                e.preventDefault();
            });

            $('#cancel_open').on('click', function(e) {
                $('#modal-open').fadeOut();
                e.preventDefault();
            });
            $('#close_open').on('click', function(e) {
                $('#modal-open').fadeOut();
                e.preventDefault();
            });
            $('#button_open').on('click', function(e) {
                $('#modal-open').fadeIn();
                e.preventDefault();
            });

            @if (auth()->user()->access_profile?->permissions->where('key', 'prospects_delete')->first() != null)
                $('#cancel_delete').on('click', function(e) {
                $('#modal-delete').fadeOut();
                e.preventDefault();
                });
                $('#close_delete').on('click', function(e) {
                $('#modal-delete').fadeOut();
                e.preventDefault();
                });
                $('#button_delete').on('click', function(e) {
                $('#modal-delete').fadeIn();
                e.preventDefault();
                });
            @endif

            $('#has_coparticipant').on('change', function() {
                if ($("#has_coparticipant option:selected").val() == 'true') {
                    $('#hr_copart').show();
                    $('#div_copart').show();
                } else {
                    $('#hr_copart').hide();
                    $('#div_copart').hide();
                }
            });
            $(() => {
                if ($("#has_coparticipant option:selected").val() == 'true') {
                    $('#hr_copart').show();
                    $('#div_copart').show();
                } else {
                    $('#hr_copart').hide();
                    $('#div_copart').hide();
                }
            })

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#address").val("{{ old('address') ?? $prospect->address }}");
                $("#neighborhood").val("{{ old('neighborhood') ?? $prospect->neighborhood }}");
                $("#city").val("{{ old('city') ?? $prospect->city }}");
                $("#state").val("{{ old('state') ?? $prospect->state }}");
            }

            function limpa_formulário_cep_copart() {
                // Limpa valores do formulário de cep.
                $("#copart_address").val("{{ old('copart_address') ?? $prospect->copart_address }}");
                $("#copart_neighborhood").val(
                    "{{ old('copart_neighborhood') ?? $prospect->copart_neighborhood }}");
                $("#copart_city").val("{{ old('copart_city') ?? $prospect->copart_city }}");
                $("#copart_state").val("{{ old('copart_state') ?? $prospect->copart_state }}");
            }

            $(document).ready(function() {
                $("#zip_code").blur(function() {
                    if ($(this).val() == "{{ old('zip_code') ?? $prospect->zip_code }}")
                        return;

                    var cep = $(this).val().replace(/\D/g, '');
                    if (cep != "") {
                        var validacep = /^[0-9]{8}$/;
                        if (validacep.test(cep)) {
                            $("#address").val("...");
                            $("#neighborhood").val("...");
                            $("#city").val("...");
                            $("#state").val("...");

                            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?",
                                function(dados) {
                                    if (!("erro" in dados)) {
                                        $("#address").val(dados.logradouro);
                                        $("#neighborhood").val(dados.bairro);
                                        $("#city").val(dados.localidade);
                                        $("#state").val(dados.uf);
                                    } else {
                                        limpa_formulário_cep();
                                        Swal.fire({
                                            title: 'Falha',
                                            text: 'CEP inválido ou não encontrado',
                                            icon: 'error',
                                            confirmButtonClass: 'btn-danger'
                                        });
                                    }
                                });
                        }
                    }
                });
            });

            $(document).ready(function() {
                $("#copart_zip_code").blur(function() {
                    if ($(this).val() ==
                        "{{ old('copart_zip_code') ?? $prospect->copart_zip_code }}")
                        return;

                    var cep = $(this).val().replace(/\D/g, '');
                    if (cep != "") {
                        var validacep = /^[0-9]{8}$/;
                        if (validacep.test(cep)) {
                            $("#copart_address").val("...");
                            $("#copart_neighborhood").val("...");
                            $("#copart_city").val("...");
                            $("#copart_state").val("...");

                            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?",
                                function(dados) {
                                    if (!("erro" in dados)) {
                                        $("#copart_address").val(dados.logradouro);
                                        $("#copart_neighborhood").val(dados.bairro);
                                        $("#copart_city").val(dados.localidade);
                                        $("#copart_state").val(dados.uf);
                                    } else {
                                        limpa_formulário_cep_copart();
                                        Swal.fire({
                                            title: 'Falha',
                                            text: 'CEP inválido ou não encontrado',
                                            icon: 'error',
                                            confirmButtonClass: 'btn-danger'
                                        });
                                    }
                                });
                        }
                    }
                });

                $('#proposal_code_button').on('click', function() {
                    Swal.fire({
                        title: 'Código de participação',
                        text: "{{ $prospect->code != null ? $prospect->code->code : 'Ainda não cadastrado' }}",
                        icon: 'info',
                        confirmButtonClass: 'btn-primary'
                    });
                    if ("{{ $prospect->code != null ? $prospect->code->code : '' }}" != "") {
                        navigator.permissions.query({
                            name: "clipboard-write"
                        }).then(result => {
                            if (result.state == "granted" || result.state == "prompt") {
                                navigator.clipboard.writeText(
                                    "{{ $prospect->code?->code }}");
                            }
                        });
                    }
                });
            });
        </script>
    @endsection
</x-app-layout>
