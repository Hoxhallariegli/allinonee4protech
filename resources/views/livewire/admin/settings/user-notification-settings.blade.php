<div class="space-y-6">
    <div class="flex items-center justify-between gap-4 px-1">
        <div>
            <x-h1>Notification Preferences</x-h1>
            <x-short-description>Manage which events trigger notifications for you.</x-short-description>
        </div>
    </div>

    <div class="card">
        <div class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach($modules as $module => $events)
                <div class="py-6 first:pt-0 last:pb-0">
                    <h3 class="text-sm font-black uppercase tracking-widest text-gray-400 mb-4">{{ str_replace('App', ' App', $module) }}</h3>
                    <div class="space-y-4">
                        @foreach($events as $event => $label)
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $label }}</p>
                                    <p class="text-xs text-gray-500">{{ ucfirst($event) }} notifications</p>
                                </div>
                                <div class="flex items-center">
                                    <button
                                        wire:click="toggle('{{ $module }}', '{{ $event }}')"
                                        type="button"
                                        class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $settings[$module][$event] ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-700' }}"
                                    >
                                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $settings[$module][$event] ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
