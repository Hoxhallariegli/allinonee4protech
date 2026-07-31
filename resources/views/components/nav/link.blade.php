@props([
    'route' => '',
    'icon' => '',
    'navEnabled' => true,
])

@php
    $isActive = request()->routeIs($route);

    if (!$isActive && str_ends_with($route, '.index')) {
        $pattern = str_replace('.index', '.*', $route);
        $isActive = request()->routeIs($pattern);
    }
@endphp

<a @if($navEnabled) wire:navigate @endif
    href="{{ route($route) }}"
    class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold transition-all duration-200
    {{ $isActive
        ? 'bg-blue-50/50 dark:bg-blue-900/10 text-blue-600 dark:text-blue-400'
        : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white'
    }}">

    @if ($icon)
        <x-dynamic-component :component="'heroicon-o-' . $icon"
            class="size-5 shrink-0 transition-colors duration-200
            {{ $isActive ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 group-hover:text-gray-600 dark:text-gray-500 dark:group-hover:text-gray-300' }}"
        />
    @else
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ $isActive ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
    @endif

    <span class="truncate">{{ $slot }}</span>
</a>
