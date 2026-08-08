<div class="space-y-6">
    <div class="flex items-center justify-between gap-4 px-1">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('admin.Clinic Management Dashboard') }}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('admin.module_desc_clinic-management') }}</p>
        </div>
        <div class="flex items-center gap-3">
            <x-btn href="/clinic-management" target="_blank" icon="globe-alt" variant="secondary">{{ __('admin.Public Page') }}</x-btn>
            <x-btn route="admin.clinic-management.visits.index" icon="plus">{{ __('admin.Register Visit') }}</x-btn>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="card p-6 bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 rounded-[2rem]">
            <div class="flex items-center gap-4">
                <div class="size-12 rounded-2xl bg-rose-50 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 flex items-center justify-center">
                    <x-heroicon-o-heart class="size-6" />
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400">{{ __('admin.Visits Today') }}</p>
                    <p class="text-2xl font-black text-gray-900 dark:text-white">{{ $todayVisits }}</p>
                </div>
            </div>
        </div>

        <div class="card p-6 bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 rounded-[2rem]">
            <div class="flex items-center gap-4">
                <div class="size-12 rounded-2xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                    <x-heroicon-o-user-group class="size-6" />
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400">{{ __('admin.Total Patients') }}</p>
                    <p class="text-2xl font-black text-gray-900 dark:text-white">{{ $totalPatients }}</p>
                </div>
            </div>
        </div>

        <div class="card p-6 bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 rounded-[2rem]">
            <div class="flex items-center gap-4">
                <div class="size-12 rounded-2xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                    <x-heroicon-o-identification class="size-6" />
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400">{{ __('admin.Specialist Doctors') }}</p>
                    <p class="text-2xl font-black text-gray-900 dark:text-white">{{ $totalDoctors }}</p>
                </div>
            </div>
        </div>

        <div class="card p-6 bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 rounded-[2rem]">
            <div class="flex items-center gap-4">
                <div class="size-12 rounded-2xl bg-sky-50 dark:bg-sky-900/30 text-sky-600 dark:text-sky-400 flex items-center justify-center">
                    <x-heroicon-o-banknotes class="size-6" />
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400">{{ __('admin.Revenue') }}</p>
                    <p class="text-2xl font-black text-gray-900 dark:text-white">€{{ number_format($totalRevenue, 0) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Recent Visits --}}
        <div class="lg:col-span-2 card !p-0 overflow-hidden bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 rounded-[2.5rem]">
            <div class="p-6 border-b border-gray-50 dark:border-gray-700 flex items-center justify-between">
                <h3 class="font-bold text-gray-900 dark:text-white uppercase tracking-tight">{{ __('admin.Recent Visits') }}</h3>
                <x-a route="admin.clinic-management.visits.index" class="text-xs font-bold text-rose-600">{{ __('admin.View All') }}</x-a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50/50 dark:bg-gray-700/50 text-[10px] font-black uppercase text-gray-400 tracking-widest">
                        <tr>
                            <th class="px-6 py-4">{{ __('admin.Patient') }}</th>
                            <th class="px-6 py-4">{{ __('admin.Doctor') }}</th>
                            <th class="px-6 py-4">{{ __('admin.Diagnosis') }}</th>
                            <th class="px-6 py-4">{{ __('admin.Date') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                        @foreach($recentVisits as $visit)
                            <tr class="hover:bg-gray-50/30 dark:hover:bg-gray-900/30 transition-colors">
                                <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">{{ $visit->patient?->name }}</td>
                                <td class="px-6 py-4 text-gray-500 dark:text-gray-400">{{ $visit->doctor?->name }}</td>
                                <td class="px-6 py-4 text-gray-500 dark:text-gray-400">{{ Str::limit($visit->diagnosis, 30) }}</td>
                                <td class="px-6 py-4 text-gray-500 dark:text-gray-400">{{ $visit->visit_date->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="card p-8 bg-gray-900 text-white rounded-[2.5rem] flex flex-col justify-between shadow-2xl">
            <div>
                <h3 class="text-xl font-black uppercase tracking-tight mb-4 text-rose-400">{{ __('admin.Digital Clinic') }}</h3>
                <p class="text-gray-400 text-sm mb-8 leading-relaxed italic font-serif">"{{ __('admin.Manage medical records, prescriptions, and invoices in one place. Data security is our priority.') }}"</p>
                <div class="space-y-4">
                    <x-a route="admin.clinic-management.patients.index" class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors !text-white !border-none !px-0 !py-0">
                         <div class="flex items-center gap-4 w-full">
                            <div class="size-10 rounded-xl bg-blue-500 flex items-center justify-center"><x-heroicon-o-users class="size-5 text-white" /></div>
                            <span class="font-bold text-sm uppercase tracking-widest">{{ __('admin.Patients') }}</span>
                         </div>
                    </x-a>
                    <x-a route="admin.clinic-management.prescriptions.index" class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors !text-white !border-none !px-0 !py-0">
                         <div class="flex items-center gap-4 w-full">
                            <div class="size-10 rounded-xl bg-purple-500 flex items-center justify-center"><x-heroicon-o-document-text class="size-5 text-white" /></div>
                            <span class="font-bold text-sm uppercase tracking-widest">{{ __('admin.Prescriptions') }}</span>
                         </div>
                    </x-a>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-white/5">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Clinic Central • Managed Care</p>
            </div>
        </div>
    </div>
</div>
