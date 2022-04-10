@props(['step' => 1, 'has_coparticipant' => true])

@php
$steps = [
    1 => __('Corretor'),
    2 => __('Dados'),
    3 => __('Documentos'),
    4 => __('Coparticipante'),
    5 => __('Documentos coparticipante'),
    6 => __('Revisão'),
    7 => __('Declaração'),
];
@endphp

<nav aria-label="Progress">
    <ol role="list" class="bg-white border border-gray-300 divide-y divide-gray-300 rounded-md md:flex md:divide-y-0">
        <x-registration-step-item :step="1" :name="'Corretor'" :completed="$step > 1" :current="$step == 1" />
        <x-registration-step-item :step="2" :name="'Dados'" :completed="$step > 2" :current="$step == 2" />
        <x-registration-step-item :step="3" :name="'Documentos'" :completed="$step > 3" :current="$step == 3" />
        <x-registration-step-item :step="4" :name="'Coparticipante'" :completed="$step > 4" :current="$step == 4" />
        <x-registration-step-item :step="5" :name="'Documentos Coparticipante'" :completed="$step > 5" :cancelled="$step >= 5 && $has_coparticipant == false"
            :current="$step == 5" />
        <x-registration-step-item :step="6" :name="'Revisão'" :completed="$step > 6" :current="$step == 6" />
        <x-registration-step-item :step="7" :name="'Declaração'" :completed="$step > 7" :current="$step == 7" :final="true" />
    </ol>
</nav>
