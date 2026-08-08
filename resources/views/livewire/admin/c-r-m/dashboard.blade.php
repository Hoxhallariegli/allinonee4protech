
<div class="space-y-8" x-data="{ init() {
    new ApexCharts(this.$refs.chart, {
        series: [{ name: 'Companies', data: @js($chartData['companies']) }, { name: 'Contacts', data: @js($chartData['contacts']) }, { name: 'Contact Addresses', data: @js($chartData['contactAddresses']) }, { name: 'Deals', data: @js($chartData['deals']) }, { name: 'Interactions', data: @js($chartData['interactions']) }, { name: 'Leads', data: @js($chartData['leads']) }, ],
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
            <x-h1>{{ __('admin.CRM Dashboard') }}</x-h1>
            <x-short-description class="dark:text-gray-400">{{ __('Operational and financial insights for') }} CRM</x-short-description>
        </div>
        <div class="hidden md:block">
            <div class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl text-[10px] font-black uppercase text-gray-400 tracking-widest">
                <span class="size-2 rounded-full bg-blue-500 animate-pulse"></span>
                {{ __('Real-time Analytics') }}
            </div>
        </div>
    </div>

    

    <div class="bg-white dark:bg-gray-800 p-8 rounded-[2.5rem] border border-gray-100 dark:border-gray-700/50 shadow-sm">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-sm font-black uppercase tracking-widest text-gray-400">{{ __('Growth Trend (Last 7 Days)') }}</h3>
        </div>
        <div x-ref="chart" class="min-h-[350px]"></div>
    </div>

    <div class="space-y-6">
        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 dark:text-gray-500">{{ __('Operational Metrics') }}</h4>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            <a href="{{ route('admin.c-r-m.companies.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Companies</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['companies'] }}</p>
            </a>
            <a href="{{ route('admin.c-r-m.contacts.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Contacts</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['contacts'] }}</p>
            </a>
            <a href="{{ route('admin.c-r-m.contact-addresses.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Contact Addresses</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['contactAddresses'] }}</p>
            </a>
            <a href="{{ route('admin.c-r-m.deals.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Deals</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['deals'] }}</p>
            </a>
            <a href="{{ route('admin.c-r-m.interactions.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Interactions</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['interactions'] }}</p>
            </a>
            <a href="{{ route('admin.c-r-m.leads.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Leads</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['leads'] }}</p>
            </a>
            <a href="{{ route('admin.c-r-m.tasks.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Tasks</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['tasks'] }}</p>
            </a></div>
    </div>
</div>