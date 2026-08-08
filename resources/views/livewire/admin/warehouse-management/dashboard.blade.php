
<div class="space-y-8" x-data="{ init() {
    new ApexCharts(this.$refs.chart, {
        series: [{ name: 'Categories', data: @js($chartData['categories']) }, { name: 'Customers', data: @js($chartData['customers']) }, { name: 'Customer Addresses', data: @js($chartData['customerAddresses']) }, { name: 'Employees', data: @js($chartData['employees']) }, { name: 'Products (€)', data: @js($chartData['products']) }, { name: 'Sales', data: @js($chartData['sales']) }, ],
        chart: { height: 350, type: 'area', toolbar: {show:false}, zoom: {enabled:false}, fontFamily: 'inherit' },
        stroke: { curve: 'smooth', width: 3 },
        dataLabels: { enabled: false },
        fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.2, opacityTo: 0 } },
        xaxis: { categories: @js($days), axisBorder: {show:false}, axisTicks: {show:false} },
        yaxis: { labels: { show: false } },
        grid: { borderColor: '#f1f1f1', strokeDashArray: 4, padding: {left:10, right:10} },
        colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#6366f1'],
        legend: { position: 'top', horizontalAlign: 'right', fontWeight: 600, fontSize: '12px' }
    }).render();
}}">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div class="flex items-end justify-between">
        <div>
            <x-h1>{{ __('admin.Warehouse Management Dashboard') }}</x-h1>
            <x-short-description class="dark:text-gray-400">{{ __('Operational and financial insights for') }} Warehouse Management</x-short-description>
        </div>
        <div class="hidden md:block">
            <div class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-[10px] font-black uppercase text-gray-400 tracking-widest">
                <span class="size-2 rounded-full bg-blue-500 animate-pulse"></span>
                {{ __('Real-time Analytics') }}
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-[2rem] border-l-4 border-blue-500 shadow-sm border-y border-r border-gray-100 dark:border-gray-700/50">
                    <p class="text-[10px] font-black uppercase tracking-[0.1em] text-gray-400 dark:text-gray-500 mb-1">Products Total</p>
                    <p class="text-2xl font-bold dark:text-white tracking-tight">€{{ number_format($stats['products_sum'] ?? 0, 2) }}</p>
                </div></div>

    <div class="bg-white dark:bg-gray-800 p-8 rounded-[2.5rem] border border-gray-100 dark:border-gray-700/50 shadow-sm">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-sm font-black uppercase tracking-widest text-gray-400">{{ __('Growth Trend (Last 7 Days)') }}</h3>
        </div>
        <div x-ref="chart" class="min-h-[350px]"></div>
    </div>

    <div class="space-y-6">
        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 dark:text-gray-500">{{ __('Operational Metrics') }}</h4>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            <a href="{{ route('admin.warehouse-management.categories.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Categories</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['categories'] }}</p>
            </a>
            <a href="{{ route('admin.warehouse-management.customers.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Customers</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['customers'] }}</p>
            </a>
            <a href="{{ route('admin.warehouse-management.customer-addresses.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Customer Addresses</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['customerAddresses'] }}</p>
            </a>
            <a href="{{ route('admin.warehouse-management.employees.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Employees</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['employees'] }}</p>
            </a>
            <a href="{{ route('admin.warehouse-management.products.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Products</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['products'] }}</p>
            </a>
            <a href="{{ route('admin.warehouse-management.sales.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Sales</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['sales'] }}</p>
            </a>
            <a href="{{ route('admin.warehouse-management.stock-adjustments.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Stock Adjustments</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['stockAdjustments'] }}</p>
            </a>
            <a href="{{ route('admin.warehouse-management.stock-transfers.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Stock Transfers</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['stockTransfers'] }}</p>
            </a>
            <a href="{{ route('admin.warehouse-management.suppliers.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Suppliers</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['suppliers'] }}</p>
            </a>
            <a href="{{ route('admin.warehouse-management.warehouses.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Warehouses</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['warehouses'] }}</p>
            </a></div>
    </div>
</div>