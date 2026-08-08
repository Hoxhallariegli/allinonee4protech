<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1">
        <div>
            <x-h1>{{ __('admin.Module Management') }}</x-h1>
            <x-short-description class="dark:text-gray-400">{{ __('Enable or disable ERP modular groups globally') }}</x-short-description>
        </div>
        <x-back-btn route="admin.settings" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($modules as $module)
            <div class="bg-white dark:bg-gray-800 p-6 rounded-[2rem] border border-gray-100 dark:border-gray-700 shadow-sm flex items-center justify-between group hover:border-blue-500/50 transition-all">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-2xl text-gray-400 group-hover:text-blue-500 transition-colors">
                        <x-dynamic-component :component="'heroicon-o-' . ($module->icon ?: 'cube')" class="size-6" />
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 dark:text-white">{{ $module->label }}</p>
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500">{{ $module->key }}</p>
                    </div>
                </div>

                <button
                    wire:click="toggleModule({{ $module->id }})"
                    class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $module->is_active ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-700' }}"
                >
                    <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $module->is_active ? 'translate-x-5' : 'translate-x-0' }}"></span>
                </button>
            </div>
        @endforeach
    </div>
</div>
