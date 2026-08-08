<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.Event Management') }}</x-nav.divider>

    @php
        $activeClass = 'bg-purple-50 text-purple-600 dark:bg-purple-900/50 dark:text-purple-400';
        $inactiveClass = 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white';
        $dotActiveClass = 'bg-purple-600';
        $dotInactiveClass = 'bg-gray-300 dark:bg-gray-700';
    @endphp

    <a href="{{ route('admin.event-management.dashboard') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*dashboard*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*dashboard*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    <a href="/event-management"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    <a href="{{ route('admin.event-management.attendees.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*attendees*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*attendees*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('event-management/attendees.Attendees') }}</span>
    </a>

    <a href="{{ route('admin.event-management.bookings.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*bookings*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*bookings*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('event-management/bookings.Bookings') }}</span>
    </a>

    <a href="{{ route('admin.event-management.events.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*events*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*events*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('event-management/events.Events') }}</span>
    </a>

    <a href="{{ route('admin.event-management.organizers.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*organizers*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*organizers*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('event-management/organizers.Organizers') }}</span>
    </a>

    <a href="{{ route('admin.event-management.ticket-types.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*ticket-types*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*ticket-types*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('event-management/ticket-types.TicketTypes') }}</span>
    </a>

</div>
