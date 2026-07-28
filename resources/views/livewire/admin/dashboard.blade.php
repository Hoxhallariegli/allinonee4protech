<div class="space-y-10">
    <div class="px-1 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <x-h1>{{ __('admin.Dashboard') }}</x-h1>
            <x-short-description>Welcome back. Here's what's happening in your garage today.</x-short-description>
        </div>
        <div class="flex items-center gap-3">
            <x-button variant="gray" class="!bg-white dark:!bg-zinc-900 border border-zinc-200 dark:border-zinc-800 !py-2.5 !rounded-2xl shadow-sm text-xs font-black uppercase tracking-tighter transition-all hover:scale-[1.02] active:scale-[0.98]">
                <x-heroicon-o-arrow-path class="size-4 mr-2" />
                Refresh Data
            </x-button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-1">
        <!-- Total Customers -->
        <div class="card !p-6 flex items-center gap-5 bg-white dark:bg-zinc-900 border-zinc-100 dark:border-zinc-800 shadow-sm transition-all hover:shadow-md hover:border-blue-100 dark:hover:border-blue-900/30 group">
            <div class="size-14 rounded-2xl bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform">
                <x-heroicon-o-users class="size-7" />
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Customers</p>
                <p class="text-3xl font-black text-zinc-900 dark:text-white tracking-tighter">{{ number_format($stats['total_customers']) }}</p>
            </div>
        </div>

        <!-- Total Vehicles -->
        <div class="card !p-6 flex items-center gap-5 bg-white dark:bg-zinc-900 border-zinc-100 dark:border-zinc-800 shadow-sm transition-all hover:shadow-md hover:border-indigo-100 dark:hover:border-indigo-900/30 group">
            <div class="size-14 rounded-2xl bg-indigo-50 dark:bg-indigo-900/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform">
                <x-heroicon-o-truck class="size-7" />
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Vehicles</p>
                <p class="text-3xl font-black text-zinc-900 dark:text-white tracking-tighter">{{ number_format($stats['total_vehicles']) }}</p>
            </div>
        </div>

        <!-- Active Job Cards -->
        <div class="card !p-6 flex items-center gap-5 bg-white dark:bg-zinc-900 border-zinc-100 dark:border-zinc-800 shadow-sm transition-all hover:shadow-md hover:border-amber-100 dark:hover:border-amber-900/30 group">
            <div class="size-14 rounded-2xl bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center text-amber-600 dark:text-amber-400 group-hover:scale-110 transition-transform">
                <x-heroicon-o-clipboard-document-list class="size-7" />
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Active Jobs</p>
                <p class="text-3xl font-black text-zinc-900 dark:text-white tracking-tighter">{{ number_format($stats['active_job_cards']) }}</p>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="card !p-6 flex items-center gap-5 bg-white dark:bg-zinc-900 border-zinc-100 dark:border-zinc-800 shadow-sm transition-all hover:shadow-md hover:border-emerald-100 dark:hover:border-emerald-900/30 group">
            <div class="size-14 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform">
                <x-heroicon-o-banknotes class="size-7" />
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Revenue</p>
                <p class="text-3xl font-black text-zinc-900 dark:text-white tracking-tighter">${{ number_format($stats['total_revenue'], 0) }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Recent Job Cards -->
        <div class="card !p-0 overflow-hidden bg-white dark:bg-zinc-900 border-zinc-100 dark:border-zinc-800 shadow-sm">
            <div class="p-6 border-b border-zinc-50 dark:border-zinc-800/50 flex items-center justify-between bg-zinc-50/50 dark:bg-zinc-800/20">
                <div>
                    <h3 class="text-sm font-black uppercase tracking-widest text-zinc-900 dark:text-white">Recent Job Cards</h3>
                    <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-tight">Latest workshop activities</p>
                </div>
                @if(Route::has('admin.job-cards.index'))
                    <a href="{{ route('admin.job-cards.index') }}" class="px-4 py-1.5 bg-zinc-100 dark:bg-zinc-800 rounded-xl text-[10px] font-black uppercase text-zinc-600 dark:text-zinc-400 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-600 transition-all shadow-sm">View All</a>
                @endif
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-zinc-50/30 dark:bg-zinc-800/10">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-black uppercase text-zinc-400 tracking-widest">ID</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase text-zinc-400 tracking-widest">Vehicle / Customer</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase text-zinc-400 tracking-widest text-center">Status</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase text-zinc-400 tracking-widest text-right">Created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-50 dark:divide-zinc-800/50">
                        @forelse($recentJobCards as $jc)
                            <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/50 transition-colors group">
                                <td class="px-6 py-5 font-black text-blue-600 dark:text-blue-400">#{{ $jc->id }}</td>
                                <td class="px-6 py-5">
                                    <div class="font-bold text-zinc-900 dark:text-white group-hover:text-blue-600 transition-colors">{{ $jc->vehicle->license_plate ?? 'N/A' }}</div>
                                    <div class="text-[10px] text-zinc-400 font-medium tracking-tight">{{ $jc->customer->name ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="px-3 py-1 text-[9px] font-black uppercase rounded-full {{ $jc->status === 'opened' ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/20' : 'bg-amber-50 text-amber-600 dark:bg-amber-900/20' }}">
                                        {{ $jc->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-[10px] font-bold text-zinc-400 text-right">{{ $jc->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <x-heroicon-o-clipboard class="size-8 text-zinc-200 dark:text-zinc-800" />
                                        <p class="text-xs text-zinc-400 font-bold uppercase tracking-widest">No recent job cards</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Upcoming Appointments -->
        <div class="card !p-0 overflow-hidden bg-white dark:bg-zinc-900 border-zinc-100 dark:border-zinc-800 shadow-sm">
            <div class="p-6 border-b border-zinc-50 dark:border-zinc-800/50 flex items-center justify-between bg-zinc-50/50 dark:bg-zinc-800/20">
                <div>
                    <h3 class="text-sm font-black uppercase tracking-widest text-zinc-900 dark:text-white">Scheduled Appointments</h3>
                    <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-tight">Upcoming vehicle services</p>
                </div>
                @if(Route::has('admin.appointments.index'))
                    <a href="{{ route('admin.appointments.index') }}" class="px-4 py-1.5 bg-zinc-100 dark:bg-zinc-800 rounded-xl text-[10px] font-black uppercase text-zinc-600 dark:text-zinc-400 hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-600 transition-all shadow-sm">View All</a>
                @endif
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-zinc-50/30 dark:bg-zinc-800/10">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-black uppercase text-zinc-400 tracking-widest">Appointment Date</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase text-zinc-400 tracking-widest">Vehicle ID</th>
                            <th class="px-6 py-4 text-[10px] font-black uppercase text-zinc-400 tracking-widest text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-50 dark:divide-zinc-800/50">
                        @forelse($upcomingAppointments as $app)
                            <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/50 transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="font-black text-zinc-900 dark:text-white">{{ $app->appointment_date->format('M d, Y') }}</div>
                                    <div class="text-[10px] text-zinc-400 font-bold tracking-widest uppercase">{{ $app->appointment_date->format('H:i A') }}</div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="font-bold text-zinc-700 dark:text-zinc-300">{{ $app->vehicle->license_plate ?? 'Vehicle #'.$app->vehicle_id }}</div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="px-3 py-1 text-[9px] font-black uppercase rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">
                                        {{ $app->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <x-heroicon-o-calendar class="size-8 text-zinc-200 dark:text-zinc-800" />
                                        <p class="text-xs text-zinc-400 font-bold uppercase tracking-widest">No upcoming appointments</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
         <!-- Inventory Alerts -->
         <div class="lg:col-span-1">
            <div class="card border-red-100 dark:border-red-900/20 bg-red-50/5 dark:bg-red-900/5 !p-8 h-full shadow-sm">
                <div class="flex items-center gap-3 mb-8">
                    <div class="size-10 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-400 shadow-inner">
                        <x-heroicon-o-exclamation-triangle class="size-6" />
                    </div>
                    <div>
                        <h3 class="text-sm font-black uppercase tracking-widest text-red-600 dark:text-red-400">Critical Stock</h3>
                        <p class="text-[9px] font-bold text-red-400 uppercase tracking-tighter">Items needing reorder</p>
                    </div>
                </div>
                <div class="space-y-4">
                    @forelse($lowStockParts as $part)
                        <div class="flex items-center justify-between p-4 bg-white dark:bg-zinc-900 rounded-2xl border border-red-50 dark:border-red-900/20 shadow-sm transition-transform hover:scale-[1.01]">
                            <div>
                                <div class="text-xs font-black text-zinc-900 dark:text-white truncate max-w-[120px]">{{ $part->name }}</div>
                                <div class="text-[10px] font-bold text-zinc-400 tracking-tighter">Level: <span class="text-red-600 font-black">{{ $part->stock }}</span></div>
                            </div>
                            @if(Route::has('admin.parts.edit'))
                                <x-a href="{{ route('admin.parts.edit', ['part' => $part->id]) }}" class="!p-2 !rounded-xl !bg-zinc-50 dark:!bg-zinc-800 hover:!bg-red-600 hover:!text-white transition-all group">
                                    <x-heroicon-o-pencil-square class="size-4 text-zinc-400 group-hover:text-white" />
                                </x-a>
                            @endif
                        </div>
                    @empty
                        <div class="py-8 text-center bg-zinc-50 dark:bg-zinc-800/30 rounded-2xl border border-dashed border-zinc-200 dark:border-zinc-800">
                             <x-heroicon-o-check-badge class="size-8 mx-auto text-emerald-400 mb-2" />
                             <p class="text-[10px] text-zinc-400 font-black uppercase tracking-widest">Inventory healthy</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Launch -->
        <div class="lg:col-span-2">
            <div class="card !p-10 border-zinc-100 dark:border-zinc-800 bg-zinc-50/30 dark:bg-zinc-900 h-full shadow-sm">
                <div class="mb-10">
                    <h3 class="text-sm font-black uppercase tracking-widest text-zinc-900 dark:text-white">System Quick Launch</h3>
                    <p class="text-xs text-zinc-400 font-bold tracking-tight">Accelerate your workflow with one-click actions</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @if(Route::has('admin.job-cards.create'))
                        <x-button :href="route('admin.job-cards.create')" variant="blue" class="!justify-start !p-5 !rounded-3xl gap-4 shadow-sm !ring-offset-0 hover:translate-y-[-2px] transition-transform">
                            <div class="size-10 bg-white/20 rounded-xl flex items-center justify-center">
                                <x-heroicon-o-plus-circle class="size-6 text-white" />
                            </div>
                            <div class="text-left">
                                <span class="block font-black uppercase tracking-tighter text-xs">Job Card</span>
                                <span class="block text-[10px] opacity-70 font-medium">Open new service card</span>
                            </div>
                        </x-button>
                    @endif

                    @if(Route::has('admin.appointments.create'))
                        <x-button :href="route('admin.appointments.create')" variant="gray" class="!bg-white dark:!bg-zinc-800 !justify-start !p-5 !rounded-3xl gap-4 shadow-sm !ring-offset-0 border border-zinc-100 dark:border-zinc-700 hover:translate-y-[-2px] transition-transform">
                            <div class="size-10 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center">
                                <x-heroicon-o-calendar-days class="size-6 text-indigo-600 dark:text-indigo-400" />
                            </div>
                            <div class="text-left">
                                <span class="block font-black uppercase tracking-tighter text-xs text-zinc-900 dark:text-white">Appointment</span>
                                <span class="block text-[10px] text-zinc-400 font-medium">Book vehicle in</span>
                            </div>
                        </x-button>
                    @endif

                    @if(Route::has('admin.customers.create'))
                        <x-button :href="route('admin.customers.create')" variant="gray" class="!bg-white dark:!bg-zinc-800 !justify-start !p-5 !rounded-3xl gap-4 shadow-sm !ring-offset-0 border border-zinc-100 dark:border-zinc-700 hover:translate-y-[-2px] transition-transform">
                            <div class="size-10 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center">
                                <x-heroicon-o-user-plus class="size-6 text-emerald-600 dark:text-emerald-400" />
                            </div>
                            <div class="text-left">
                                <span class="block font-black uppercase tracking-tighter text-xs text-zinc-900 dark:text-white">Customer</span>
                                <span class="block text-[10px] text-zinc-400 font-medium">Register new client</span>
                            </div>
                        </x-button>
                    @endif

                    @if(Route::has('admin.reports.index'))
                        <x-button :href="route('admin.reports.index')" variant="gray" class="!bg-white dark:!bg-zinc-800 !justify-start !p-5 !rounded-3xl gap-4 shadow-sm !ring-offset-0 border border-zinc-100 dark:border-zinc-700 hover:translate-y-[-2px] transition-transform">
                            <div class="size-10 bg-zinc-100 dark:bg-zinc-700 rounded-xl flex items-center justify-center">
                                <x-heroicon-o-chart-pie class="size-6 text-zinc-600 dark:text-zinc-400" />
                            </div>
                            <div class="text-left">
                                <span class="block font-black uppercase tracking-tighter text-xs text-zinc-900 dark:text-white">Analytics</span>
                                <span class="block text-[10px] text-zinc-400 font-medium">Business performance</span>
                            </div>
                        </x-button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
