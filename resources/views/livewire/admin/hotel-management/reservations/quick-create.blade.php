<div class="p-6">
    @if($created)
        <div class="flex flex-col items-center text-center py-10">
            <div class="w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center mb-4">
                <x-heroicon-o-check class="w-6 h-6 text-green-500" />
            </div>
            <p class="font-bold text-gray-900 dark:text-white">{{ __('hotel-management/reservations.created') }}</p>
            @if($createdLabel)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $createdLabel }}</p>@endif
            <button type="button" wire:click="addAnother" class="mt-6 text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('hotel-management/reservations.Add Reservation') }}</button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="guest_id" wire:model.live="guest_id" :label="__('hotel-management/reservations.Guest Id')" :data="$guests" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Guest</div></x-slot>
            <x-slot name="content"><livewire:admin.hotel-management.guests.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="room_id" wire:model.live="room_id" :label="__('hotel-management/reservations.Room Id')" :data="$rooms" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New HotelRoom</div></x-slot>
            <x-slot name="content"><livewire:admin.hotel-management.hotel-rooms.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="check_in" type="date" wire:model="check_in" :label="__('hotel-management/reservations.Check In')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="check_out" type="date" wire:model="check_out" :label="__('hotel-management/reservations.Check Out')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="total_price" type="text" wire:model="total_price" :label="__('hotel-management/reservations.Total Price')" class="dark:bg-gray-900" /></div></div>
        <div class="mt-8 flex justify-end"><x-button wire:click="store" variant="blue">{{ __('hotel-management/reservations.Save') }}</x-button></div>
    @endif
</div>