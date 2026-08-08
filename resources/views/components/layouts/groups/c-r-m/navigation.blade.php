<div>
    <a href="/" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-gray-50 dark:hover:bg-gray-900/50 mb-4">
        <x-heroicon-o-arrow-left class="size-5 shrink-0" />
        <span class="truncate">{{ __('admin.Back to Main Panel') }}</span>
    </a>

    <x-nav.divider>{{ __('admin.CRM') }}</x-nav.divider>

    {{-- Dashboard --}}
    <a href="/modular/c-r-m/c-r-m/dashboard"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*/c-r-m/dashboard') ? 'bg-violet-50 text-violet-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*/c-r-m/dashboard') ? 'bg-violet-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('admin.Dashboard') }}</span>
    </a>

    {{-- Landing Page --}}
    <a href="/c-r-m"
       target="_blank"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 bg-gray-300 dark:bg-gray-700"></div>
        <span class="truncate">{{ __('admin.Landing Page') }}</span>
    </a>

    {{-- Companies --}}
    <a href="/modular/c-r-m/c-r-m/companies"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*companies*') ? 'bg-violet-50 text-violet-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*companies*') ? 'bg-violet-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('c-r-m/companies.Companies') }}</span>
    </a>

    {{-- Contacts --}}
    <a href="/modular/c-r-m/c-r-m/contacts"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*contacts*') ? 'bg-violet-50 text-violet-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*contacts*') ? 'bg-violet-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('c-r-m/contacts.Contacts') }}</span>
    </a>

    {{-- Leads --}}
    <a href="/modular/c-r-m/c-r-m/leads"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*leads*') ? 'bg-violet-50 text-violet-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*leads*') ? 'bg-violet-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('c-r-m/leads.Leads') }}</span>
    </a>

    {{-- Deals --}}
    <a href="/modular/c-r-m/c-r-m/deals"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*deals*') ? 'bg-violet-50 text-violet-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*deals*') ? 'bg-violet-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('c-r-m/deals.Deals') }}</span>
    </a>

    {{-- Tasks --}}
    <a href="/modular/c-r-m/c-r-m/tasks"
       class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold {{ request()->is('*tasks*') ? 'bg-violet-50 text-violet-600' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-200">
        <div class="ml-1.5 size-1.5 rounded-full shrink-0 {{ request()->is('*tasks*') ? 'bg-violet-600' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
        <span class="truncate">{{ __('c-r-m/tasks.Tasks') }}</span>
    </a>

</div>
