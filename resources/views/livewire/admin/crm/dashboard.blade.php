<div class="space-y-10">
    <div>
        <x-h1>{{ __('admin.CRM Dashboard') }}</x-h1>
        <x-short-description>Operational overview for CRM</x-short-description>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="card p-6 flex items-center gap-4">
            <div class="size-12 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center"><x-heroicon-o-users class="size-6"/></div>
            <div><p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Leads</p><p class="text-2xl font-black">{{ \App\Models\CRM\Lead::count() }}</p></div>
        </div>
        <div class="card p-6 flex items-center gap-4">
            <div class="size-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center"><x-heroicon-o-chart-bar class="size-6"/></div>
            <div><p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Won Deals</p><p class="text-2xl font-black">{{ \App\Models\CRM\Deal::where('stage', 'won')->count() }}</p></div>
        </div>
    </div>
</div>
