<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('agriculture-management/crops.Add Crop') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('agriculture-management/crops.New record') }}</x-short-description></div><x-back-btn route="admin.agriculture-management.crops.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="store" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div><x-form.input name="name" type="text" wire:model="name" :label="__('agriculture-management/crops.Name')" class="dark:bg-gray-900" /></div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="field_id" wire:model.live="field_id" :label="__('agriculture-management/crops.Field Id')" :data="$fields" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Field</div></x-slot>
            <x-slot name="content"><livewire:admin.agriculture-management.fields.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="planting_date" type="date" wire:model="planting_date" :label="__('agriculture-management/crops.Planting Date')" class="dark:bg-gray-900" /></div>
<div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('agriculture-management/crops.Status') }}</label><select name="status" wire:model="status" class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl"><option value="">--</option><option value="growing">growing</option><option value="harvested">harvested</option></select></div>
<div><x-form.file-upload name="photo" wire:model="photo" :label="__('agriculture-management/crops.Photo')" id="photo" :isEditing="false" /></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('agriculture-management/crops.Save') }}</x-button></div></form></div>
</div>