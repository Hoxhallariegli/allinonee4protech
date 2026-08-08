<div class="p-6">
    @if($created)
        <div class="flex flex-col items-center text-center py-10">
            <div class="w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center mb-4">
                <x-heroicon-o-check class="w-6 h-6 text-green-500" />
            </div>
            <p class="font-bold text-gray-900 dark:text-white">{{ __('fleet-management/vehicles.created') }}</p>
            @if($createdLabel)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $createdLabel }}</p>@endif
            <button type="button" wire:click="addAnother" class="mt-6 text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('fleet-management/vehicles.Add Vehicle') }}</button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div><x-form.input name="make" type="text" wire:model="make" :label="__('fleet-management/vehicles.Make')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="model" type="text" wire:model="model" :label="__('fleet-management/vehicles.Model')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="year" type="text" wire:model="year" :label="__('fleet-management/vehicles.Year')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="license_plate" type="text" wire:model="license_plate" :label="__('fleet-management/vehicles.License Plate')" class="dark:bg-gray-900" /></div>
<div><x-form.file-upload name="photo" wire:model="photo" :label="__('fleet-management/vehicles.Photo')" id="photo" :isEditing="false" /></div></div>
        <div class="mt-8 flex justify-end"><x-button wire:click="store" variant="blue">{{ __('fleet-management/vehicles.Save') }}</x-button></div>
    @endif
</div>