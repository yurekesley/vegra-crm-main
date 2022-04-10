@php
$permissions =
    auth()
        ->user()
        ?->access_profile?->permissions?->where('active', true) ?? collect([]);
@endphp

<nav class="px-2 mt-5 space-y-1">
    <x-nav-link :active="request()->routeIs('welcome.*')" :text="'Home'" href="{{ route('welcome') }}">
        <x-slot name="svgIcon">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </x-slot>
    </x-nav-link>
    <x-nav-link :active="request()->routeIs('dashboard')" :text="'Dashboard'" href="{{ route('dashboard') }}">
        <x-slot name="svgIcon">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
        </x-slot>
    </x-nav-link>
    @if ($permissions->where('key', 'prospects')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('prospects.*')" :text="'Pastas'"
            href="{{ route('prospects.index') }}">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'proposals')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('proposals.*')" :text="'Propostas'" href="{{ route('proposals.index') }}">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'contracts')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('contracts')" :text="'Contratos'" href="#">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'mirrors')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('mirrors.*')" :text="'Espelhos de venda'"
            href="{{ route('mirrors.index') }}">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'unit_dashboard')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('unit_dashboard')" :text="'Espelhos'" href="#">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'partners')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('partners.*')" :text="'Parceiros'"
            href="{{ route('partners.index') }}">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'users')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('users.*')" :text="'Usuários'" href="{{ route('users.index') }}">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'access_profiles')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('access_profiles.*')" :text="'Perfis de acesso'"
            href="{{ route('access_profiles.index') }}">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'products')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('products.*')" :text="'Produtos'"
            href="{{ route('products.index') }}">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'contract_templates')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('contract_templates.*')" :text="'Minutas'"
            href="{{ route('contract_templates.index') }}">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'codes')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('codes.*')" :text="'Códigos'" href="{{ route('codes.index') }}">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'timers')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('timers')" :text="'Timers'" href="#">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'gdpr')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('gdpr.*')" :text="'LGPD'" href="{{ route('gdpr.index') }}">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'finance')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('finance')" :text="'Financeiro'" href="#">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->where('key', 'board_messages')->isNotEmpty())
        <x-nav-link :active="request()->routeIs('board_messages.*')" :text="'Mensagens e avisos'"
            href="{{ route('board_messages.index') }}">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" <path stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2"
                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
            </x-slot>
        </x-nav-link>
    @endif
    @if ($permissions->filter(function ($value) {
        return str_starts_with($value->key, 'report_');
    })->count() > 0)
        <x-nav-link :active="request()->routeIs('reports')" :text="'Relatórios'" href="#">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </x-slot>
        </x-nav-link>
    @endif
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-nav-link :text="'Sair do sistema'" href="{{ route('logout') }}"
            onclick="event.preventDefault(); this.closest('form').submit();">
            <x-slot name="svgIcon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </x-slot>
        </x-nav-link>
    </form>
</nav>
