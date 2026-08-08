<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('facility-management/maintenance-requests.Edit MaintenanceRequest') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('facility-management/maintenance-requests.Update info') }}</x-short-description></div><x-back-btn route="admin.facility-management.maintenance-requests.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="update" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="building_id" wire:model.live="building_id" :label="__('facility-management/maintenance-requests.Building Id')" :data="$buildings" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Building</div></x-slot>
            <x-slot name="content"><livewire:admin.facility-management.buildings.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="technician_id" wire:model.live="technician_id" :label="__('facility-management/maintenance-requests.Technician Id')" :data="$technicians" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Technician</div></x-slot>
            <x-slot name="content"><livewire:admin.facility-management.technicians.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div class="md:col-span-2"><x-form.textarea name="description" wire:model="description" :label="__('facility-management/maintenance-requests.Description')" class="dark:bg-gray-900" /></div>
<div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('facility-management/maintenance-requests.Status') }}</label><select name="status" wire:model="status" class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl"><option value="">--</option><option value="pending">pending</option><option value="in_progress">in_progress</option><option value="completed">completed</option></select></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('facility-management/maintenance-requests.Update') }}</x-button></div></form></div>
</div>