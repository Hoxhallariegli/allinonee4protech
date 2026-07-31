<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('berber/services.Edit Service') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('berber/services.Update info') }}</x-short-description></div><x-back-btn route="admin.berber.services.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700">
        <form wire:submit.prevent="update" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                <div><x-form.input name="name" wire:model="name" :label="__('berber/services.Name')" class="dark:bg-gray-900" /></div>
                <div><x-form.input name="duration_minutes" type="number" wire:model="duration_minutes" :label="__('berber/services.Duration Minutes')" class="dark:bg-gray-900" /></div>
                <div><x-form.input name="price" type="number" step="0.01" wire:model="price" :label="__('berber/services.Price')" class="dark:bg-gray-900" /></div>
                <div><x-form.checkbox name="active" wire:model="active" :label="__('berber/services.Active')" /></div>
            </div>
            <div class="mt-10 flex justify-end">
                <x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('berber/services.Update') }}</x-button>
            </div>
        </form>
    </div>
</div>
