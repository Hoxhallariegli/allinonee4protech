<div>
    <h1>{{ __('audit.Audit Trails') }}</h1>

    <div class="card">

        <div class="mt-5 grid sm:grid-cols-1 md:grid-cols-3 gap-4">

            <div class="col-span-2">
                <x-form.input type="search" id="title" name="title" wire:model.live="title" label="none" :placeholder="__('audit.Search Actions')" />
            </div>
        </div>

        <div class="mb-5" x-data="{ isOpen: @if($openFilter || request('openFilter')) true @else false @endif }">

            <button type="button" @click="isOpen = !isOpen" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded-t text-grey-700 bg-gray-200 hover:bg-grey-300 dark:bg-gray-700 dark:text-gray-200 transition ease-in-out duration-150">
                <svg class="h-5 w-5 text-gray-500 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                {{ __('audit.Advanced Search') }}
            </button>

            <button type="button" wire:click="resetFilters" @click="isOpen = false" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-grey-700 bg-gray-200 hover:bg-grey-300 dark:bg-gray-700 dark:text-gray-200 transition ease-in-out duration-150">
                <svg class="h-5 w-5 text-gray-500 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                {{ __('audit.Reset form') }}
            </button>

            <div
                    x-show="isOpen"
                    x-transition:enter="transition ease-out duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75 transform"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="bg-gray-200 dark:bg-gray-700 rounded-b-md p-5"
                    wire:ignore.self>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                    <x-form.select id="user_id" name="user_id" :label="__('audit.User')" wire:model.live="user_id">
                        <option value="">Select</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </x-form.select>

                    <x-form.select id="section" name="section" :label="__('audit.Section')" wire:model.live="section">
                        <option value="">Select</option>
                        @foreach($sections as $section)
                            <option value="{{ $section }}">{{ $section }}</option>
                        @endforeach
                    </x-form.select>

                    <x-form.select id="type" name="type" :label="__('audit.Type')" wire:model.live="type">
                        <option value="">Select</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </x-form.select>

                    <x-form.daterange id="created_at" name="created_at" :label="__('audit.Created Date Range')" wire:model.blur="created_at" />
                </div>
            </div>

        </div>

        <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 dark:bg-gray-700/50">
            <tr>
                <th class="px-4 py-3"><a href="#" wire:click.prevent="sortBy('user_id')" class="flex items-center gap-1">{{ __('audit.User') }}</a></th>
                <th class="px-4 py-3"><a href="#" wire:click.prevent="sortBy('title')" class="flex items-center gap-1">{{ __('audit.Action') }}</a></th>
                <th class="px-4 py-3">{{ __('audit.Ref ID') }}</th>
                <th class="px-4 py-3"><a href="#" wire:click.prevent="sortBy('section')" class="flex items-center gap-1">{{ __('audit.Section') }}</a></th>
                <th class="px-4 py-3"><a href="#" wire:click.prevent="sortBy('type')" class="flex items-center gap-1">{{ __('audit.Type') }}</a></th>
                <th class="px-4 py-3">{{ __('audit.Changes') }}</th>
                <th class="px-4 py-3"><a href="#" wire:click.prevent="sortBy('created_at')" class="flex items-center gap-1">{{ __('audit.Date') }}</a></th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach($this->userlogs() as $log)
                <tr wire:key="{{ $log->id }}" class="hover:bg-gray-50/50 dark:hover:bg-gray-900/50">
                    <td class="px-4 py-3 font-bold text-gray-900 dark:text-white">{{ $log->user->name ?? 'System' }}</td>
                    <td class="px-4 py-3 text-blue-600 dark:text-blue-400 font-semibold">{{ $log->title }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-lg bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 text-[10px] font-mono font-bold text-gray-500">#{{ $log->reference_id }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-lg bg-gray-100 dark:bg-gray-800 text-[10px] font-bold uppercase tracking-wider text-gray-600 dark:text-gray-400 border border-transparent">{{ $log->section }}</span>
                    </td>
                    <td class="px-4 py-3">
                        @php
                            $color = match($log->type) {
                                'create' => 'text-green-600 bg-green-50 border-green-100 dark:bg-green-900/20 dark:border-green-800/30',
                                'update' => 'text-blue-600 bg-blue-50 border-blue-100 dark:bg-blue-900/20 dark:border-blue-800/30',
                                'delete' => 'text-red-600 bg-red-50 border-red-100 dark:bg-red-900/20 dark:border-red-800/30',
                                default => 'text-gray-600 bg-gray-50 border-gray-100'
                            };
                        @endphp
                        <span class="px-2 py-1 rounded-lg border {{ $color }} text-[10px] font-black uppercase tracking-widest">{{ $log->type }}</span>
                    </td>
                    <td class="px-4 py-3 min-w-[250px]">
                        @php
                            $old = is_array($log->old_values) ? $log->old_values : (json_decode($log->old_values, true) ?? []);
                            $new = is_array($log->new_values) ? $log->new_values : (json_decode($log->new_values, true) ?? []);
                            $allKeys = array_unique(array_merge(array_keys($old), array_keys($new)));
                            $keys = array_filter($allKeys, fn($k) => !in_array($k, ['id', 'created_at', 'updated_at', 'deleted_at', 'password', 'remember_token']));
                        @endphp

                        @if(empty($keys))
                            <span class="text-[10px] text-gray-400 italic">{{ __('audit.No specific changes') }}</span>
                        @else
                            <div class="space-y-1">
                                @foreach($keys as $key)
                                    @php
                                        $oldVal = $old[$key] ?? '—';
                                        $newVal = $new[$key] ?? '—';
                                    @endphp
                                    @if((string)$oldVal !== (string)$newVal)
                                        <div class="text-[10px] leading-tight">
                                            <span class="font-black uppercase text-gray-400">{{ str_replace('_', ' ', $key) }}:</span>
                                            <span class="text-red-400 line-through">@if(is_array($oldVal)) {..} @else {{ $oldVal }} @endif</span>
                                            <span class="text-gray-400 mx-1">→</span>
                                            <span class="text-gray-900 dark:text-white font-bold">@if(is_array($newVal)) {..} @else {{ $newVal }} @endif</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        @if($log->link)
                            <a href="{{ url($log->link) }}" title="Go to record" class="inline-block mt-2 p-1 bg-gray-50 dark:bg-gray-900 text-gray-400 hover:text-blue-600 rounded-lg border border-gray-100 dark:border-gray-800 transition-colors">
                                <x-heroicon-o-arrow-top-right-on-square class="w-3.5 h-3.5" />
                            </a>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-500 whitespace-nowrap">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>

        <div class="p-4 border-t border-gray-50 dark:border-gray-700">
            {{ $this->userlogs()->links() }}
        </div>
    </div>
</div>
