<div>
    <h1>{{ __('admin.Notification Settings') }}</h1>
    <p>{{ __('admin.Configure which modules trigger Firebase Push Notifications') }}</p>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>{{ __('admin.Modules') }}</th>
                    <th>{{ __('admin.Description') }}</th>
                    <th class="text-right">{{ __('admin.Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modules as $module)
                    <tr wire:key="notify-{{ $module }}">
                        <td class="font-bold text-gray-900 dark:text-white uppercase">{{ $module }}</td>
                        <td class="text-sm text-gray-500 italic">{{ __('admin.Send push notification on create/update') }}</td>
                        <td class="text-right">
                            <button wire:click="toggleNotification('{{ $module }}')"
                                    class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $activeNotifications[$module] ? 'bg-primary' : 'bg-gray-200 dark:bg-gray-700' }}">
                                <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $activeNotifications[$module] ? 'translate-x-5' : 'translate-x-0' }}"></span>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
