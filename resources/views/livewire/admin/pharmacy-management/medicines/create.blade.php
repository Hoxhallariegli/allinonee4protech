<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('pharmacy-management/medicines.Add Medicine') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('pharmacy-management/medicines.New record') }}</x-short-description></div><x-back-btn route="admin.pharmacy-management.medicines.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="store" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div><x-form.input name="name" type="text" wire:model="name" :label="__('pharmacy-management/medicines.Name')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="category" type="text" wire:model="category" :label="__('pharmacy-management/medicines.Category')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="price" type="text" wire:model="price" :label="__('pharmacy-management/medicines.Price')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="stock" type="text" wire:model="stock" :label="__('pharmacy-management/medicines.Stock')" class="dark:bg-gray-900" /></div>
<div><x-form.file-upload name="photo" wire:model="photo" :label="__('pharmacy-management/medicines.Photo')" id="photo" :isEditing="false" /></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('pharmacy-management/medicines.Save') }}</x-button></div></form></div>
</div>