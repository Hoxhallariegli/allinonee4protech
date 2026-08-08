<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') {{ $title ?? null }} - {{ config('app.name', 'Laravel') }}</title>
    @stack('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // Theme Loader
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (savedTheme === 'dark' || savedTheme === 'light') {
                document.documentElement.classList.toggle('dark', savedTheme === 'dark');
            } else if (prefersDark) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        })();

        // Global Notification Request Fallback
        window.requestNotificationPermission = function() {
            console.warn('Firebase helper initialized (Default). Waiting for config...');
        };
    </script>

    @if(config('firebase_enabled') && config('firebase_web_config'))
        <script src="https://www.gstatic.com/firebasejs/9.1.1/firebase-app-compat.js"></script>
        <script src="https://www.gstatic.com/firebasejs/9.1.1/firebase-messaging-compat.js"></script>
        <script>
            (function() {
                const isDebug = {{ config('firebase_debug', false) ? 'true' : 'false' }};
                const rawConfig = `{!! config('firebase_web_config') !!}`;

                try {
                    // Normalize JS Object to valid JSON
                    const jsonConfig = rawConfig.trim()
                        .replace(/([{,]\s*)([a-zA-Z0-9_]+)\s*:/g, '$1"$2":')
                        .replace(/'/g, '"')
                        .replace(/,\s*}/g, '}');

                    const firebaseConfig = JSON.parse(jsonConfig);
                    firebase.initializeApp(firebaseConfig);
                    const messaging = firebase.messaging();

                    window.requestNotificationPermission = function() {
                        if (!('Notification' in window)) return;
                        Notification.requestPermission().then((permission) => {
                            if (permission === 'granted') {
                                navigator.serviceWorker.ready.then((registration) => {
                                    messaging.getToken({ serviceWorkerRegistration: registration }).then((token) => {
                                        if (window.Livewire) {
                                            window.Livewire.dispatch('fcm-token-received', { token: token });
                                        }
                                    });
                                });
                            }
                        });
                    };

                    if (isDebug) console.log('🔥 Firebase initialized successfully.');

                    // Handle messages when app is in foreground
                    messaging.onMessage((payload) => {
                        if (isDebug) console.log('📩 Message received (Foreground):', payload);

                        // 1. Shfaq Toast-in
                        window.dispatchEvent(new CustomEvent('toast', {
                            detail: {
                                message: payload.notification.title + ": " + payload.notification.body,
                                type: 'info'
                            }
                        }));

                        // 2. Shfaq Njoftimin e Windows-it (Surgical Force)
                        if (Notification.permission === "granted") {
                            navigator.serviceWorker.ready.then(registration => {
                                registration.showNotification(payload.notification.title, {
                                    body: payload.notification.body,
                                    icon: '/favicon.ico'
                                });
                            });
                        }
                    });

                    // Register Service Worker and Get Token
                    if ('serviceWorker' in navigator) {
                        navigator.serviceWorker.register('/firebase-messaging-sw.js')
                            .then((registration) => {
                                if (isDebug) console.log('⚙️ Service Worker registered.');

                                Notification.requestPermission().then((permission) => {
                                    if (permission === 'granted') {
                                        messaging.getToken({ serviceWorkerRegistration: registration }).then((token) => {
                                            if (isDebug) console.log('🔑 FCM Token:', token);

                                            // Njoftojmë Livewire për token-in e ri
                                            if (window.Livewire) {
                                                window.Livewire.dispatch('fcm-token-received', { token: token });
                                            }
                                        });
                                    }
                                });
                            }).catch(err => {
                                if (isDebug) console.error('❌ SW Registration failed:', err);
                            });
                    }
                } catch (e) {
                    if (isDebug) console.error('💥 Firebase Boot Error:', e.message);
                }
            })();
        </script>
    @endif
</head>
<body>

<div
  x-data="{ userDropdownOpen: false, mobileSidebarOpen: false, desktopSidebarOpen: true }"
  x-bind:class="{ 'lg:pl-64': desktopSidebarOpen }"
  id="page-container"
  class="mx-auto flex min-h-dvh w-full min-w-80 flex-col bg-gray-100 lg:pl-64 dark:bg-gray-900 dark:text-gray-100"
>

  <nav
    x-bind:class="{
      '-translate-x-full': !mobileSidebarOpen,
      'translate-x-0': mobileSidebarOpen,
      'lg:-translate-x-full': !desktopSidebarOpen,
      'lg:translate-x-0': desktopSidebarOpen,
    }"
    id="page-sidebar"
    class="fixed top-0 bottom-0 left-0 z-50 flex h-full w-full -translate-x-full flex-col border-r border-gray-200 bg-white transition-transform duration-500 ease-out lg:w-64 lg:translate-x-0 dark:border-gray-800 dark:bg-gray-800 dark:text-gray-200"
    aria-label="Main Sidebar Navigation"
  >
    @php
        $path = request()->path();
        $modules = [
            'berber-app' => ['label' => 'Berber App', 'icon' => 'scissors', 'color' => 'bg-blue-600 dark:bg-blue-900'],
            'clinic-management' => ['label' => 'Clinic Central', 'icon' => 'heart', 'color' => 'bg-rose-600 dark:bg-rose-900'],
            'auto-repair-management' => ['label' => 'Auto Repair', 'icon' => 'wrench', 'color' => 'bg-amber-600 dark:bg-amber-900'],
            'construction-e-r-p' => ['label' => 'Construction', 'icon' => 'building-office-2', 'color' => 'bg-emerald-600 dark:bg-emerald-900'],
            'warehouse-management' => ['label' => 'Warehouse', 'icon' => 'archive-box', 'color' => 'bg-indigo-600 dark:bg-indigo-900'],
            'restaurant-p-o-s' => ['label' => 'Restaurant', 'icon' => 'cake', 'color' => 'bg-orange-600 dark:bg-orange-900'],
            'school-management' => ['label' => 'School', 'icon' => 'academic-cap', 'color' => 'bg-cyan-600 dark:bg-cyan-900'],
            'real-estate-c-r-m' => ['label' => 'Real Estate', 'icon' => 'home-modern', 'color' => 'bg-teal-600 dark:bg-teal-900'],
            'c-r-m' => ['label' => 'CRM', 'icon' => 'user-group', 'color' => 'bg-violet-600 dark:bg-violet-900'],
            'hotel-management' => ['label' => 'Hotel', 'icon' => 'home-modern', 'color' => 'bg-rose-500 dark:bg-rose-800'],
            'human-resources' => ['label' => 'HR', 'icon' => 'users', 'color' => 'bg-blue-500 dark:bg-blue-800'],
            'e--commerce' => ['label' => 'Shop', 'icon' => 'shopping-cart', 'color' => 'bg-pink-600 dark:bg-pink-900'],
            'fleet-management' => ['label' => 'Fleet', 'icon' => 'truck', 'color' => 'bg-gray-600 dark:bg-gray-900'],
            'gym-management' => ['label' => 'Gym', 'icon' => 'bolt', 'color' => 'bg-yellow-600 dark:bg-yellow-900'],
            'finance' => ['label' => 'Finance', 'icon' => 'banknotes', 'color' => 'bg-emerald-500 dark:bg-emerald-800'],
            'legal-management' => ['label' => 'Legal', 'icon' => 'scale', 'color' => 'bg-slate-600 dark:bg-slate-900'],
            'pharmacy-management' => ['label' => 'Pharmacy', 'icon' => 'beaker', 'color' => 'bg-green-600 dark:bg-green-900'],
            'event-management' => ['label' => 'Events', 'icon' => 'sparkles', 'color' => 'bg-purple-600 dark:bg-purple-900'],
            'travel-agency' => ['label' => 'Travel', 'icon' => 'globe-alt', 'color' => 'bg-sky-600 dark:bg-sky-900'],
            'facility-management' => ['label' => 'Facilities', 'icon' => 'wrench-screwdriver', 'color' => 'bg-stone-600 dark:bg-stone-900'],
            'agriculture-management' => ['label' => 'Agri', 'icon' => 'sun', 'color' => 'bg-lime-600 dark:bg-lime-900']
        ];

        $activeModule = null;
        // Search for active module based on path
        foreach ($modules as $slug => $data) {
            if (str_contains($path, $slug)) {
                $activeModule = array_merge($data, ['slug' => $slug]);
                break;
            }
        }
    @endphp

    @if($activeModule)
        <div class="flex h-16 w-full flex-none items-center justify-between px-6 lg:justify-start gap-3 {{ $activeModule['color'] }}">
          <x-heroicon-o-rectangle-group class="size-6 text-white" />
          <span class="text-lg font-black tracking-widest text-white uppercase">{{ $activeModule['label'] }}</span>
          <div class="lg:hidden ml-auto">
            <button x-on:click="mobileSidebarOpen = false" type="button" class="text-white">
              <x-heroicon-o-x-mark class="size-6" />
            </button>
          </div>
        </div>
    @else
        <div class="flex h-16 w-full flex-none items-center justify-between px-4 lg:justify-center dark:bg-gray-600/25">
          <x-a href="{{ route('dashboard') }}" class="group inline-flex items-center gap-2 text-lg font-bold tracking-wide text-gray-900 hover:text-gray-600 dark:text-gray-100 dark:hover:text-gray-300">
            <span>{{ config('app.name') }}</span>
          </x-a>
          <div class="lg:hidden">
            <button x-on:click="mobileSidebarOpen = false" type="button" class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm leading-5 font-semibold text-gray-800 hover:border-gray-300 hover:text-gray-900 hover:shadow-xs focus:ring-3 focus:ring-gray-300/25 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700">
              <x-heroicon-o-x-mark class="size-5" />
            </button>
          </div>
        </div>
    @endif

    <div class="overflow-y-auto">
      <div class="w-full p-4">
        <nav class="space-y-1">
            @php
                $navInclude = $activeModule
                    ? "components.layouts.groups.{$activeModule['slug']}.navigation"
                    : "components.layouts.app.navigation";
            @endphp

            @if(view()->exists($navInclude))
                @include($navInclude)
            @else
                @include('components.layouts.app.navigation')
            @endif
        </nav>
      </div>
    </div>
  </nav>

  <header x-bind:class="{ 'lg:pl-64': true }" id="page-header" class="fixed top-0 right-0 left-0 z-30 flex h-16 flex-none items-center bg-white shadow-xs lg:pl-64 dark:bg-gray-800">
    <div class="mx-auto flex w-full max-w-10xl justify-between px-4 lg:px-8">
      <div class="flex items-center gap-2">
        <div class="lg:hidden">
          <button x-on:click="mobileSidebarOpen = !mobileSidebarOpen" type="button" class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm leading-5 font-semibold text-gray-800 hover:border-gray-300 hover:text-gray-900 hover:shadow-xs focus:ring-3 focus:ring-gray-300/25 active:border-gray-200 active:shadow-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-gray-200 dark:focus:ring-gray-600/40 dark:active:border-gray-700">
            <x-heroicon-o-bars-3-center-left class="size-5" />
          </button>
        </div>
      </div>

      <div class="flex items-center gap-3">
          <button id="theme-toggle">
              <svg id="theme-toggle-light" class="size-5 -mt-1 text-yellow-500 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M3 12h2.25m.386-6.364 1.591 1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12a6.75 6.75 0 1 1 13.5 0 6.75 6.75 0 0 1-13.5 0Z" /></svg>
              <svg id="theme-toggle-dark" class="size-5 -mt-1 text-gray-900 dark:text-white hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" /></svg>
          </button>

          <!-- Language Switcher -->
          <div x-data="{ open: false }" class="relative">
              <button @click="open = !open" class="flex items-center gap-1 text-sm font-bold uppercase focus:outline-none">
                  <span>{{ app()->getLocale() }}</span>
                  <x-heroicon-o-chevron-down class="size-3" />
              </button>
              <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-24 bg-white dark:bg-gray-700 rounded-lg shadow-xl border border-gray-100 dark:border-gray-600 z-50">
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
                    <a href="{{ route('language.switch', $lang) }}" class="block px-4 py-2 text-xs font-bold uppercase hover:bg-gray-100 dark:hover:bg-gray-600 {{ $loop->first ? 'rounded-t-lg' : '' }} {{ $loop->last ? 'rounded-b-lg' : '' }}">{{ $lang }}</a>
                  @endforeach
              </div>
          </div>

          <livewire:admin.notifications-menu/>
          <livewire:admin.users.user-menu/>
      </div>
    </div>
  </header>

  <main id="page-content" class="flex max-w-full flex-auto flex-col pt-16">
    <div class="mx-auto w-full max-w-10xl p-4 lg:p-8">
        {{ $slot ?? '' }}
    </div>
  </main>

  <footer id="page-footer" class="flex flex-none items-center bg-white dark:bg-gray-800/50">
    <div class="mx-auto flex w-full max-w-10xl flex-col px-4 text-center text-sm md:flex-row md:justify-between md:text-left lg:px-8">
      <div class="pt-4 pb-1 md:pb-4">
        {{ __('Copyright') }} &copy; {{ date('Y') }} {{ config('app.name') }}
      </div>
      <div class="inline-flex items-center justify-center pt-1 pb-4 md:pt-4">
        <span>
            {{ __('Built by') }} <a href="https://e4protech.com" target="_blank" class="font-medium text-blue-600 hover:text-blue-400 dark:text-blue-400 dark:hover:text-blue-300">Hoxhallari Egli</a>
        </span>
      </div>
    </div>
  </footer>
</div>

<script>
    @if(session()->has('success'))
        window.addEventListener('DOMContentLoaded', () => {
            window.dispatchEvent(new CustomEvent('toast', { detail: { message: "{{ session('success') }}", type: 'success' } }));
        });
    @endif

    @if(session()->has('error'))
        window.addEventListener('DOMContentLoaded', () => {
            window.dispatchEvent(new CustomEvent('toast', { detail: { message: "{{ session('error') }}", type: 'error' } }));
        });
    @endif
</script>

</body>
</html>
