<div class="p-6">
    @if($created)
        <div class="flex flex-col items-center text-center py-10">
            <div class="w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center mb-4">
                <x-heroicon-o-check class="w-6 h-6 text-green-500" />
            </div>
            <p class="font-bold text-gray-900 dark:text-white">{{ __('clinic-management/medical-vitals.created') }}</p>
            @if($createdLabel)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $createdLabel }}</p>@endif
            <button type="button" wire:click="addAnother" class="mt-6 text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('clinic-management/medical-vitals.Add MedicalVital') }}</button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="patient_id" wire:model.live="patient_id" :label="__('clinic-management/medical-vitals.Patient Id')" :data="$patients" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Patient</div></x-slot>
            <x-slot name="content"><livewire:admin.clinic-management.patients.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><x-form.input name="weight_kg" type="text" wire:model="weight_kg" :label="__('clinic-management/medical-vitals.Weight Kg')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="blood_pressure" type="text" wire:model="blood_pressure" :label="__('clinic-management/medical-vitals.Blood Pressure')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="pulse_bpm" type="text" wire:model="pulse_bpm" :label="__('clinic-management/medical-vitals.Pulse Bpm')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="temperature_c" type="text" wire:model="temperature_c" :label="__('clinic-management/medical-vitals.Temperature C')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="recorded_at" type="date" wire:model="recorded_at" :label="__('clinic-management/medical-vitals.Recorded At')" class="dark:bg-gray-900" /></div></div>
        <div class="mt-8 flex justify-end"><x-button wire:click="store" variant="blue">{{ __('clinic-management/medical-vitals.Save') }}</x-button></div>
    @endif
</div>