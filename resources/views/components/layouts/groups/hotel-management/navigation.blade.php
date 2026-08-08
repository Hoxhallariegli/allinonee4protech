<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.Hotel Management') }}</x-nav.divider>

    @php
        $activeClass = 'bg-rose-50 text-rose-500 dark:bg-rose-900/50 dark:text-rose-400';
        $inactiveClass = 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white';
        $dotActiveClass = 'bg-rose-500';
        $dotInactiveClass = 'bg-gray-300 dark:bg-gray-700';
    @endphp

    <a href="{{ route('admin.hotel-management.dashboard') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*dashboard*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*dashboard*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    <a href="/hotel-management"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    <a href="{{ route('admin.hotel-management.guests.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*guests*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*guests*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('hotel-management/guests.Guests') }}</span>
    </a>

    <a href="{{ route('admin.hotel-management.hotel-rooms.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*hotel-rooms*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*hotel-rooms*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('hotel-management/hotel-rooms.HotelRooms') }}</span>
    </a>

    <a href="{{ route('admin.hotel-management.housekeepings.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*housekeepings*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*housekeepings*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('hotel-management/housekeepings.Housekeepings') }}</span>
    </a>

    <a href="{{ route('admin.hotel-management.reservations.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*reservations*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*reservations*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('hotel-management/reservations.Reservations') }}</span>
    </a>

    <a href="{{ route('admin.hotel-management.room-types.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*room-types*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*room-types*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('hotel-management/room-types.RoomTypes') }}</span>
    </a>

</div>
