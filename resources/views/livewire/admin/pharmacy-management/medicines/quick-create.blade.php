<div class="p-6">
    @if($created)
        <div class="flex flex-col items-center text-center py-10">
            <div class="w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center mb-4">
                <x-heroicon-o-check class="w-6 h-6 text-green-500" />
            </div>
            <p class="font-bold text-gray-900 dark:text-white">{{ __('pharmacy-management/medicines.created') }}</p>
            @if($createdLabel)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $createdLabel }}</p>@endif
            <button type="button" wire:click="addAnother" class="mt-6 text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('pharmacy-management/medicines.Add Medicine') }}</button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div><x-form.input name="name" type="text" wire:model="name" :label="__('pharmacy-management/medicines.Name')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="category" type="text" wire:model="category" :label="__('pharmacy-management/medicines.Category')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="price" type="text" wire:model="price" :label="__('pharmacy-management/medicines.Price')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="stock" type="text" wire:model="stock" :label="__('pharmacy-management/medicines.Stock')" class="dark:bg-gray-900" /></div>
<div><x-form.file-upload name="photo" wire:model="photo" :label="__('pharmacy-management/medicines.Photo')" id="photo" :isEditing="false" /></div></div>
        <div class="mt-8 flex justify-end"><x-button wire:click="store" variant="blue">{{ __('pharmacy-management/medicines.Save') }}</x-button></div>
    @endif
</div>