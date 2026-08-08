<div class="relative min-h-screen bg-slate-50 dark:bg-[#05070d] font-sans overflow-x-hidden selection:bg-indigo-500/30 selection:text-white">

    {{-- Ambient background --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-[20%] -left-[10%] w-[60%] h-[60%] rounded-full bg-indigo-600/[0.07] blur-[140px]"></div>
        <div class="absolute top-[15%] -right-[15%] w-[50%] h-[50%] rounded-full bg-cyan-500/[0.06] blur-[130px]"></div>
        <div class="absolute inset-0 opacity-[0.4] dark:opacity-[0.15]"
             style="background-image: linear-gradient(to right, rgb(148 163 184 / 0.08) 1px, transparent 1px), linear-gradient(to bottom, rgb(148 163 184 / 0.08) 1px, transparent 1px); background-size: 64px 64px;"></div>
    </div>

    {{-- Hero --}}
    <header class="relative z-10 pt-36 pb-16 px-6">
        <div class="max-w-5xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 shadow-sm mb-8">
                <span class="size-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-semibold text-slate-600 dark:text-slate-300">{{ __('welcome.hero_badge') }}</span>
            </div>

            <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-[1.05] mb-6">
                {{ __('welcome.hero_title_1') }}
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-cyan-500">{{ __('welcome.hero_title_accent') }}</span>
            </h1>

            <p class="text-lg text-slate-500 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">
                {{ __('welcome.hero_subtitle') }}
            </p>

            <div class="flex items-center justify-center gap-8 mt-10 text-sm">
                <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400">
                    <x-heroicon-o-cube class="size-4 text-indigo-500" />
                    <span><span class="font-bold text-slate-800 dark:text-white">{{ count($modules) }}</span> {{ __('welcome.active_modules') }}</span>
                </div>
                <div class="w-px h-4 bg-slate-300 dark:bg-white/10"></div>
                <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400">
                    <x-heroicon-o-shield-check class="size-4 text-emerald-500" />
                    <span>{{ __('welcome.isolated_data') }}</span>
                </div>
            </div>
        </div>
    </header>

    {{-- Modules grid --}}
    <main class="relative z-10 max-w-7xl mx-auto px-6 pb-28">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($modules as $module)
                <a href="{{ $module['url'] }}"
                   style="--accent: {{ $module['color'] }};"
                   class="module-card group relative flex flex-col h-full p-7 bg-white dark:bg-white/[0.03] rounded-2xl border border-slate-200 dark:border-white/[0.07] hover:border-transparent shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

                    <div class="absolute inset-x-0 top-0 h-1 rounded-t-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background-color: var(--accent);"></div>

                    <div class="flex items-start justify-between mb-6">
                        <div class="size-12 rounded-xl flex items-center justify-center transition-transform duration-300 group-hover:scale-105"
                             style="background-color: color-mix(in srgb, var(--accent) 12%, transparent);">
                            <x-dynamic-component :component="'heroicon-o-' . $module['icon']" class="size-6" style="color: var(--accent);" />
                        </div>
                        <span class="px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                            Aktiv
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 tracking-tight">
                        {{ $module['name'] }}
                    </h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed flex-1 mb-6">
                        {{ $module['description'] }}
                    </p>

                    <div class="flex items-center gap-1.5 text-sm font-semibold" style="color: var(--accent);">
                        {{ __('welcome.open_module') }}
                        <x-heroicon-o-arrow-right class="size-4 group-hover:translate-x-1 transition-transform duration-300" />
                    </div>
                </a>
            @endforeach

            {{-- Custom solution card --}}
            <div class="relative flex flex-col h-full p-7 rounded-2xl border-2 border-dashed border-slate-300 dark:border-white/10 hover:border-indigo-400 dark:hover:border-indigo-500/50 transition-colors duration-300 items-start justify-center bg-slate-50/50 dark:bg-transparent">
                <div class="size-12 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center mb-6">
                    <x-heroicon-o-plus class="size-6 text-indigo-500" />
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 tracking-tight">{{ __('welcome.custom_solution') }}</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed mb-6">
                    {{ __('welcome.custom_solution_desc') }}
                </p>
                <a href="mailto:info@e4protech.com"
                   class="inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:gap-2.5 transition-all">
                    {{ __('welcome.contact_us') }}
                    <x-heroicon-o-arrow-right class="size-4" />
                </a>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="relative z-10 border-t border-slate-200 dark:border-white/[0.06] py-10 px-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <div class="size-8 rounded-lg bg-gradient-to-br from-indigo-600 to-blue-600 flex items-center justify-center">
                    <span class="text-white font-bold text-xs">E4</span>
                </div>
                <span class="text-sm font-semibold text-slate-500 dark:text-slate-400">E4ProTech Ecosystem — Next-Gen Business OS</span>
            </div>
            <div class="flex gap-6">
                <a href="#" class="text-xs font-semibold text-slate-400 dark:text-slate-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Instagram</a>
                <a href="#" class="text-xs font-semibold text-slate-400 dark:text-slate-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">LinkedIn</a>
                <a href="#" class="text-xs font-semibold text-slate-400 dark:text-slate-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Website</a>
            </div>
        </div>
    </footer>
</div>
