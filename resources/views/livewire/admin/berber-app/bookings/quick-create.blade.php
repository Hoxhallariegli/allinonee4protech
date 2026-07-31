<div class="p-6">
    @if($created)
        <div class="flex flex-col items-center text-center py-10">
            <div class="w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center mb-4">
                <x-heroicon-o-check class="w-6 h-6 text-green-500" />
            </div>
            <p class="font-bold text-gray-900 dark:text-white">{{ __('berber-app/bookings.created') }}</p>
            @if($createdLabel)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $createdLabel }}</p>@endif
            <button type="button" wire:click="addAnother" class="mt-6 text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('berber-app/bookings.Add Booking') }}</button>
        </div>
    @else
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('berber-app/bookings.Barber') }}</label>
                    <x-form.dropdown-search name="barber_id" wire:model.live="barber_id" label="none" :data="$barbers" />
                    @php
                        $selectedBarber = \App\Models\BerberApp\Barber::with('exceptions')->find($barber_id);
                        $currentAbsence = $selectedBarber ? $selectedBarber->exceptions->where('start_datetime', '<=', now())->where('end_datetime', '>=', now())->first() : null;
                    @endphp
                    @if($currentAbsence)
                        <div class="mt-2 p-2 bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800 rounded-xl flex items-center gap-2">
                            <span class="size-2 bg-red-500 rounded-full animate-ping"></span>
                            <span class="text-[10px] font-bold text-red-600 uppercase tracking-tighter">Në Absencë: {{ $currentAbsence->type }}</span>
                        </div>
                    @endif
                </div>
                <div>
                    <label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('berber-app/bookings.Service') }}</label>
                    <x-form.dropdown-search name="service_id" wire:model.live="service_id" label="none" :data="$services" />
                </div>
                <div><x-form.input name="customer_name" type="text" wire:model="customer_name" :label="__('berber-app/bookings.Customer Name')" class="dark:bg-gray-900" /></div>
                <div><x-form.input name="customer_phone" type="text" wire:model="customer_phone" :label="__('berber-app/bookings.Customer Phone')" class="dark:bg-gray-900" /></div>
            </div>

            <div class="border-t border-gray-100 dark:border-gray-700 pt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-[10px] font-black uppercase tracking-widest text-gray-400">Data</label>
                        <input type="date" wire:model.live="selected_date" class="w-full p-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl font-bold text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500/20">
                    </div>
                    <div>
                        <label class="block mb-2 text-[10px] font-black uppercase tracking-widest text-gray-400">Orari</label>
                        <div class="grid grid-cols-3 gap-2 max-h-32 overflow-y-auto pr-2 custom-scrollbar text-center">
                            @forelse($this->availableSlots as $time)
                                <button type="button" wire:click="selectTime('{{ $time }}')"
                                    class="p-2 text-[10px] rounded-lg font-bold transition-all {{ $selected_time === $time ? 'bg-blue-600 text-white' : 'bg-gray-50 dark:bg-gray-900 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                                    {{ $time }}
                                </button>
                            @empty
                                <div class="col-span-full py-4 text-center text-gray-400 text-[10px] italic">Zgjidh shërbimin dhe datën...</div>
                            @endforelse
                        </div>
                    </div>
                </div>
                @if($appointment_datetime)
                    <div class="mt-4 p-2 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-xl flex items-center gap-3">
                        <x-heroicon-o-check-circle class="size-4 text-green-500" />
                        <span class="text-[10px] font-bold text-green-700 dark:text-green-400">Zgjedhur: {{ Carbon\Carbon::parse($appointment_datetime)->format('d/m H:i') }}</span>
                    </div>
                @endif
            </div>

            <div class="flex justify-end pt-4">
                <x-button wire:click="store" variant="blue" class="w-full !py-4 !rounded-2xl">Ruaj Rezervimin</x-button>
            </div>
        </div>
    @endif
</div>
