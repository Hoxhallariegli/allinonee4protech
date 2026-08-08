<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.Travel Agency') }}</x-nav.divider>

    @php
        $activeClass = 'bg-sky-50 text-sky-600 dark:bg-sky-900/50 dark:text-sky-400';
        $inactiveClass = 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white';
        $dotActiveClass = 'bg-sky-600';
        $dotInactiveClass = 'bg-gray-300 dark:bg-gray-700';
    @endphp

    <a href="{{ route('admin.travel-agency.dashboard') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*dashboard*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*dashboard*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    <a href="/travel-agency"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    <a href="{{ route('admin.travel-agency.clients.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*clients*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*clients*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('travel-agency/clients.Clients') }}</span>
    </a>

    <a href="{{ route('admin.travel-agency.destinations.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*destinations*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*destinations*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('travel-agency/destinations.Destinations') }}</span>
    </a>

    <a href="{{ route('admin.travel-agency.flight-tickets.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*flight-tickets*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*flight-tickets*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('travel-agency/flight-tickets.FlightTickets') }}</span>
    </a>

    <a href="{{ route('admin.travel-agency.tour-bookings.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*tour-bookings*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*tour-bookings*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('travel-agency/tour-bookings.TourBookings') }}</span>
    </a>

    <a href="{{ route('admin.travel-agency.tour-packages.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*tour-packages*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*tour-packages*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('travel-agency/tour-packages.TourPackages') }}</span>
    </a>

</div>
