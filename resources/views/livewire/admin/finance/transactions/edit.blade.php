<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('finance/transactions.Edit Transaction') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('finance/transactions.Update info') }}</x-short-description></div><x-back-btn route="admin.finance.transactions.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="update" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="account_id" wire:model.live="account_id" :label="__('finance/transactions.Account Id')" :data="$accounts" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Account</div></x-slot>
            <x-slot name="content"><livewire:admin.finance.accounts.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="category_id" wire:model.live="category_id" :label="__('finance/transactions.Category Id')" :data="$categories" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Category</div></x-slot>
            <x-slot name="content"><livewire:admin.finance.categories.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="amount" type="text" wire:model="amount" :label="__('finance/transactions.Amount')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="date" type="date" wire:model="date" :label="__('finance/transactions.Date')" class="dark:bg-gray-900" /></div>
<div class="md:col-span-2"><x-form.textarea name="description" wire:model="description" :label="__('finance/transactions.Description')" class="dark:bg-gray-900" /></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('finance/transactions.Update') }}</x-button></div></form></div>
</div>