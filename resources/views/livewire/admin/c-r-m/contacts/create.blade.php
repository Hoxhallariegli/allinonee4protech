<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('c-r-m/contacts.Add Contact') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('c-r-m/contacts.New record') }}</x-short-description></div><x-back-btn route="admin.c-r-m.contacts.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="store" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div><x-form.input name="name" type="text" wire:model="name" :label="__('c-r-m/contacts.Name')" class="dark:bg-gray-900" /></div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="company_id" wire:model.live="company_id" :label="__('c-r-m/contacts.Company Id')" :data="$companies" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Company</div></x-slot>
            <x-slot name="content"><livewire:admin.c-r-m.companies.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="email" type="text" wire:model="email" :label="__('c-r-m/contacts.Email')" class="dark:bg-gray-900" /></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('c-r-m/contacts.Save') }}</x-button></div></form></div>
</div>