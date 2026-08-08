<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('construction-e-r-p/apartments.Edit Apartment') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('construction-e-r-p/apartments.Update info') }}</x-short-description></div><x-back-btn route="admin.construction-e-r-p.apartments.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="update" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="building_id" wire:model.live="building_id" :label="__('construction-e-r-p/apartments.Building Id')" :data="$buildings" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Building</div></x-slot>
            <x-slot name="content"><livewire:admin.construction-e-r-p.buildings.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="number" type="text" wire:model="number" :label="__('construction-e-r-p/apartments.Number')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="area" type="text" wire:model="area" :label="__('construction-e-r-p/apartments.Area')" class="dark:bg-gray-900" /></div>
<div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('construction-e-r-p/apartments.Status') }}</label><select name="status" wire:model="status" class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl"><option value="">--</option><option value="available">available</option><option value="sold">sold</option><option value="reserved">reserved</option></select></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('construction-e-r-p/apartments.Update') }}</x-button></div></form></div>
</div>