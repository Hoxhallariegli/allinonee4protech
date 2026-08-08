<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.Restaurant POS') }}</x-nav.divider>

    {{-- Dashboard --}}
    <a href="/modular/restaurant-p-o-s/restaurant-p-o-s/dashboard"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*/restaurant-p-o-s/dashboard') ? 'bg-orange-50 text-orange-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*/restaurant-p-o-s/dashboard') ? 'bg-orange-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    {{-- Landing Page --}}
    <a href="/restaurant-p-o-s"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    {{-- Waiters --}}
    <a href="/modular/restaurant-p-o-s/restaurant-p-o-s/waiters"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*waiters*') ? 'bg-orange-50 text-orange-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*waiters*') ? 'bg-orange-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('restaurant-p-o-s/waiters.Waiters') }}</span>
    </a>

    {{-- Dining Tables --}}
    <a href="/modular/restaurant-p-o-s/restaurant-p-o-s/dining-tables"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*dining-tables*') ? 'bg-orange-50 text-orange-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*dining-tables*') ? 'bg-orange-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('restaurant-p-o-s/dining-tables.DiningTables') }}</span>
    </a>

    {{-- Menu Items --}}
    <a href="/modular/restaurant-p-o-s/restaurant-p-o-s/menu-items"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*menu-items*') ? 'bg-orange-50 text-orange-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*menu-items*') ? 'bg-orange-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('restaurant-p-o-s/menu-items.MenuItems') }}</span>
    </a>

    {{-- Orders --}}
    <a href="/modular/restaurant-p-o-s/restaurant-p-o-s/orders"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*orders*') ? 'bg-orange-50 text-orange-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*orders*') ? 'bg-orange-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('restaurant-p-o-s/orders.Orders') }}</span>
    </a>

    {{-- Order Items --}}
    <a href="/modular/restaurant-p-o-s/restaurant-p-o-s/order-items"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*order-items*') ? 'bg-orange-50 text-orange-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*order-items*') ? 'bg-orange-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('restaurant-p-o-s/order-items.OrderItems') }}</span>
    </a>

    {{-- Payments --}}
    <a href="/modular/restaurant-p-o-s/restaurant-p-o-s/payments"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*payments*') ? 'bg-orange-50 text-orange-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*payments*') ? 'bg-orange-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('restaurant-p-o-s/payments.Payments') }}</span>
    </a>

</div>
