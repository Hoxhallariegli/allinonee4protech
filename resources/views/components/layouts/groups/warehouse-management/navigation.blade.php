<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.Warehouse Management') }}</x-nav.divider>

    @php
        $activeClass = 'bg-indigo-50 text-indigo-600 dark:bg-indigo-900/50 dark:text-indigo-400';
        $inactiveClass = 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white';
        $dotActiveClass = 'bg-indigo-600';
        $dotInactiveClass = 'bg-gray-300 dark:bg-gray-700';
    @endphp

    {{-- Dashboard --}}
    <a href="/admin/warehouse-management/dashboard"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*dashboard*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*dashboard*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    {{-- Landing Page --}}
    <a href="/warehouse-management"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    {{-- Categories --}}
    <a href="/admin/warehouse-management/categories"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*categories*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*categories*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('warehouse-management/categories.Categories') }}</span>
    </a>

    {{-- Suppliers --}}
    <a href="/admin/warehouse-management/suppliers"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*suppliers*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*suppliers*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('warehouse-management/suppliers.Suppliers') }}</span>
    </a>

    {{-- Customers --}}
    <a href="/admin/warehouse-management/customers"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*customers*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*customers*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('warehouse-management/customers.Customers') }}</span>
    </a>

    {{-- Customer Addresses --}}
    <a href="/admin/warehouse-management/customer-addresses"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*customer-addresses*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*customer-addresses*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('warehouse-management/customer-addresses.CustomerAddresses') }}</span>
    </a>

    {{-- Warehouses --}}
    <a href="/admin/warehouse-management/warehouses"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*warehouses*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*warehouses*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('warehouse-management/warehouses.Warehouses') }}</span>
    </a>

    {{-- Products --}}
    <a href="/admin/warehouse-management/products"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*products*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*products*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('warehouse-management/products.Products') }}</span>
    </a>

    {{-- Employees --}}
    <a href="/admin/warehouse-management/employees"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*employees*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*employees*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('warehouse-management/employees.Employees') }}</span>
    </a>

    {{-- Purchase Orders --}}
    <a href="/admin/warehouse-management/purchase-orders"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*purchase-orders*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*purchase-orders*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('warehouse-management/purchase-orders.PurchaseOrders') }}</span>
    </a>

    {{-- Sales --}}
    <a href="/admin/warehouse-management/sales"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*sales*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*sales*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('warehouse-management/sales.Sales') }}</span>
    </a>

    {{-- Stock Transfers --}}
    <a href="/admin/warehouse-management/stock-transfers"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*stock-transfers*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*stock-transfers*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('warehouse-management/stock-transfers.StockTransfers') }}</span>
    </a>

    {{-- Stock Adjustments --}}
    <a href="/admin/warehouse-management/stock-adjustments"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*stock-adjustments*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*stock-adjustments*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('warehouse-management/stock-adjustments.StockAdjustments') }}</span>
    </a>

</div>
