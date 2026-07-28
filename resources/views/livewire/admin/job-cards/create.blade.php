<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('job-cards.Add JobCard') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('job-cards.New record') }}</x-short-description></div><x-back-btn route="admin.job-cards.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="store" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="vehicle_id" wire:model.live="vehicle_id" :label="__('job-cards.Vehicle Id')" :data="$vehicles" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Vehicle</div></x-slot>
            <x-slot name="content"><livewire:admin.vehicles.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="customer_id" wire:model.live="customer_id" :label="__('job-cards.Customer Id')" :data="$customers" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Customer</div></x-slot>
            <x-slot name="content"><livewire:admin.customers.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="mechanic_id" wire:model.live="mechanic_id" :label="__('job-cards.Mechanic Id')" :data="$mechanics" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Mechanic</div></x-slot>
            <x-slot name="content"><livewire:admin.mechanics.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="status" type="text" wire:model="status" :label="__('job-cards.Status')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="opened_at" type="datetime-local" wire:model="opened_at" :label="__('job-cards.Opened At')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="closed_at" type="datetime-local" wire:model="closed_at" :label="__('job-cards.Closed At')" class="dark:bg-gray-900" /></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('job-cards.Save') }}</x-button></div></form></div>
</div>