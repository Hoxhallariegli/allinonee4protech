<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.Auto Repair Management') }}</x-nav.divider>

    {{-- Dashboard --}}
    <a href="/modular/auto-repair-management/auto-repair-management/dashboard"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*/auto-repair-management/dashboard') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*/auto-repair-management/dashboard') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    {{-- Landing Page --}}
    <a href="/auto-repair-management"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    {{-- Customers --}}
    <a href="/modular/auto-repair-management/auto-repair-management/customers"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*customers*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*customers*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/customers.Customers') }}</span>
    </a>

    {{-- Vehicle Brands --}}
    <a href="/modular/auto-repair-management/auto-repair-management/vehicle-brands"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*vehicle-brands*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*vehicle-brands*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/vehicle-brands.VehicleBrands') }}</span>
    </a>

    {{-- Vehicle Models --}}
    <a href="/modular/auto-repair-management/auto-repair-management/vehicle-models"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*vehicle-models*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*vehicle-models*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/vehicle-models.VehicleModels') }}</span>
    </a>

    {{-- Vehicles --}}
    <a href="/modular/auto-repair-management/auto-repair-management/vehicles"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*vehicles*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*vehicles*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/vehicles.Vehicles') }}</span>
    </a>

    {{-- Vehicle Documents --}}
    <a href="/modular/auto-repair-management/auto-repair-management/vehicle-documents"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*vehicle-documents*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*vehicle-documents*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/vehicle-documents.VehicleDocuments') }}</span>
    </a>

    {{-- Employees --}}
    <a href="/modular/auto-repair-management/auto-repair-management/employees"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*employees*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*employees*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/employees.Employees') }}</span>
    </a>

    {{-- Mechanics --}}
    <a href="/modular/auto-repair-management/auto-repair-management/mechanics"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*mechanics*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*mechanics*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/mechanics.Mechanics') }}</span>
    </a>

    {{-- Job Cards --}}
    <a href="/modular/auto-repair-management/auto-repair-management/job-cards"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*job-cards*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*job-cards*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/job-cards.JobCards') }}</span>
    </a>

    {{-- Services --}}
    <a href="/modular/auto-repair-management/auto-repair-management/services"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*services*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*services*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/services.Services') }}</span>
    </a>

    {{-- Parts --}}
    <a href="/modular/auto-repair-management/auto-repair-management/parts"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*parts*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*parts*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/parts.Parts') }}</span>
    </a>

    {{-- Inventories --}}
    <a href="/modular/auto-repair-management/auto-repair-management/inventories"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*inventories*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*inventories*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/inventories.Inventories') }}</span>
    </a>

    {{-- Job Card Services --}}
    <a href="/modular/auto-repair-management/auto-repair-management/job-card-services"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*job-card-services*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*job-card-services*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/job-card-services.JobCardServices') }}</span>
    </a>

    {{-- Job Card Parts --}}
    <a href="/modular/auto-repair-management/auto-repair-management/job-card-parts"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*job-card-parts*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*job-card-parts*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/job-card-parts.JobCardParts') }}</span>
    </a>

    {{-- Suppliers --}}
    <a href="/modular/auto-repair-management/auto-repair-management/suppliers"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*suppliers*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*suppliers*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/suppliers.Suppliers') }}</span>
    </a>

    {{-- Purchase Orders --}}
    <a href="/modular/auto-repair-management/auto-repair-management/purchase-orders"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*purchase-orders*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*purchase-orders*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/purchase-orders.PurchaseOrders') }}</span>
    </a>

    {{-- Purchase Order Items --}}
    <a href="/modular/auto-repair-management/auto-repair-management/purchase-order-items"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*purchase-order-items*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*purchase-order-items*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/purchase-order-items.PurchaseOrderItems') }}</span>
    </a>

    {{-- Estimates --}}
    <a href="/modular/auto-repair-management/auto-repair-management/estimates"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*estimates*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*estimates*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/estimates.Estimates') }}</span>
    </a>

    {{-- Estimate Items --}}
    <a href="/modular/auto-repair-management/auto-repair-management/estimate-items"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*estimate-items*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*estimate-items*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/estimate-items.EstimateItems') }}</span>
    </a>

    {{-- Invoices --}}
    <a href="/modular/auto-repair-management/auto-repair-management/invoices"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*invoices*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*invoices*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/invoices.Invoices') }}</span>
    </a>

    {{-- Invoice Items --}}
    <a href="/modular/auto-repair-management/auto-repair-management/invoice-items"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*invoice-items*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*invoice-items*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/invoice-items.InvoiceItems') }}</span>
    </a>

    {{-- Appointments --}}
    <a href="/modular/auto-repair-management/auto-repair-management/appointments"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*appointments*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*appointments*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/appointments.Appointments') }}</span>
    </a>

    {{-- Reports --}}
    <a href="/modular/auto-repair-management/auto-repair-management/reports"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*reports*') ? 'bg-amber-50 text-amber-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*reports*') ? 'bg-amber-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('auto-repair-management/reports.Reports') }}</span>
    </a>

</div>
