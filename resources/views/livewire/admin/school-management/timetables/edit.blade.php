<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1"><div><x-h1>{{ __('school-management/timetables.Edit Timetable') }}</x-h1><x-short-description class="dark:text-gray-400">{{ __('school-management/timetables.Update info') }}</x-short-description></div><x-back-btn route="admin.school-management.timetables.index" /></div>
    @include('errors.errors')
    <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700"><form wire:submit.prevent="update" class="space-y-8"><div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8"><div>
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
<div><x-form.input name="end_time" type="text" wire:model="end_time" :label="__('school-management/timetables.End Time')" class="dark:bg-gray-900" /></div></div><div class="mt-10 flex justify-end"><x-button type="submit" variant="blue" class="w-full sm:w-auto !px-12 !py-4 !rounded-2xl">{{ __('school-management/timetables.Update') }}</x-button></div></form></div>
</div>