
<div class="space-y-8" x-data="{ init() {
    new ApexCharts(this.$refs.chart, {
        series: [{ name: 'Agents', data: @js($chartData['agents']) }, { name: 'Clients', data: @js($chartData['clients']) }, { name: 'Client Addresses', data: @js($chartData['clientAddresses']) }, { name: 'Contracts (€)', data: @js($chartData['contracts']) }, { name: 'Owners', data: @js($chartData['owners']) }, { name: 'Payments (€)', data: @js($chartData['payments']) }, ],
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
            <x-h1>{{ __('admin.Real Estate CRM Dashboard') }}</x-h1>
            <x-short-description class="dark:text-gray-400">{{ __('Operational and financial insights for') }} Real Estate CRM</x-short-description>
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
                    <p class="text-[10px] font-black uppercase tracking-[0.1em] text-gray-400 dark:text-gray-500 mb-1">Contracts Total</p>
                    <p class="text-2xl font-bold dark:text-white tracking-tight">€{{ number_format($stats['contracts_sum'] ?? 0, 2) }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-[2rem] border-l-4 border-emerald-500 shadow-sm border-y border-r border-gray-100 dark:border-gray-700/50">
                    <p class="text-[10px] font-black uppercase tracking-[0.1em] text-gray-400 dark:text-gray-500 mb-1">Payments Total</p>
                    <p class="text-2xl font-bold dark:text-white tracking-tight">€{{ number_format($stats['payments_sum'] ?? 0, 2) }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-[2rem] border-l-4 border-amber-500 shadow-sm border-y border-r border-gray-100 dark:border-gray-700/50">
                    <p class="text-[10px] font-black uppercase tracking-[0.1em] text-gray-400 dark:text-gray-500 mb-1">Properties Total</p>
                    <p class="text-2xl font-bold dark:text-white tracking-tight">€{{ number_format($stats['properties_sum'] ?? 0, 2) }}</p>
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
            <a href="{{ route('admin.real-estate-c-r-m.agents.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Agents</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['agents'] }}</p>
            </a>
            <a href="{{ route('admin.real-estate-c-r-m.clients.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Clients</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['clients'] }}</p>
            </a>
            <a href="{{ route('admin.real-estate-c-r-m.client-addresses.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Client Addresses</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['clientAddresses'] }}</p>
            </a>
            <a href="{{ route('admin.real-estate-c-r-m.contracts.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Contracts</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['contracts'] }}</p>
            </a>
            <a href="{{ route('admin.real-estate-c-r-m.owners.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Owners</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['owners'] }}</p>
            </a>
            <a href="{{ route('admin.real-estate-c-r-m.payments.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Payments</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['payments'] }}</p>
            </a>
            <a href="{{ route('admin.real-estate-c-r-m.properties.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Properties</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['properties'] }}</p>
            </a>
            <a href="{{ route('admin.real-estate-c-r-m.property-visits.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Property Visits</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['propertyVisits'] }}</p>
            </a></div>
    </div>
</div>