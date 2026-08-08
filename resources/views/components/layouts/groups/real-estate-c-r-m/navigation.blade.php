<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.Real Estate CRM') }}</x-nav.divider>

    @php
        $activeClass = 'bg-teal-50 text-teal-600 dark:bg-teal-900/50 dark:text-teal-400';
        $inactiveClass = 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white';
        $dotActiveClass = 'bg-teal-600';
        $dotInactiveClass = 'bg-gray-300 dark:bg-gray-700';
    @endphp

    {{-- Dashboard --}}
    <a href="/modular/real-estate-c-r-m/real-estate-c-r-m/dashboard"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*dashboard*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*dashboard*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    {{-- Landing Page --}}
    <a href="/real-estate-c-r-m"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    {{-- Owners --}}
    <a href="/modular/real-estate-c-r-m/real-estate-c-r-m/owners"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*owners*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*owners*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('real-estate-c-r-m/owners.Owners') }}</span>
    </a>

    {{-- Agents --}}
    <a href="/modular/real-estate-c-r-m/real-estate-c-r-m/agents"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*agents*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*agents*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('real-estate-c-r-m/agents.Agents') }}</span>
    </a>

    {{-- Clients --}}
    <a href="/modular/real-estate-c-r-m/real-estate-c-r-m/clients"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*clients*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*clients*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('real-estate-c-r-m/clients.Clients') }}</span>
    </a>

    {{-- Properties --}}
    <a href="/modular/real-estate-c-r-m/real-estate-c-r-m/properties"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*properties*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*properties*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('real-estate-c-r-m/properties.Properties') }}</span>
    </a>

    {{-- Property Visits --}}
    <a href="/modular/real-estate-c-r-m/real-estate-c-r-m/property-visits"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*property-visits*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*property-visits*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('real-estate-c-r-m/property-visits.PropertyVisits') }}</span>
    </a>

    {{-- Contracts --}}
    <a href="/modular/real-estate-c-r-m/real-estate-c-r-m/contracts"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*contracts*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*contracts*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('real-estate-c-r-m/contracts.Contracts') }}</span>
    </a>

</div>
