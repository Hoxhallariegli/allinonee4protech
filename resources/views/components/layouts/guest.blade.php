<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="fixed top-4 right-4 z-50">
            <!-- Language Switcher -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-1 text-sm font-bold uppercase focus:outline-none text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors bg-white dark:bg-gray-800 px-3 py-1.5 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <span>{{ app()->getLocale() }}</span>
                    <x-heroicon-o-chevron-down class="size-3" />
                </button>
                <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-24 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-100 dark:border-gray-700 z-50 overflow-hidden">
                    @php
                        $languages = ['en'];
                        if (File::exists(lang_path())) {
                            foreach (File::directories(lang_path()) as $dir) {
                                $lang = basename($dir);
                                if (strlen($lang) <= 5 && !in_array($lang, $languages)) $languages[] = $lang;
                            }
                            foreach (File::files(lang_path()) as $file) {
                                if ($file->getExtension() === 'json') {
                                    $lang = str_replace('.json', '', $file->getFilename());
                                    if (strlen($lang) <= 5 && !in_array($lang, $languages)) $languages[] = $lang;
                                }
                            }
                        }
                        sort($languages);
                    @endphp
                    @foreach($languages as $lang)
                        <a href="{{ route('language.switch', $lang) }}" class="block px-4 py-2 text-xs font-bold uppercase hover:bg-gray-50 dark:hover:bg-gray-700 {{ app()->getLocale() == $lang ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-300' }}">{{ $lang }}</a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
