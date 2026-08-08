<div class="space-y-6">
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-black tracking-tight text-gray-900 dark:text-white uppercase">
            {{ __('admin.Enterprise Ecosystem') }}
        </h1>
        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest flex items-center gap-2">
            <span class="size-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
            {{ __('admin.Active Management Modules') }}
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-4">
        @foreach($modules as $module)
            @php
                $color = is_string($module->ui_color) ? $module->ui_color : 'indigo';
                $icon = is_string($module->ui_icon) ? $module->ui_icon : 'rectangle-group';
                $desc = is_string($module->ui_description) ? $module->ui_description : '';
                $label = is_string($module->label) ? $module->label : 'Module';
                $adminRoute = is_string($module->admin_route) ? $module->admin_route : '#';
                $frontRoute = is_string($module->front_route) ? $module->front_route : '#';
            @endphp
            <div class="group relative bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700/50 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full overflow-hidden">

                {{-- Minimal Accent Glow --}}
                <div class="absolute -right-10 -top-10 size-32 bg-{{ $color }}-500/5 blur-[40px] rounded-full group-hover:bg-{{ $color }}-500/10 transition-all duration-500"></div>

                <div class="p-5 flex-1 relative z-10">
                    {{-- Compact Icon Box --}}
                    <div class="mb-4 inline-flex">
                        <div class="size-10 rounded-2xl bg-{{ $color }}-50 dark:bg-{{ $color }}-900/20 flex items-center justify-center text-{{ $color }}-600 shadow-xs transition-all duration-300 group-hover:scale-110 group-hover:bg-{{ $color }}-600 group-hover:text-white">
                            <x-dynamic-component :component="'heroicon-o-' . $icon" class="size-5" />
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="space-y-2">
                        <h3 class="text-sm font-black text-gray-900 dark:text-white tracking-tight uppercase group-hover:text-{{ $color }}-600 transition-colors">
                            {{ $label }}
                        </h3>
                        <p class="text-[11px] leading-relaxed text-gray-500 dark:text-gray-400 font-medium line-clamp-2">
                            {{ $desc }}
                        </p>
                    </div>
                </div>

                {{-- Compact Action Bar --}}
                <div class="p-4 pt-0 relative z-10">
                    <div class="flex flex-col gap-2">
                        <a href="{{ $adminRoute }}"
                           class="flex items-center justify-between px-4 py-2.5 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-{{ $color }}-600 dark:hover:bg-{{ $color }}-600 dark:hover:text-white transition-all duration-200">
                            <span>{{ __('admin.Admin') }}</span>
                            <x-heroicon-o-arrow-right class="size-3" />
                        </a>

                        <a href="{{ $frontRoute }}"
                           target="_blank"
                           class="flex items-center justify-center gap-1.5 px-4 py-2 bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-700 rounded-xl text-[9px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
                            <x-heroicon-o-globe-alt class="size-3" />
                            {{ __('admin.Landing') }}
                        </a>
                    </div>
                </div>

                {{-- Slim Status Bar --}}
                <div class="absolute bottom-0 left-0 h-1 w-full bg-{{ $color }}-600/10 group-hover:bg-{{ $color }}-600 transition-all duration-500"></div>
            </div>
        @endforeach
    </div>
</div>
