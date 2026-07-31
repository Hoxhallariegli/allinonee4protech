<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
            console.warn('Firebase is not configured or enabled. Notification request ignored.');
        };
    </script>

    @if(config('firebase_enabled') && config('firebase_web_config'))
        <script src="https://www.gstatic.com/firebasejs/9.1.1/firebase-app-compat.js"></script>
        <script src="https://www.gstatic.com/firebasejs/9.1.1/firebase-messaging-compat.js"></script>
        <script>
            (function() {
                const rawConfig = `{!! config('firebase_web_config') !!}`;
                try {
                    const jsonConfig = JSON.parse(rawConfig.trim().replace(/([{,]\s*)([a-zA-Z0-9_]+)\s*:/g, '$1"$2":').replace(/'/g, '"').replace(/,\s*}/g, '}'));
                    firebase.initializeApp(jsonConfig);
                    const messaging = firebase.messaging();

                    window.requestNotificationPermission = function() {
                        if (!('Notification' in window)) {
                            console.error('This browser does not support desktop notification');
                            return;
                        }

                        Notification.requestPermission().then((permission) => {
                            if (permission === 'granted') {
                                navigator.serviceWorker.ready.then((registration) => {
                                    messaging.getToken({ serviceWorkerRegistration: registration }).then((token) => {
                                        if (window.Livewire) {
                                            window.Livewire.dispatch('fcm-token-received', { token: token });
                                        }
                                    }).catch((err) => {
                                        console.error('Token error:', err);
                                    });
                                });
                            }
                        });
                    };

                    if ('serviceWorker' in navigator) {
                        navigator.serviceWorker.register('/firebase-messaging-sw.js').then((registration) => {
                            messaging.getToken({ serviceWorkerRegistration: registration }).then((token) => {
                                if (window.Livewire) {
                                    window.Livewire.dispatch('fcm-token-received', { token: token });
                                }
                            });
                        });
                    }
                } catch (e) { console.error('Firebase Error:', e.message); }
            })();
        </script>
    @endif
</head>
<body class="bg-white dark:bg-slate-900">

<div class="relative" x-data="{ open: false }">

    <div class="relative pt-6">

        <div class="max-w-screen-xl mx-auto px-4 py-4 sm:px-6">
            <nav class="relative flex items-center justify-between sm:h-10 md:justify-center">
                <div class="md:absolute md:flex md:items-center md:justify-end md:inset-y-0 md:right-0">
                    @auth
                        <ul class="nav navbar-nav navbar-right">
                            <span class="inline-flex rounded-md shadow">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-blue-600 bg-white dark:bg-slate-800 dark:text-blue-400 hover:text-blue-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-blue-700 transition duration-150 ease-in-out">
                                    {{ __('Dashboard') }}
                                </a>
                            </span>

                            <span class="ml-2 inline-flex rounded-md shadow">
                                <a href="{{ url('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-blue-600 bg-white dark:bg-slate-800 dark:text-blue-400 hover:text-blue-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-blue-700 transition duration-150 ease-in-out">
                                    {{ __('logout') }}
                                </a>

                                <form id="logout-form" action="{{ url('logout') }}" method="post">
                                    {{ csrf_field() }}
                                </form>
                            </span>
                        </ul>

                    @else

                        <ul class="nav navbar-nav navbar-right flex gap-2">
                            <span class="inline-flex rounded-md shadow">
                                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-blue-600 bg-white dark:bg-slate-800 dark:text-blue-400 hover:text-blue-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-blue-700 transition duration-150 ease-in-out">
                                    {{ __('Login') }}
                                </a>
                            </span>

                                <span class="inline-flex rounded-md shadow">
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md bg-blue-600 dark:bg-blue-500 dark:hover:bg-blue-600 text-white hover:bg-blue-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-blue-700 transition duration-150 ease-in-out">
                                    {{ __('Register') }}
                                </a>
                            </span>
                        </ul>

                    @endauth
                </div>
            </nav>
        </div>

    </div>

</div>

{{ $slot }}

</body>
</html>
