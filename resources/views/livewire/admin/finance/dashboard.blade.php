
<div class="space-y-8" x-data="{ init() {
    new ApexCharts(this.$refs.chart, {
        series: [{ name: 'Accounts (€)', data: @js($chartData['accounts']) }, { name: 'Budgets', data: @js($chartData['budgets']) }, { name: 'Categories', data: @js($chartData['categories']) }, { name: 'Documents', data: @js($chartData['documents']) }, { name: 'Expenses (€)', data: @js($chartData['expenses']) }, { name: 'Transactions (€)', data: @js($chartData['transactions']) }, ],
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
            <x-h1>{{ __('admin.Finance Dashboard') }}</x-h1>
            <x-short-description class="dark:text-gray-400">{{ __('Operational and financial insights for') }} Finance</x-short-description>
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
                    <p class="text-[10px] font-black uppercase tracking-[0.1em] text-gray-400 dark:text-gray-500 mb-1">Accounts Total</p>
                    <p class="text-2xl font-bold dark:text-white tracking-tight">€{{ number_format($stats['accounts_sum'] ?? 0, 2) }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-[2rem] border-l-4 border-emerald-500 shadow-sm border-y border-r border-gray-100 dark:border-gray-700/50">
                    <p class="text-[10px] font-black uppercase tracking-[0.1em] text-gray-400 dark:text-gray-500 mb-1">Expenses Total</p>
                    <p class="text-2xl font-bold dark:text-white tracking-tight">€{{ number_format($stats['expenses_sum'] ?? 0, 2) }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-[2rem] border-l-4 border-amber-500 shadow-sm border-y border-r border-gray-100 dark:border-gray-700/50">
                    <p class="text-[10px] font-black uppercase tracking-[0.1em] text-gray-400 dark:text-gray-500 mb-1">Transactions Total</p>
                    <p class="text-2xl font-bold dark:text-white tracking-tight">€{{ number_format($stats['transactions_sum'] ?? 0, 2) }}</p>
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
            <a href="{{ route('admin.finance.accounts.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Accounts</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['accounts'] }}</p>
            </a>
            <a href="{{ route('admin.finance.budgets.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Budgets</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['budgets'] }}</p>
            </a>
            <a href="{{ route('admin.finance.categories.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Categories</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['categories'] }}</p>
            </a>
            <a href="{{ route('admin.finance.documents.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Documents</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['documents'] }}</p>
            </a>
            <a href="{{ route('admin.finance.expenses.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Expenses</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['expenses'] }}</p>
            </a>
            <a href="{{ route('admin.finance.transactions.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Transactions</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['transactions'] }}</p>
            </a></div>
    </div>
</div>