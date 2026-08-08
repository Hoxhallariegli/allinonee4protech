<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <x-h1>Agriculture Dashboard</x-h1>
            <x-short-description>Overview of fields, crops and inventory</x-short-description>
        </div>
        <div class="flex items-center gap-3">
            <x-btn :href="route('admin.agriculture-management.fields.index')" variant="white">Manage Fields</x-btn>
            <x-btn :href="route('admin.agriculture-management.crops.create')">Add New Crop</x-btn>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="card p-6 bg-white dark:bg-gray-800 border-none shadow-sm rounded-[2rem]">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-2xl">
                    <x-heroicon-o-sun class="w-6 h-6" />
                </div>
                <div>
                    <p class="text-xs font-black uppercase tracking-widest text-gray-400">Total Fields</p>
                    <p class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['total_fields'] }}</p>
                </div>
            </div>
        </div>

        <div class="card p-6 bg-white dark:bg-gray-800 border-none shadow-sm rounded-[2rem]">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl">
                    <x-heroicon-o-sparkles class="w-6 h-6" />
                </div>
                <div>
                    <p class="text-xs font-black uppercase tracking-widest text-gray-400">Total Crops</p>
                    <p class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['total_crops'] }}</p>
                </div>
            </div>
        </div>

        <div class="card p-6 bg-white dark:bg-gray-800 border-none shadow-sm rounded-[2rem]">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-2xl">
                    <x-heroicon-o-clock class="w-6 h-6" />
                </div>
                <div>
                    <p class="text-xs font-black uppercase tracking-widest text-gray-400">Growing</p>
                    <p class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['growing_crops'] }}</p>
                </div>
            </div>
        </div>

        <div class="card p-6 bg-white dark:bg-gray-800 border-none shadow-sm rounded-[2rem]">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-rose-50 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 rounded-2xl">
                    <x-heroicon-o-archive-box class="w-6 h-6" />
                </div>
                <div>
                    <p class="text-xs font-black uppercase tracking-widest text-gray-400">Low Stock</p>
                    <p class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['low_stock_supplies'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Status Chart / Distribution -->
        <div class="lg:col-span-1 card p-8 bg-white dark:bg-gray-800 border-none shadow-sm rounded-[2.5rem]">
            <h3 class="text-lg font-black text-gray-900 dark:text-white mb-6 uppercase tracking-widest">Crop Status</h3>
            <div class="space-y-4">
                @foreach(['growing' => 'blue', 'harvested' => 'emerald', 'failed' => 'rose'] as $status => $color)
                    @php $count = $cropsByStatus[$status] ?? 0; @endphp
                    <div>
                        <div class="flex justify-between text-xs font-bold uppercase tracking-widest mb-1.5">
                            <span class="text-gray-500">{{ $status }}</span>
                            <span class="text-gray-900 dark:text-white">{{ $count }}</span>
                        </div>
                        <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5">
                            <div class="bg-{{ $color }}-500 h-1.5 rounded-full" style="width: {{ $stats['total_crops'] > 0 ? ($count / $stats['total_crops'] * 100) : 0 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="lg:col-span-2 card overflow-hidden bg-white dark:bg-gray-800 border-none shadow-sm rounded-[2.5rem]">
            <div class="p-8 border-b border-gray-50 dark:border-gray-700/50 flex justify-between items-center">
                <h3 class="text-lg font-black text-gray-900 dark:text-white uppercase tracking-widest">Recent Plantings</h3>
                <x-a href="{{ route('admin.agriculture-management.crops.index') }}" class="text-xs font-bold text-blue-600 uppercase">View All</x-a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="bg-gray-50/50 dark:bg-gray-700/50 text-[10px] font-black uppercase text-gray-400 tracking-widest">
                        <tr>
                            <th class="px-8 py-4">Crop</th>
                            <th class="px-8 py-4">Field</th>
                            <th class="px-8 py-4">Date</th>
                            <th class="px-8 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                        @foreach($recentCrops as $crop)
                            <tr>
                                <td class="px-8 py-4 font-bold text-gray-900 dark:text-white">{{ $crop->name }}</td>
                                <td class="px-8 py-4 text-gray-500">{{ $crop->field?->name ?? '-' }}</td>
                                <td class="px-8 py-4 text-gray-500">{{ $crop->planting_date?->format('M d, Y') }}</td>
                                <td class="px-8 py-4">
                                    <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full
                                        {{ $crop->status === 'growing' ? 'bg-blue-50 text-blue-600' : ($crop->status === 'harvested' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600') }}">
                                        {{ $crop->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
