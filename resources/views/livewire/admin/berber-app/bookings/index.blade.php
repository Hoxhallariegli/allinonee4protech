<div x-data="{ openFilter: @entangle('openFilter'), viewMode: @entangle('viewMode') }">
    <div class="card !p-0 overflow-hidden shadow-none border-gray-200 dark:border-gray-700 dark:bg-gray-800">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <x-h1>{{ __('berber-app/bookings.Bookings') }}</x-h1>
                    <x-short-description class="dark:text-gray-400">Menaxho rezervimet dhe disponueshmërinë</x-short-description>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex bg-gray-50 dark:bg-gray-900 p-1 rounded-xl mr-2">
                        <button @click="viewMode = 'table'" :class="viewMode === 'table' ? 'bg-white dark:bg-gray-800 shadow-sm text-blue-600' : 'text-gray-400'" class="px-4 py-1.5 text-xs font-bold rounded-lg transition-all">Listë</button>
                        <button @click="viewMode = 'schedule'" :class="viewMode === 'schedule' ? 'bg-white dark:bg-gray-800 shadow-sm text-blue-600' : 'text-gray-400'" class="px-4 py-1.5 text-xs font-bold rounded-lg transition-all">Kalendar</button>
                    </div>

                    @if($search || $openFilter)
                        <button wire:click="resetFilters" class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-2xl transition-none shadow-none"><span>{{ __('berber-app/bookings.Reset') }}</span></button>
                    @endif
                    <button @click="openFilter = !openFilter" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-gray-600 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm transition-none"><span>{{ __('berber-app/bookings.Filters') }}</span></button>
                    <x-btn :href="route('admin.berber-app.bookings.create')" icon="plus">{{ __('berber-app/bookings.Add Booking') }}</x-btn>
                </div>
            </div>

            <div x-show="openFilter" x-cloak class="mt-6 p-6 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-2xl">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest ml-1 text-gray-900 dark:text-gray-100">{{ __('berber-app/bookings.Search') }}</label>
                        <input name="search" wire:model.live.debounce.300ms="search" type="text" placeholder="Search by name, phone..." class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl focus:ring-2 focus:ring-blue-500/20 dark:text-white">
                    </div>
                    <div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest ml-1 text-gray-900 dark:text-gray-100">Barber</label><x-form.dropdown-search name="barber_id" wire:model.live="barber_id" label="none" :data="$barbers" placeholder="Filter Barber" /></div>
                    <div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest ml-1 text-gray-900 dark:text-gray-100">Service</label><x-form.dropdown-search name="service_id" wire:model.live="service_id" label="none" :data="$services" placeholder="Filter Service" /></div>
                </div>
            </div>
        </div>

        @include('errors.messages')

        {{-- Table Mode --}}
        <div x-show="viewMode === 'table'">
            <div class="overflow-x-auto border-t border-gray-100 dark:border-gray-700">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-100/50 dark:bg-gray-700/50"><tr><x-table.th name="id" :label="__('berber-app/bookings.ID')" :$sortField :$sortAsc :sortable="true" />
                        <x-table.th name="barber_id" :label="__('berber-app/bookings.Barber')" :$sortField :$sortAsc :sortable="in_array('barber_id', $sortableFields)" />
                        <x-table.th name="service_id" :label="__('berber-app/bookings.Service')" :$sortField :$sortAsc :sortable="in_array('service_id', $sortableFields)" />
                        <x-table.th name="customer_name" :label="__('berber-app/bookings.Customer Name')" :$sortField :$sortAsc :sortable="in_array('customer_name', $sortableFields)" />
                        <x-table.th name="appointment_datetime" :label="__('berber-app/bookings.Appointment Datetime')" :$sortField :$sortAsc :sortable="in_array('appointment_datetime', $sortableFields)" />
                        <x-table.th name="status" :label="__('berber-app/bookings.Status')" :$sortField :$sortAsc :sortable="in_array('status', $sortableFields)" />
                        <th class="px-6 py-4 text-right text-[10px] font-black uppercase text-gray-400 tracking-widest">{{ __('berber-app/bookings.Action') }}</th></tr></thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                        @forelse($items as $item)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-none border-b border-gray-50 dark:border-gray-700/50 last:border-none">
                                <td class="px-6 py-5 font-bold text-blue-600 dark:text-blue-400">{{ $item->id }}</td>
                                <td class="px-6 py-5 font-bold text-gray-900 dark:text-white">{{ $item->barber?->name ?? '-' }}</td>
                                <td class="px-6 py-5 font-bold text-gray-900 dark:text-white">{{ $item->service?->name ?? '-' }}</td>
                                <td class="px-6 py-5 text-gray-600 dark:text-gray-300">
                                    @if($item->customer_id)
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-900 dark:text-white">{{ $item->customer?->name }}</span>
                                            <span class="text-[10px]">{{ $item->customer?->phone }}</span>
                                        </div>
                                    @else
                                        <div class="flex flex-col">
                                            <span class="font-bold">{{ $item->customer_name }}</span>
                                            <span class="text-[10px]">{{ $item->customer_phone }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-gray-600 dark:text-gray-300">{{ $item->appointment_datetime?->format('d/m/Y H:i') ?? '-' }}</td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col gap-1">
                                        <x-badge :variant="match($item->status) { 'confirmed' => 'green', 'cancelled' => 'red', 'completed' => 'blue', default => 'amber' }">
                                            {{ $item->status }}
                                        </x-badge>
                                        @if($item->cancel_reason)
                                            <span class="text-[9px] text-red-400 italic leading-tight">{{ $item->cancel_reason }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-right !transition-none">
                                    <div class="flex justify-end gap-3 !transition-none">
                                        @can('edit_bookings')
                                            <x-a href="{{ route('admin.berber-app.bookings.edit', $item) }}" class="!rounded-xl !bg-blue-50 dark:!bg-blue-900/30 !text-blue-600 dark:!text-blue-400 !px-4 !py-1.5 !text-[10px] !font-black !uppercase !border-none">Edit</x-a>
                                        @endcan
                                        @can('delete_bookings')
                                            <div x-data="{ confirmation: '' }" x-cloak class="inline-block">
                                                <x-modal>
                                                    <x-slot name="trigger"><button @click="on = true" class="text-[10px] font-black uppercase text-red-400 hover:text-red-600 dark:hover:text-red-300">Delete</button></x-slot>
                                                    <x-slot name="modalTitle"><div class="text-left dark:text-white">Fshi rezervimin #{{ $item->id }}?</div></x-slot>
                                                    <x-slot name="content"><div class="text-left space-y-2"><p class="text-sm text-gray-500 dark:text-gray-400">Ky veprim nuk mund të kthehet mbrapa.</p></div></x-slot>
                                                    <x-slot name="footer"><x-button variant="gray" @click="on = false">Anulo</x-button><x-button variant="red" wire:click="deleteBooking('{{ $item->id }}')" @click="on = false">Fshi</x-button></x-slot>
                                                </x-modal>
                                            </div>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="100" class="px-6 py-10 text-center text-sm text-gray-400">{{ __('berber-app/bookings.No records found.') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-50 dark:border-gray-700/50">{{ $items->links() }}</div>
        </div>

        {{-- Schedule/Calendar Mode --}}
        <div x-show="viewMode === 'schedule'" x-cloak class="p-6 border-t border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-4 mb-8">
                <input type="date" wire:model.live="viewDate" class="p-3 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl font-bold text-sm">
                <h3 class="font-black text-slate-900 dark:text-white uppercase tracking-widest text-xs">Oraret për {{ Carbon\Carbon::parse($viewDate)->format('d/m/Y') }}</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($this->dailySlots as $slot)
                    <div class="p-5 rounded-[2rem] border {{ $slot['available'] ? 'bg-white dark:bg-gray-800 border-gray-100 dark:border-gray-700' : 'bg-gray-50 dark:bg-gray-900/50 border-transparent' }} transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-lg font-black text-slate-900 dark:text-white">{{ $slot['time'] }}</span>
                            @if($slot['available'])
                                <x-modal>
                                    <x-slot name="trigger">
                                        <button @click="on = true" class="p-2 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="size-4"/></button>
                                    </x-slot>
                                    <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Rezervim i Ri: {{ $slot['time'] }}</div></x-slot>
                                    <x-slot name="content">
                                        <livewire:admin.berber-app.bookings.quick-create :appointment_datetime="$slot['datetime']" :key="'slot-'.$slot['time']" />
                                    </x-slot>
                                </x-modal>
                            @else
                                <span class="px-3 py-1 bg-red-50 dark:bg-red-900/20 text-red-500 text-[10px] font-black uppercase rounded-lg">I Zënë</span>
                            @endif
                        </div>

                        <div class="space-y-2">
                            @foreach($slot['bookings'] as $b)
                                <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-2xl flex items-center justify-between group">
                                    <div>
                                        <p class="text-xs font-bold text-slate-900 dark:text-white">{{ $b->customer_name }}</p>
                                        <p class="text-[10px] text-gray-400 font-medium">{{ $b->barber->name }} - {{ $b->service->name }}</p>
                                    </div>
                                    <a href="{{ route('admin.berber-app.bookings.edit', $b) }}" class="opacity-0 group-hover:opacity-100 p-1.5 bg-white dark:bg-gray-800 rounded-lg shadow-sm transition-all"><x-heroicon-o-pencil class="size-3 text-gray-400"/></a>
                                </div>
                            @endforeach
                            @if(count($slot['bookings']) === 0)
                                <p class="text-[10px] text-gray-300 italic">Asnjë rezervim</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
