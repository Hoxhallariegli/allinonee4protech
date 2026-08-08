<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.Gym Management') }}</x-nav.divider>

    @php
        $activeClass = 'bg-yellow-50 text-yellow-600 dark:bg-yellow-900/50 dark:text-yellow-400';
        $inactiveClass = 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white';
        $dotActiveClass = 'bg-yellow-600';
        $dotInactiveClass = 'bg-gray-300 dark:bg-gray-700';
    @endphp

    <a href="{{ route('admin.gym-management.dashboard') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*dashboard*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*dashboard*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    <a href="/gym-management"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    <a href="{{ route('admin.gym-management.class-schedules.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*class-schedules*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*class-schedules*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('gym-management/class-schedules.ClassSchedules') }}</span>
    </a>

    <a href="{{ route('admin.gym-management.members.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*members*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*members*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('gym-management/members.Members') }}</span>
    </a>

    <a href="{{ route('admin.gym-management.membership-plans.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*membership-plans*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*membership-plans*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('gym-management/membership-plans.MembershipPlans') }}</span>
    </a>

    <a href="{{ route('admin.gym-management.subscriptions.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*subscriptions*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*subscriptions*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('gym-management/subscriptions.Subscriptions') }}</span>
    </a>

    <a href="{{ route('admin.gym-management.trainers.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*trainers*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*trainers*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('gym-management/trainers.Trainers') }}</span>
    </a>

</div>
