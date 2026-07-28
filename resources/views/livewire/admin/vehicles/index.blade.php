<div x-data="{ openFilter: @entangle('openFilter') }">
    <div class="card !p-0 overflow-hidden shadow-none border-gray-200 dark:border-gray-700 dark:bg-gray-800">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div><x-h1>{{ __('vehicles.Vehicles') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('vehicles.List of') }} vehicles</x-short-description></div>
                <div class="flex items-center gap-3">
                    @if($search || $openFilter)
                        <button wire:click="resetFilters" class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-2xl transition-none shadow-none"><span>{{ __('vehicles.Reset') }}</span></button>
                    @endif
                    <button @click="openFilter = !openFilter" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-gray-600 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm transition-none"><span>{{ __('vehicles.Filters') }}</span></button>
                    <x-btn :href="route('admin.vehicles.create')" icon="plus">{{ __('vehicles.Add Vehicle') }}</x-btn>
                </div>
            </div>

            <div x-show="openFilter" x-cloak class="mt-6 p-6 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-2xl">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest ml-1 text-gray-900 dark:text-gray-100">{{ __('vehicles.Search') }}</label>
                        <input name="search" wire:model.live.debounce.300ms="search" type="text" placeholder="Search by ID, License_Plate, Vin" class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl focus:ring-2 focus:ring-blue-500/20 dark:text-white">
                    </div>
                    <div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest ml-1 text-gray-900 dark:text-gray-100">Brand Id</label><x-form.dropdown-search name="brand_id" wire:model.live="brand_id" label="none" :data="$brands" placeholder="Filter Brand Id" /></div>
<div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest ml-1 text-gray-900 dark:text-gray-100">Model Id</label><x-form.dropdown-search name="model_id" wire:model.live="model_id" label="none" :data="$models" placeholder="Filter Model Id" /></div>
<div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest ml-1 text-gray-900 dark:text-gray-100">Customer Id</label><x-form.dropdown-search name="customer_id" wire:model.live="customer_id" label="none" :data="$customers" placeholder="Filter Customer Id" /></div>
                </div>
            </div>
        </div>

        @include('errors.messages')

        <div class="overflow-x-auto border-t border-gray-100 dark:border-gray-700">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-100/50 dark:bg-gray-700/50"><tr><x-table.th name="id" :label="__('vehicles.ID')" :$sortField :$sortAsc :sortable="true" /><x-table.th name="brand_id" :label="__('vehicles.Brand Id')" :$sortField :$sortAsc :sortable="in_array('brand_id', $sortableFields)" />
<x-table.th name="model_id" :label="__('vehicles.Model Id')" :$sortField :$sortAsc :sortable="in_array('model_id', $sortableFields)" />
<x-table.th name="year" :label="__('vehicles.Year')" :$sortField :$sortAsc :sortable="in_array('year', $sortableFields)" />
<x-table.th name="customer_id" :label="__('vehicles.Customer Id')" :$sortField :$sortAsc :sortable="in_array('customer_id', $sortableFields)" />
<x-table.th name="license_plate" :label="__('vehicles.License Plate')" :$sortField :$sortAsc :sortable="in_array('license_plate', $sortableFields)" />
<x-table.th name="vin" :label="__('vehicles.Vin')" :$sortField :$sortAsc :sortable="in_array('vin', $sortableFields)" /><th class="px-6 py-4 text-right text-[10px] font-black uppercase text-gray-400 tracking-widest">{{ __('vehicles.Action') }}</th></tr></thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">@forelse($items as $item) <livewire:admin.vehicles.row :$item :key="$item->id" /> @empty <tr><td colspan="100" class="px-6 py-10 text-center text-sm text-gray-400">{{ __('vehicles.No records found.') }}</td></tr> @endforelse</tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-50 dark:border-gray-700/50">{{ $items->links() }}</div>
    </div>
</div>