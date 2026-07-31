<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('berber-app/bookings.Add Booking') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('berber-app/bookings.New record') }}</x-short-description></div><x-back-btn route="admin.berber-app.bookings.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700">
        <form wire:submit.prevent="store" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                <div>
                    <div class="flex items-end gap-2">
                        <div class="flex-1"><x-form.dropdown-search name="barber_id" wire:model.live="barber_id" :label="__('berber-app/bookings.Barber Id')" :data="$barbers" /></div>
                        <x-modal>
                            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
                            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Barber</div></x-slot>
                            <x-slot name="content"><livewire:admin.berber-app.barbers.quick-create /></x-slot>
                        </x-modal>
                    </div>
                </div>
                <div>
                    <div class="flex items-end gap-2">
                        <div class="flex-1"><x-form.dropdown-search name="service_id" wire:model.live="service_id" :label="__('berber-app/bookings.Service Id')" :data="$services" /></div>
                        <x-modal>
                            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
                            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Service</div></x-slot>
                            <x-slot name="content"><livewire:admin.berber-app.services.quick-create /></x-slot>
                        </x-modal>
                    </div>
                </div>
                <div><x-form.input name="customer_name" type="text" wire:model="customer_name" :label="__('berber-app/bookings.Customer Name')" class="dark:bg-gray-900" /></div>
                <div><x-form.input name="customer_phone" type="text" wire:model="customer_phone" :label="__('berber-app/bookings.Customer Phone')" class="dark:bg-gray-900" /></div>

                <div class="md:col-span-2 border-t border-gray-100 dark:border-gray-700 pt-8 mt-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <label class="block mb-2 text-[10px] font-black uppercase tracking-widest text-gray-400">1. Zgjidh Datën</label>
                            <input type="date" wire:model.live="selected_date" class="w-full p-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl font-bold text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500/20">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-[10px] font-black uppercase tracking-widest text-gray-400">2. Zgjidh Orarin (Sipas kohëzgjatjes)</label>
                            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-2 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                @forelse($this->availableSlots as $time)
                                    <button type="button" wire:click="selectTime('{{ $time }}')"
                                        class="p-3 text-xs rounded-xl font-bold transition-all {{ $selected_time === $time ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 dark:shadow-none' : 'bg-gray-50 dark:bg-gray-900 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                                        {{ $time }}
                                    </button>
                                @empty
                                    <div class="col-span-full py-4 text-center text-gray-400 text-xs italic">Zgjidh shërbimin dhe datën për të parë oraret e lira...</div>
                                @endforelse
                            </div>
                            @if($appointment_datetime)
                                <div class="mt-4 p-3 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-xl flex items-center gap-3">
                                    <x-heroicon-o-check-circle class="size-4 text-green-500" />
                                    <span class="text-xs font-bold text-green-700 dark:text-green-400">Zgjedhur: {{ Carbon\Carbon::parse($appointment_datetime)->format('d/m/Y H:i') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('berber-app/bookings.Status') }}</label>
                    <select name="status" wire:model="status" class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl">
                        <option value="pending">pending</option>
                        <option value="confirmed">confirmed</option>
                        <option value="cancelled">cancelled</option>
                        <option value="completed">completed</option>
                    </select>
                </div>
                <div><x-form.checkbox name="reminder_enabled" wire:model="reminder_enabled" :label="__('berber-app/bookings.Reminder Enabled')" /></div>
                <div><x-form.input name="reminder_minutes" type="text" wire:model="reminder_minutes" :label="__('berber-app/bookings.Reminder Minutes')" class="dark:bg-gray-900" /></div>
                <div class="md:col-span-2"><x-form.input name="cancel_reason" type="text" wire:model="cancel_reason" :label="__('berber-app/bookings.Cancel Reason')" class="dark:bg-gray-900" /></div>
            </div>
            <div class="mt-10 flex justify-end">
                <x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('berber-app/bookings.Save') }}</x-button>
            </div>
        </form>
    </div>
</div>
