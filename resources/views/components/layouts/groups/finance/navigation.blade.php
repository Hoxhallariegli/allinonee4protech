<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.Finance') }}</x-nav.divider>

    @php
        $activeClass = 'bg-emerald-50 text-emerald-600 dark:bg-emerald-900/50 dark:text-emerald-400';
        $inactiveClass = 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white';
        $dotActiveClass = 'bg-emerald-500';
        $dotInactiveClass = 'bg-gray-300 dark:bg-gray-700';
    @endphp

    <a href="{{ route('admin.finance.dashboard') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*dashboard*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*dashboard*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    <a href="/finance"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    <a href="{{ route('admin.finance.accounts.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*accounts*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*accounts*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('finance/accounts.Accounts') }}</span>
    </a>

    <a href="{{ route('admin.finance.budgets.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*budgets*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*budgets*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('finance/budgets.Budgets') }}</span>
    </a>

    <a href="{{ route('admin.finance.categories.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*categories*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*categories*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('finance/categories.Categories') }}</span>
    </a>

    <a href="{{ route('admin.finance.documents.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*documents*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*documents*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('finance/documents.Documents') }}</span>
    </a>

    <a href="{{ route('admin.finance.expenses.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*expenses*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*expenses*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('finance/expenses.Expenses') }}</span>
    </a>

    <a href="{{ route('admin.finance.transactions.index') }}"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*transactions*') ? $activeClass : $inactiveClass }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*transactions*') ? $dotActiveClass : $dotInactiveClass }}"></div>
        <span class="truncate">{{ __('finance/transactions.Transactions') }}</span>
    </a>

</div>
