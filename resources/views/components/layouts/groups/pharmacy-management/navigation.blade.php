<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.Pharmacy Management') }}</x-nav.divider>

    @php
        $activeClass = 'bg-green-50 text-green-600 dark:bg-green-900/50 dark:text-green-400';
        $inactiveClass = 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white';
        $dotActiveClass = 'bg-green-600';
        $dotInactiveClass = 'bg-gray-300 dark:bg-gray-700';
    @endphp

    <a href="{{ route('admin.pharmacy-management.dashboard') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*dashboard*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*dashboard*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    <a href="/pharmacy-management"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    <a href="{{ route('admin.pharmacy-management.medicines.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*medicines*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*medicines*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('pharmacy-management/medicines.Medicines') }}</span>
    </a>

    <a href="{{ route('admin.pharmacy-management.prescriptions.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*prescriptions*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*prescriptions*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('pharmacy-management/prescriptions.Prescriptions') }}</span>
    </a>

    <a href="{{ route('admin.pharmacy-management.prescription-items.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*prescription-items*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*prescription-items*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('pharmacy-management/prescription-items.PrescriptionItems') }}</span>
    </a>

    <a href="{{ route('admin.pharmacy-management.sales.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*sales*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*sales*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('pharmacy-management/sales.Sales') }}</span>
    </a>

    <a href="{{ route('admin.pharmacy-management.suppliers.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*suppliers*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*suppliers*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('pharmacy-management/suppliers.Suppliers') }}</span>
    </a>

</div>
