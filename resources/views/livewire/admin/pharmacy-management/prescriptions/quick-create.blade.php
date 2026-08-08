<div class="p-6">
    @if($created)
        <div class="flex flex-col items-center text-center py-10">
            <div class="w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center mb-4">
                <x-heroicon-o-check class="w-6 h-6 text-green-500" />
            </div>
            <p class="font-bold text-gray-900 dark:text-white">{{ __('pharmacy-management/prescriptions.created') }}</p>
            @if($createdLabel)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $createdLabel }}</p>@endif
            <button type="button" wire:click="addAnother" class="mt-6 text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('pharmacy-management/prescriptions.Add Prescription') }}</button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div><x-form.input name="patient_name" type="text" wire:model="patient_name" :label="__('pharmacy-management/prescriptions.Patient Name')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="doctor_name" type="text" wire:model="doctor_name" :label="__('pharmacy-management/prescriptions.Doctor Name')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="date" type="date" wire:model="date" :label="__('pharmacy-management/prescriptions.Date')" class="dark:bg-gray-900" /></div>
<div><x-form.file-upload name="photo" wire:model="photo" :label="__('pharmacy-management/prescriptions.Photo')" id="photo" :isEditing="false" /></div></div>
        <div class="mt-8 flex justify-end"><x-button wire:click="store" variant="blue">{{ __('pharmacy-management/prescriptions.Save') }}</x-button></div>
    @endif
</div>