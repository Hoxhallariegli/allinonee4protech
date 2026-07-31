<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('construction-e-r-p/buildings.Add Building') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('construction-e-r-p/buildings.New record') }}</x-short-description></div><x-back-btn route="admin.construction-e-r-p.buildings.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="store" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="project_id" wire:model.live="project_id" :label="__('construction-e-r-p/buildings.Project Id')" :data="$projects" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Project</div></x-slot>
            <x-slot name="content"><livewire:admin.construction-e-r-p.projects.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="name" type="text" wire:model="name" :label="__('construction-e-r-p/buildings.Name')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="floors" type="text" wire:model="floors" :label="__('construction-e-r-p/buildings.Floors')" class="dark:bg-gray-900" /></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('construction-e-r-p/buildings.Save') }}</x-button></div></form></div>
</div>