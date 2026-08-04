<div x-data="{ openFilter: @entangle('openFilter') }">
    <div class="card !p-0 overflow-hidden shadow-none border-gray-200 dark:border-gray-700 dark:bg-gray-800">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <x-h1>{{ __('berber-app/customers.Customers') }}</x-h1>
                    <x-short-description class="dark:text-gray-400">{{ __('berber-app/customers.List of') }} {{ strtolower(__('berber-app/customers.Customers')) }}</x-short-description>
                </div>
                <div class="flex items-center gap-3">
                    @if($search || $openFilter)
                        <button wire:click="resetFilters" class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-2xl transition-none shadow-none"><span>{{ __('berber-app/customers.Reset') }}</span></button>
                    @endif
                    <button @click="openFilter = !openFilter" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-gray-600 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm transition-none"><span>{{ __('berber-app/customers.Filters') }}</span></button>
                    <x-modal>
                        <x-slot name="trigger"><x-btn @click="on = true" icon="plus">{{ __('berber-app/customers.Add Customer') }}</x-btn></x-slot>
                        <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6 text-left uppercase font-black text-sm tracking-widest">{{ __('berber-app/customers.Add Customer') }}</div></x-slot>
                        <x-slot name="content"><livewire:admin.berber-app.customers.quick-create /></x-slot>
                    </x-modal>
                </div>
            </div>

            <div x-show="openFilter" x-cloak class="mt-6 p-6 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 rounded-2xl">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest ml-1 text-gray-900 dark:text-gray-100">{{ __('berber-app/customers.Search') }}</label>
                        <input name="search" wire:model.live.debounce.300ms="search" type="text" placeholder="{{ __('berber-app/customers.Search') }}..." class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl focus:ring-2 focus:ring-blue-500/20 dark:text-white">
                    </div>
                </div>
            </div>
        </div>

        @include('errors.messages')

        <div class="overflow-x-auto border-t border-gray-100 dark:border-gray-700">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-100/50 dark:bg-gray-700/50">
                    <tr>
                        <x-table.th name="id" :label="__('berber-app/customers.ID')" :$sortField :$sortAsc :sortable="true" />
                        <x-table.th name="name" :label="__('berber-app/customers.Name')" :$sortField :$sortAsc :sortable="true" />
                        <x-table.th name="phone" :label="__('berber-app/customers.Phone')" :$sortField :$sortAsc :sortable="true" />
                        <x-table.th name="email" :label="__('berber-app/customers.Email')" :$sortField :$sortAsc :sortable="true" />
                        <th class="px-6 py-4 text-right text-[10px] font-black uppercase text-gray-400 tracking-widest">{{ __('berber-app/customers.Action') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                    @forelse($items as $item)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-none border-b border-gray-50 dark:border-gray-700/50 last:border-none">
                            <td class="px-6 py-5 font-bold text-blue-600 dark:text-blue-400">{{ $item->id }}</td>
                            <td class="px-6 py-5 font-bold text-gray-900 dark:text-white uppercase">{{ $item->name }}</td>
                            <td class="px-6 py-5 text-gray-600 dark:text-gray-300">{{ $item->phone }}</td>
                            <td class="px-6 py-5 text-gray-600 dark:text-gray-300">{{ $item->email ?? '-' }}</td>
                            <td class="px-6 py-5 text-right !transition-none">
                                <div class="flex justify-end gap-3 !transition-none">
                                    @can('delete_customers')
                                        <div x-data="{ confirmation: '' }" x-cloak class="inline-block">
                                            <x-modal>
                                                <x-slot name="trigger"><button @click="on = true" class="text-[10px] font-black uppercase text-red-400 hover:text-red-600 dark:hover:text-red-300">{{ __('berber-app/customers.Action') }}</button></x-slot>
                                                <x-slot name="modalTitle"><div class="text-left dark:text-white uppercase font-black text-sm tracking-widest">{{ __('berber-app/customers.ID') }} #{{ $item->id }}?</div></x-slot>
                                                <x-slot name="content"><div class="text-left space-y-2"><p class="text-sm text-gray-500 dark:text-gray-400">Ky veprim nuk mund të kthehet mbrapa.</p></div></x-slot>
                                                <x-slot name="footer"><x-button variant="gray" @click="on = false">{{ __('berber-app/customers.Reset') }}</x-button><x-button variant="red" wire:click="deleteCustomer('{{ $item->id }}')" @click="on = false">Fshi</x-button></x-slot>
                                            </x-modal>
                                        </div>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="100" class="px-6 py-10 text-center text-sm text-gray-400">{{ __('berber-app/customers.No records found.') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-50 dark:border-gray-700/50">{{ $items->links() }}</div>
    </div>
</div>
