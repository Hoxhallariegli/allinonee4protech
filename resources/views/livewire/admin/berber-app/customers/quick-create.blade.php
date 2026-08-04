<div class="p-6">
    @if($created)
        <div class="flex flex-col items-center text-center py-10">
            <div class="w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center mb-4">
                <x-heroicon-o-check class="w-6 h-6 text-green-500" />
            </div>
            <p class="font-bold text-gray-900 dark:text-white">Customer Created</p>
            @if($createdLabel)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $createdLabel }}</p>@endif
            <button type="button" wire:click="addAnother" class="mt-6 text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">Add Another</button>
        </div>
    @else
        <div class="grid grid-cols-1 gap-y-6">
            <div><x-form.input name="name" wire:model="name" label="Name" class="dark:bg-gray-900" /></div>
            <div><x-form.input name="phone" wire:model="phone" label="Phone" class="dark:bg-gray-900" /></div>
            <div><x-form.input name="email" wire:model="email" label="Email (Optional)" class="dark:bg-gray-900" /></div>
        </div>
        <div class="mt-8 flex justify-end"><x-button wire:click="store" variant="blue">Save</x-button></div>
    @endif
</div>
