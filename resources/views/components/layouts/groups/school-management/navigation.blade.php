<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.School Management') }}</x-nav.divider>

    {{-- Dashboard --}}
    <a href="/modular/school-management/school-management/dashboard"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*/school-management/dashboard') ? 'bg-cyan-50 text-cyan-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*/school-management/dashboard') ? 'bg-cyan-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    {{-- Landing Page --}}
    <a href="/school-management"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    {{-- Guardians --}}
    <a href="/modular/school-management/school-management/guardians"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*guardians*') ? 'bg-cyan-50 text-cyan-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*guardians*') ? 'bg-cyan-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('school-management/guardians.Guardians') }}</span>
    </a>

    {{-- Teachers --}}
    <a href="/modular/school-management/school-management/teachers"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*teachers*') ? 'bg-cyan-50 text-cyan-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*teachers*') ? 'bg-cyan-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('school-management/teachers.Teachers') }}</span>
    </a>

    {{-- School Classes --}}
    <a href="/modular/school-management/school-management/school-classes"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*school-classes*') ? 'bg-cyan-50 text-cyan-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*school-classes*') ? 'bg-cyan-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('school-management/school-classes.SchoolClasses') }}</span>
    </a>

    {{-- Students --}}
    <a href="/modular/school-management/school-management/students"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*students*') ? 'bg-cyan-50 text-cyan-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*students*') ? 'bg-cyan-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('school-management/students.Students') }}</span>
    </a>

    {{-- Attendances --}}
    <a href="/modular/school-management/school-management/attendances"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*attendances*') ? 'bg-cyan-50 text-cyan-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*attendances*') ? 'bg-cyan-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('school-management/attendances.Attendances') }}</span>
    </a>

    {{-- Exams --}}
    <a href="/modular/school-management/school-management/exams"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*exams*') ? 'bg-cyan-50 text-cyan-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*exams*') ? 'bg-cyan-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('school-management/exams.Exams') }}</span>
    </a>

    {{-- Grades --}}
    <a href="/modular/school-management/school-management/grades"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*grades*') ? 'bg-cyan-50 text-cyan-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*grades*') ? 'bg-cyan-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('school-management/grades.Grades') }}</span>
    </a>

</div>
