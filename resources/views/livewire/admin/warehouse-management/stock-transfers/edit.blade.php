<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('warehouse-management/stock-transfers.Edit StockTransfer') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('warehouse-management/stock-transfers.Update info') }}</x-short-description></div><x-back-btn route="admin.warehouse-management.stock-transfers.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="update" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="product_id" wire:model.live="product_id" :label="__('warehouse-management/stock-transfers.Product Id')" :data="$products" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Product</div></x-slot>
            <x-slot name="content"><livewire:admin.warehouse-management.products.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="from_warehouse_id" wire:model.live="from_warehouse_id" :label="__('warehouse-management/stock-transfers.From Warehouse Id')" :data="$fromWarehouses" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Warehouse</div></x-slot>
            <x-slot name="content"><livewire:admin.warehouse-management.warehouses.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="to_warehouse_id" wire:model.live="to_warehouse_id" :label="__('warehouse-management/stock-transfers.To Warehouse Id')" :data="$toWarehouses" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Warehouse</div></x-slot>
            <x-slot name="content"><livewire:admin.warehouse-management.warehouses.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="quantity" type="text" wire:model="quantity" :label="__('warehouse-management/stock-transfers.Quantity')" class="dark:bg-gray-900" /></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('warehouse-management/stock-transfers.Update') }}</x-button></div></form></div>
</div>