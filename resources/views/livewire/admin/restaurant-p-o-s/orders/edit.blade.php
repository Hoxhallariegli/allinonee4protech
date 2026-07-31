<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('restaurant-p-o-s/orders.Edit Order') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('restaurant-p-o-s/orders.Update info') }}</x-short-description></div><x-back-btn route="admin.restaurant-p-o-s.orders.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="update" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="table_id" wire:model.live="table_id" :label="__('restaurant-p-o-s/orders.Table Id')" :data="$tables" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New DiningTable</div></x-slot>
            <x-slot name="content"><livewire:admin.restaurant-p-o-s.dining-tables.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="waiter_id" wire:model.live="waiter_id" :label="__('restaurant-p-o-s/orders.Waiter Id')" :data="$waiters" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Waiter</div></x-slot>
            <x-slot name="content"><livewire:admin.restaurant-p-o-s.waiters.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="order_date" type="datetime-local" wire:model="order_date" :label="__('restaurant-p-o-s/orders.Order Date')" class="dark:bg-gray-900" /></div>
<div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('restaurant-p-o-s/orders.Status') }}</label><select name="status" wire:model="status" class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl"><option value="">--</option><option value=\"pending\">pending</option><option value=\"ready\">ready</option><option value=\"paid\">paid</option></select></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('restaurant-p-o-s/orders.Update') }}</x-button></div></form></div>
</div>