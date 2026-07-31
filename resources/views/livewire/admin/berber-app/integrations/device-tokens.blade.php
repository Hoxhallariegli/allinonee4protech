<div class="space-y-10">
    <div>
        <x-h1>Device Tokens</x-h1>
        <x-short-description>Identifiko pajisjet e abonura për njoftime (Staff & Klientë).</x-short-description>
    </div>

    <div class="card !p-0 overflow-hidden shadow-none border-gray-200 dark:border-gray-700 dark:bg-gray-800">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Kërko sipas emrit ose token..." class="w-full max-w-md p-3 text-sm font-bold bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-blue-500/20 dark:text-white">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-100/50 dark:bg-gray-700/50 text-[10px] font-black uppercase tracking-widest text-gray-400">
                    <tr>
                        <th class="px-6 py-4 text-left">Subjekti</th>
                        <th class="px-6 py-4 text-left">Lloji</th>
                        <th class="px-6 py-4 text-left">Token (FCM)</th>
                        <th class="px-6 py-4 text-left">Regjistruar</th>
                        <th class="px-6 py-4 text-right">Veprime</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-700/50">
                    @forelse($tokens as $token)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-none border-b border-gray-50 dark:border-gray-700/50 last:border-none">
                            <td class="px-6 py-5">
                                @if($token->user)
                                    <div class="flex items-center gap-3">
                                        <div class="size-8 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-[10px] font-black text-blue-600">STAFF</div>
                                        <span class="font-bold text-gray-900 dark:text-white">{{ $token->user->name }}</span>
                                    </div>
                                @elseif($token->booking)
                                    <div class="flex items-center gap-3">
                                        <div class="size-8 rounded-full bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-[10px] font-black text-emerald-600">USER</div>
                                        <span class="font-bold text-gray-900 dark:text-white">{{ $token->booking->customer_name }}</span>
                                    </div>
                                @else
                                    <span class="text-gray-300 italic">Pa identifikuar</span>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <x-badge :variant="'gray'">{{ strtoupper($token->device_type) }}</x-badge>
                            </td>
                            <td class="px-6 py-5">
                                <div class="group relative flex items-center gap-2 max-w-[200px]">
                                    <span class="truncate font-mono text-[10px] text-gray-400">{{ $token->fcm_token }}</span>
                                    <button onclick="navigator.clipboard.writeText('{{ $token->fcm_token }}'); window.dispatchEvent(new CustomEvent('toast', {detail: {message: 'Token u kopjua!', type: 'success'}}))" class="opacity-0 group-hover:opacity-100 transition-opacity p-1 hover:bg-gray-100 rounded">
                                        <x-heroicon-o-clipboard class="size-3"/>
                                    </button>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-xs text-gray-400">
                                {{ $token->created_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-5 text-right">
                                <button onclick="confirm('A jeni i sigurt?') || event.stopImmediatePropagation()" wire:click="deleteToken({{ $token->id }})" class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                                    <x-heroicon-o-trash class="size-4"/>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">Asnjë pajisje nuk është regjistruar ende.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-50 dark:border-gray-700/50">
            {{ $tokens->links() }}
        </div>
    </div>
</div>
