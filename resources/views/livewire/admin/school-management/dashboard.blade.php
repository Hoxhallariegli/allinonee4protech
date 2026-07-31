
<div class="space-y-8" x-data="{ init() {
    new ApexCharts(this.$refs.chart, {
        series: [{ name: 'Attendances', data: @js($chartData['attendances']) }, { name: 'Exams', data: @js($chartData['exams']) }, { name: 'Grades', data: @js($chartData['grades']) }, { name: 'Guardians', data: @js($chartData['guardians']) }, { name: 'Payments (€)', data: @js($chartData['payments']) }, { name: 'School Classes', data: @js($chartData['schoolClasses']) }, ],
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
            <x-h1>{{ __('admin.School Management Dashboard') }}</x-h1>
            <x-short-description class="dark:text-gray-400">{{ __('Operational and financial insights for') }} School Management</x-short-description>
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
                    <p class="text-[10px] font-black uppercase tracking-[0.1em] text-gray-400 dark:text-gray-500 mb-1">Payments Total</p>
                    <p class="text-2xl font-bold dark:text-white tracking-tight">€{{ number_format($stats['payments_sum'] ?? 0, 2) }}</p>
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
            <a href="{{ route('admin.school-management.attendances.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Attendances</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['attendances'] }}</p>
            </a>
            <a href="{{ route('admin.school-management.exams.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Exams</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['exams'] }}</p>
            </a>
            <a href="{{ route('admin.school-management.grades.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Grades</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['grades'] }}</p>
            </a>
            <a href="{{ route('admin.school-management.guardians.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Guardians</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['guardians'] }}</p>
            </a>
            <a href="{{ route('admin.school-management.payments.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Payments</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['payments'] }}</p>
            </a>
            <a href="{{ route('admin.school-management.school-classes.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">School Classes</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['schoolClasses'] }}</p>
            </a>
            <a href="{{ route('admin.school-management.students.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Students</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['students'] }}</p>
            </a>
            <a href="{{ route('admin.school-management.teachers.index') }}" wire:navigate class="group bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 hover:border-blue-500/50 hover:shadow-md transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-2 bg-gray-50 dark:bg-gray-900 rounded-xl text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition-colors"><x-heroicon-o-cube class="size-4"/></div>
                    <span class="text-[10px] font-bold text-gray-300 dark:text-gray-600 group-hover:text-blue-400">View All</span>
                </div>
                <p class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-0.5">Teachers</p>
                <p class="text-lg font-bold dark:text-white">{{ $stats['teachers'] }}</p>
            </a></div>
    </div>
</div>