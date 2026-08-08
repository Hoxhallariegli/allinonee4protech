<div class="p-6">
    @if($created)
        <div class="flex flex-col items-center text-center py-10">
            <div class="w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center mb-4">
                <x-heroicon-o-check class="w-6 h-6 text-green-500" />
            </div>
            <p class="font-bold text-gray-900 dark:text-white">{{ __('real-estate-c-r-m/properties.created') }}</p>
            @if($createdLabel)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $createdLabel }}</p>@endif
            <button type="button" wire:click="addAnother" class="mt-6 text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('real-estate-c-r-m/properties.Add Property') }}</button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div><x-form.input name="title" type="text" wire:model="title" :label="__('real-estate-c-r-m/properties.Title')" class="dark:bg-gray-900" /></div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="owner_id" wire:model.live="owner_id" :label="__('real-estate-c-r-m/properties.Owner Id')" :data="$owners" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Owner</div></x-slot>
            <x-slot name="content"><livewire:admin.real-estate-c-r-m.owners.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="agent_id" wire:model.live="agent_id" :label="__('real-estate-c-r-m/properties.Agent Id')" :data="$agents" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Agent</div></x-slot>
            <x-slot name="content"><livewire:admin.real-estate-c-r-m.agents.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="price" type="text" wire:model="price" :label="__('real-estate-c-r-m/properties.Price')" class="dark:bg-gray-900" /></div>
<div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('real-estate-c-r-m/properties.Type') }}</label><select name="type" wire:model="type" class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl"><option value="">--</option><option value="apartment">apartment</option><option value="house">house</option><option value="land">land</option></select></div>
<div><x-form.file-upload name="photo" wire:model="photo" :label="__('real-estate-c-r-m/properties.Photo')" id="photo" :isEditing="false" /></div></div>
        <div class="mt-8 flex justify-end"><x-button wire:click="store" variant="blue">{{ __('real-estate-c-r-m/properties.Save') }}</x-button></div>
    @endif
</div>