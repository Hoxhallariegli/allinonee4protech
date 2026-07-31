<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('auto-repair-management/vehicles.Add Vehicle') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('auto-repair-management/vehicles.New record') }}</x-short-description></div><x-back-btn route="admin.auto-repair-management.vehicles.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="store" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="brand_id" wire:model.live="brand_id" :label="__('auto-repair-management/vehicles.Brand Id')" :data="$brands" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New VehicleBrand</div></x-slot>
            <x-slot name="content"><livewire:admin.auto-repair-management.vehicle-brands.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="model_id" wire:model.live="model_id" :label="__('auto-repair-management/vehicles.Model Id')" :data="$models" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New VehicleModel</div></x-slot>
            <x-slot name="content"><livewire:admin.auto-repair-management.vehicle-models.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="year" type="text" wire:model="year" :label="__('auto-repair-management/vehicles.Year')" class="dark:bg-gray-900" /></div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="customer_id" wire:model.live="customer_id" :label="__('auto-repair-management/vehicles.Customer Id')" :data="$customers" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Customer</div></x-slot>
            <x-slot name="content"><livewire:admin.auto-repair-management.customers.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="license_plate" type="text" wire:model="license_plate" :label="__('auto-repair-management/vehicles.License Plate')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="vin" type="text" wire:model="vin" :label="__('auto-repair-management/vehicles.Vin')" class="dark:bg-gray-900" /></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('auto-repair-management/vehicles.Save') }}</x-button></div></form></div>
</div>