@props([
    'label' => '',
    'icon' => 'rectangle-group',
    'route' => ''
])

@php
    $isOpen = Route::is($route . '*');
@endphp

<div x-data="{ isOpen: @js($isOpen) }" class="mb-0.5">
    <button @click="isOpen = !isOpen"
        class="w-full group flex items-start justify-between px-3 py-2 rounded-xl transition-all duration-200 text-left
        {{ $isOpen
            ? 'bg-gray-50 dark:bg-gray-900/50'
            : 'hover:bg-gray-50 dark:hover:bg-gray-900/50'
        }}">

        <div class="flex items-start gap-3 text-left">
            <x-dynamic-component :component="'heroicon-o-' . $icon"
                class="size-5 mt-0.5 shrink-0 transition-colors duration-200
                {{ $isOpen
                    ? 'text-blue-600 dark:text-blue-400'
                    : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300'
                }}"
            />

            <span class="text-sm font-semibold tracking-tight transition-colors duration-200 leading-tight
                {{ $isOpen
                    ? 'text-gray-900 dark:text-white'
                    : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-gray-200'
                }}">
                {{ $label }}
            </span>
        </div>

        <x-heroicon-o-chevron-right
            class="size-3.5 mt-1 shrink-0 transition-transform duration-300 text-gray-400"
            ::class="isOpen ? 'rotate-90 text-blue-500' : ''"
        />
    </button>

    <div x-show="isOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="mt-0.5 pl-4 space-y-0.5">
        {{ $slot }}
    </div>
</div>
