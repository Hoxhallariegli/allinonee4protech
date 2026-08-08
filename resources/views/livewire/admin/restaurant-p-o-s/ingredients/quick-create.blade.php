<div class="p-6">
    @if($created)
        <div class="flex flex-col items-center text-center py-10">
            <div class="w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center mb-4">
                <x-heroicon-o-check class="w-6 h-6 text-green-500" />
            </div>
            <p class="font-bold text-gray-900 dark:text-white">{{ __('restaurant-p-o-s/ingredients.created') }}</p>
            @if($createdLabel)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $createdLabel }}</p>@endif
            <button type="button" wire:click="addAnother" class="mt-6 text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('restaurant-p-o-s/ingredients.Add Ingredient') }}</button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div><x-form.input name="name" type="text" wire:model="name" :label="__('restaurant-p-o-s/ingredients.Name')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="stock_quantity" type="text" wire:model="stock_quantity" :label="__('restaurant-p-o-s/ingredients.Stock Quantity')" class="dark:bg-gray-900" /></div>
<div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('restaurant-p-o-s/ingredients.Unit') }}</label><select name="unit" wire:model="unit" class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl"><option value="">--</option><option value="kg">kg</option><option value="liters">liters</option><option value="pcs">pcs</option><option value="grams">grams</option></select></div></div>
        <div class="mt-8 flex justify-end"><x-button wire:click="store" variant="blue">{{ __('restaurant-p-o-s/ingredients.Save') }}</x-button></div>
    @endif
</div>