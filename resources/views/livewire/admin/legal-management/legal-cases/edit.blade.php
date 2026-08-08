<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('legal-management/legal-cases.Edit LegalCase') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('legal-management/legal-cases.Update info') }}</x-short-description></div><x-back-btn route="admin.legal-management.legal-cases.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="update" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div><x-form.input name="title" type="text" wire:model="title" :label="__('legal-management/legal-cases.Title')" class="dark:bg-gray-900" /></div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="client_id" wire:model.live="client_id" :label="__('legal-management/legal-cases.Client Id')" :data="$clients" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Client</div></x-slot>
            <x-slot name="content"><livewire:admin.legal-management.clients.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('legal-management/legal-cases.Status') }}</label><select name="status" wire:model="status" class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl"><option value="">--</option><option value="open">open</option><option value="closed">closed</option><option value="appealed">appealed</option></select></div>
<div class="md:col-span-2"><x-form.textarea name="description" wire:model="description" :label="__('legal-management/legal-cases.Description')" class="dark:bg-gray-900" /></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('legal-management/legal-cases.Update') }}</x-button></div></form></div>
</div>