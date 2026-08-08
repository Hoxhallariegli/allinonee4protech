<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.Fleet Management') }}</x-nav.divider>

    @php
        $activeClass = 'bg-gray-50 text-gray-600 dark:bg-gray-700/50 dark:text-gray-300';
        $inactiveClass = 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white';
        $dotActiveClass = 'bg-gray-600';
        $dotInactiveClass = 'bg-gray-300 dark:bg-gray-700';
    @endphp

    <a href="{{ route('admin.fleet-management.dashboard') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*dashboard*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*dashboard*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    <a href="/fleet-management"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    <a href="{{ route('admin.fleet-management.drivers.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*drivers*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*drivers*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('fleet-management/drivers.Drivers') }}</span>
    </a>

    <a href="{{ route('admin.fleet-management.fuel-logs.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*fuel-logs*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*fuel-logs*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('fleet-management/fuel-logs.FuelLogs') }}</span>
    </a>

    <a href="{{ route('admin.fleet-management.shipments.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*shipments*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*shipments*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('fleet-management/shipments.Shipments') }}</span>
    </a>

    <a href="{{ route('admin.fleet-management.trips.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*trips*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*trips*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('fleet-management/trips.Trips') }}</span>
    </a>

    <a href="{{ route('admin.fleet-management.vehicles.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*vehicles*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*vehicles*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('fleet-management/vehicles.Vehicles') }}</span>
    </a>

</div>
