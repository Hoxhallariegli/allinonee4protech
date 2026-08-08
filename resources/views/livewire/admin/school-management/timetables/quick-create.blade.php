<div class="p-6">
    @if($created)
        <div class="flex flex-col items-center text-center py-10">
            <div class="w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 flex items-center justify-center mb-4">
                <x-heroicon-o-check class="w-6 h-6 text-green-500" />
            </div>
            <p class="font-bold text-gray-900 dark:text-white">{{ __('school-management/timetables.created') }}</p>
            @if($createdLabel)<p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $createdLabel }}</p>@endif
            <button type="button" wire:click="addAnother" class="mt-6 text-xs font-black uppercase tracking-widest text-blue-600 dark:text-blue-400">{{ __('school-management/timetables.Add Timetable') }}</button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="school_class_id" wire:model.live="school_class_id" :label="__('school-management/timetables.School Class Id')" :data="$schoolClasses" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New SchoolClass</div></x-slot>
            <x-slot name="content"><livewire:admin.school-management.school-classes.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="subject_id" wire:model.live="subject_id" :label="__('school-management/timetables.Subject Id')" :data="$subjects" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Subject</div></x-slot>
            <x-slot name="content"><livewire:admin.school-management.subjects.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div>
    <div class="flex items-end gap-2">
        <div class="flex-1"><x-form.dropdown-search name="teacher_id" wire:model.live="teacher_id" :label="__('school-management/timetables.Teacher Id')" :data="$teachers" /></div>
        <x-modal>
            <x-slot name="trigger"><button type="button" @click="on = true" class="mb-6 p-3 bg-blue-50 dark:bg-zinc-900/30 text-blue-600 dark:text-blue-400 rounded-2xl hover:scale-105 transition-transform"><x-heroicon-o-plus class="w-5 h-5" /></button></x-slot>
            <x-slot name="modalTitle"><div class="dark:text-white px-6 pt-6">Add New Teacher</div></x-slot>
            <x-slot name="content"><livewire:admin.school-management.teachers.quick-create /></x-slot>
        </x-modal>
    </div>
</div>
<div><label class="block mb-1.5 text-[10px] font-bold uppercase tracking-widest">{{ __('school-management/timetables.Day') }}</label><select name="day" wire:model="day" class="w-full p-3 text-sm font-bold bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl"><option value="">--</option><option value="monday">monday</option><option value="tuesday">tuesday</option><option value="wednesday">wednesday</option><option value="thursday">thursday</option><option value="friday">friday</option><option value="saturday">saturday</option></select></div>
<div><x-form.input name="start_time" type="text" wire:model="start_time" :label="__('school-management/timetables.Start Time')" class="dark:bg-gray-900" /></div>
<div><x-form.input name="end_time" type="text" wire:model="end_time" :label="__('school-management/timetables.End Time')" class="dark:bg-gray-900" /></div></div>
        <div class="mt-8 flex justify-end"><x-button wire:click="store" variant="blue">{{ __('school-management/timetables.Save') }}</x-button></div>
    @endif
</div>