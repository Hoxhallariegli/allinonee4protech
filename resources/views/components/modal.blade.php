@props([
    'modalTitle' => '',
    'content' => '',
    'footer' => '',
    'height' => 'sm:w-full md:w-1/2'
])

<div
    x-data="{
        on: false,
        open() { this.on = true },
        close() { this.on = false }
    }"
    x-effect="if (on) { document.body.classList.add('overflow-hidden') } else { document.body.classList.remove('overflow-hidden') }"
    x-on:close-modal.window="close()"
    x-cloak
>
    <div @click="open()" class="cursor-pointer">
        {{ $trigger }}
    </div>

    <div class="fixed z-[9999] inset-0 flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-sm transition-none"
         x-show="on"
         @keydown.escape.window="close()">

        <div class="bg-white dark:bg-gray-800 dark:text-gray-200 rounded-[2.5rem] shadow-2xl w-full max-w-xl transition-none relative"
             role="dialog"
             aria-modal="true"
             x-show="on"
             @click.away="close()">

            <div class="flex flex-col max-h-[90vh]">
                <header class="p-8 pb-4 text-center mt-4">
                    <h2 class="text-xl font-bold tracking-tight">{{ $modalTitle ?? '' }}</h2>
                </header>

                <main class="px-8 pb-8 overflow-y-auto">
                    {{ $content ?? '' }}
                </main>

                @if($footer)
                    <footer class="p-6 bg-gray-50/50 dark:bg-gray-900/30 rounded-b-[2.5rem] border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3">
                        {{ $footer }}
                    </footer>
                @endif

                <button type="button" @click="close()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600 transition-none p-2">
                    <x-heroicon-o-x-mark class="w-6 h-6" />
                </button>
            </div>
        </div>
    </div>
</div>
