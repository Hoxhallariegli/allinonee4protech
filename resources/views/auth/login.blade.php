@section('title', __('Login'))

<x-layouts.guest>
    <x-auth-card>

        <x-form action="{{ route('login') }}">

            @include('errors.messages')

            <div class="mb-6 p-4 rounded-2xl bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-100 dark:border-indigo-800">
                <p class="text-xs font-black uppercase tracking-widest text-indigo-600 dark:text-indigo-400 mb-2">Demo Credentials</p>
                <div class="space-y-1">
                    <p class="text-sm font-bold text-slate-700 dark:text-slate-300">Email: <span class="text-indigo-600 dark:text-indigo-400">demo@e4protech.com</span></p>
                    <p class="text-sm font-bold text-slate-700 dark:text-slate-300">Password: <span class="text-indigo-600 dark:text-indigo-400">password</span></p>
                </div>
            </div>

            <x-form.input name="email" :label="__('Email')">{{ old('email') }}</x-form.input>
            <x-form.input name="password" :label="__('Password')" type="password" />

            <div class="flex justify-between">
                <p><a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a></p>
                @if (Route::has('register'))
                    <p><a href="{{ route('register') }}">{{ __('Register') }}</a></p>
                @endif
            </div>

            <p><x-button class="w-full justify-center">Login</x-button></p>

        </x-form>

    </x-auth-card>
</x-layouts.guest>
