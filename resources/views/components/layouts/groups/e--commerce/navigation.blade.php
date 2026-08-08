<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.E-Commerce') }}</x-nav.divider>

    @php
        $activeClass = 'bg-pink-50 text-pink-600 dark:bg-pink-900/50 dark:text-pink-400';
        $inactiveClass = 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white';
        $dotActiveClass = 'bg-pink-600';
        $dotInactiveClass = 'bg-gray-300 dark:bg-gray-700';
    @endphp

    <a href="{{ route('admin.e--commerce.dashboard') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*dashboard*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*dashboard*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    <a href="/e--commerce"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    <a href="{{ route('admin.e--commerce.customers.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*customers*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*customers*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('e--commerce/customers.Customers') }}</span>
    </a>

    <a href="{{ route('admin.e--commerce.orders.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*orders*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*orders*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('e--commerce/orders.Orders') }}</span>
    </a>

    <a href="{{ route('admin.e--commerce.order-items.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*order-items*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*order-items*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('e--commerce/order-items.OrderItems') }}</span>
    </a>

    <a href="{{ route('admin.e--commerce.products.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*products*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*products*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('e--commerce/products.Products') }}</span>
    </a>

    <a href="{{ route('admin.e--commerce.vendors.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*vendors*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*vendors*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('e--commerce/vendors.Vendors') }}</span>
    </a>

</div>
