@props([
    'route' => '',
    'icon' => ''
])

@php
    $isActive = request()->routeIs($route);
@endphp

<a wire:navigate href="{{ route($route) }}"
   class="group flex items-center gap-3 rounded-xl px-3 py-1.5 text-[13px] font-bold transition-all duration-200
   {{ $isActive
        ? 'text-blue-600 dark:text-blue-400 bg-blue-50/50 dark:bg-blue-900/10'
        : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200'
   }}">
    @if ($icon)
        <x-dynamic-component :component="'heroicon-o-' . $icon" class="size-4 transition-transform group-hover:scale-110 {{ $isActive ? 'text-blue-600' : 'text-gray-400' }}" />
    @else
        <div class="size-1 rounded-full {{ $isActive ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
    @endif
    <span class="truncate">{{ $slot }}</span>
</a>
