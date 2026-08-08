<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('pharmacy-management/prescription-items.Edit PrescriptionItem') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('pharmacy-management/prescription-items.Update info') }}</x-short-description></div><x-back-btn route="admin.pharmacy-management.prescription-items.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="update" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="prescription_id" wire:model.live="prescription_id" :label="__('pharmacy-management/prescription-items.Prescription Id')" :data="$prescriptions" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Prescription</div></x-slot>
            <x-slot name="content"><livewire:admin.pharmacy-management.prescriptions.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="medicine_id" wire:model.live="medicine_id" :label="__('pharmacy-management/prescription-items.Medicine Id')" :data="$medicines" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Medicine</div></x-slot>
            <x-slot name="content"><livewire:admin.pharmacy-management.medicines.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="quantity" type="text" wire:model="quantity" :label="__('pharmacy-management/prescription-items.Quantity')" class="dark:bg-gray-900" /></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('pharmacy-management/prescription-items.Update') }}</x-button></div></form></div>
</div>