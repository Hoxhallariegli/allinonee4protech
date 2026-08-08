<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.Construction ERP') }}</x-nav.divider>

    @php
        // Emerald colors for Construction ERP
        $activeClass = 'bg-emerald-50 text-emerald-600 dark:bg-emerald-900/50 dark:text-emerald-400';
        $inactiveClass = 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white';
        $dotActiveClass = 'bg-emerald-600';
        $dotInactiveClass = 'bg-gray-300 dark:bg-gray-700';
    @endphp

    {{-- Dashboard --}}
    <a href="/admin/construction-e-r-p/dashboard"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*dashboard*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*dashboard*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    <a href="/construction-e-r-p"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    {{-- Clients --}}
    <a href="/admin/construction-e-r-p/clients"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*clients*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*clients*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('construction-e-r-p/clients.Clients') }}</span>
    </a>

    {{-- Projects --}}
    <a href="/admin/construction-e-r-p/projects"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*projects*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*projects*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('construction-e-r-p/projects.Projects') }}</span>
    </a>

    {{-- Buildings --}}
    <a href="/admin/construction-e-r-p/buildings"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*buildings*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*buildings*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('construction-e-r-p/buildings.Buildings') }}</span>
    </a>

    {{-- Apartments --}}
    <a href="/admin/construction-e-r-p/apartments"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*apartments*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*apartments*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('construction-e-r-p/apartments.Apartments') }}</span>
    </a>

    {{-- Employees --}}
    <a href="/admin/construction-e-r-p/employees"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*employees*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*employees*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('construction-e-r-p/employees.Employees') }}</span>
    </a>

    {{-- Suppliers --}}
    <a href="/admin/construction-e-r-p/suppliers"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*suppliers*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*suppliers*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('construction-e-r-p/suppliers.Suppliers') }}</span>
    </a>

    {{-- Subcontractors --}}
    <a href="/admin/construction-e-r-p/subcontractors"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*subcontractors*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*subcontractors*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('construction-e-r-p/subcontractors.Subcontractors') }}</span>
    </a>

    {{-- Materials --}}
    <a href="/admin/construction-e-r-p/materials"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*materials*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*materials*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('construction-e-r-p/materials.Materials') }}</span>
    </a>

    {{-- Heavy Machineries --}}
    <a href="/admin/construction-e-r-p/heavy-machineries"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*heavy-machineries*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*heavy-machineries*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('construction-e-r-p/heavy-machineries.HeavyMachineries') }}</span>
    </a>

    {{-- Purchase Orders --}}
    <a href="/admin/construction-e-r-p/purchase-orders"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*purchase-orders*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*purchase-orders*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('construction-e-r-p/purchase-orders.PurchaseOrders') }}</span>
    </a>

    {{-- Payments --}}
    <a href="/admin/construction-e-r-p/payments"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*payments*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*payments*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('construction-e-r-p/payments.Payments') }}</span>
    </a>

    {{-- Contracts --}}
    <a href="/admin/construction-e-r-p/contracts"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*contracts*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*contracts*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('construction-e-r-p/contracts.Contracts') }}</span>
    </a>

    {{-- Progress Reports --}}
    <a href="/admin/construction-e-r-p/progress-reports"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*progress-reports*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*progress-reports*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('construction-e-r-p/progress-reports.ProgressReports') }}</span>
    </a>

</div>
