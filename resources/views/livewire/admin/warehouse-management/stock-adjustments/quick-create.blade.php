<div class="p-6">
    @if($created)
        <div class="flex flex-col items-center text-center py-10">
            <div class="w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center mb-4">
                <x-heroicon-o-check class="w-6 h-6 text-green-500" />
            </div>
            <p class="font-bold text-gray-900 dark:text-white">{{ __('warehouse-management/stock-adjustments.created') }}</p>
            @if($createdLabel)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $createdLabel }}</p>@endif
            <button type="button" wire:click="addAnother" class="mt-6 text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('warehouse-management/stock-adjustments.Add StockAdjustment') }}</button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="product_id" wire:model.live="product_id" :label="__('warehouse-management/stock-adjustments.Product Id')" :data="$products" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Product</div></x-slot>
            <x-slot name="content"><livewire:admin.warehouse-management.products.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="warehouse_id" wire:model.live="warehouse_id" :label="__('warehouse-management/stock-adjustments.Warehouse Id')" :data="$warehouses" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Warehouse</div></x-slot>
            <x-slot name="content"><livewire:admin.warehouse-management.warehouses.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="quantity" type="text" wire:model="quantity" :label="__('warehouse-management/stock-adjustments.Quantity')" class="dark:bg-gray-900" /></div>
<div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('warehouse-management/stock-adjustments.Adjustment Type') }}</label><select name="adjustment_type" wire:model="adjustment_type" class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl"><option value="">--</option><option value="addition">addition</option><option value="subtraction">subtraction</option></select></div>
<div class="md:col-span-2"><x-form.textarea name="reason" wire:model="reason" :label="__('warehouse-management/stock-adjustments.Reason')" class="dark:bg-gray-900" /></div></div>
        <div class="mt-8 flex justify-end"><x-button wire:click="store" variant="blue">{{ __('warehouse-management/stock-adjustments.Save') }}</x-button></div>
    @endif
</div>