<tr class="hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-none border-b border-gray-50 dark:border-gray-700/50 last:border-none">
    <td class="px-6 py-5 font-bold text-blue-600 dark:text-blue-400">{{ $item->id }}</td>
    <td class="px-6 py-5 text-gray-900 dark:text-white font-bold">{{ $item->name }}</td>
    <td class="px-6 py-5">
        @if($item->photo)
            <img src="{{ asset('storage/'.$item->photo) }}" class="size-10 rounded-xl object-cover border border-gray-100 dark:border-gray-700">
        @else
            <div class="size-10 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-xs font-black text-gray-400 uppercase tracking-tighter">{{ substr($item->name, 0, 1) }}</div>
        @endif
    </td>
    <td class="px-6 py-5 text-gray-600 dark:text-gray-300 text-xs font-bold">{{ $item->specialization }}</td>
    <td class="px-6 py-5">
        <x-badge :variant="$item->active ? 'green' : 'red'">{{ $item->active ? __('Aktiv') : __('Joaktiv') }}</x-badge>
    </td>
    <td class="px-6 py-5">
        <div class="space-y-1">
            @php
                $activeExceptions = $item->exceptions->where('end_datetime', '>', now());
            @endphp
            @forelse($activeExceptions->take(2) as $exception)
                <div class="flex flex-col text-[9px] leading-tight">
                    <span class="font-black {{ $exception->type === 'emergency' ? 'text-red-500' : 'text-amber-500' }} uppercase">
                        {{ $exception->type }}
                    </span>
                    <span class="text-gray-400">
                        {{ $exception->start_datetime->format('d/m H:i') }}
                    </span>
                </div>
            @empty
                <span class="text-gray-300 text-[10px] italic">Nuk ka</span>
            @endforelse
            @if($activeExceptions->count() > 2)
                <span class="text-[9px] font-bold text-blue-500">+{{ $activeExceptions->count() - 2 }} tjerë</span>
            @endif
        </div>
    </td>
    <td class="px-6 py-5 text-right !transition-none">
        <div class="flex justify-end gap-3 !transition-none">
            <x-a href="{{ route('admin.berber-app.barbers.configuration', $item) }}" class="!rounded-xl !bg-slate-50 dark:!bg-slate-900/30 !text-slate-600 dark:!text-slate-400 !px-4 !py-1.5 !text-[10px] !font-black !uppercase !border-none hover:scale-105 transition-transform shadow-sm">Konfiguro</x-a>

            @can('edit_barbers')
                <x-a href="{{ route('admin.berber-app.barbers.edit', $item) }}" class="!rounded-xl !bg-blue-50 dark:!bg-blue-900/30 !text-blue-600 dark:!text-blue-400 !px-4 !py-1.5 !text-[10px] !font-black !uppercase !border-none">Edit</x-a>
            @endcan

            @can('delete_barbers')
                <div x-data="{ confirmation: '' }" x-cloak class="inline-block">
                    <x-modal>
                        <x-slot name="trigger"><button @click="on = true" class="text-[10px] font-black uppercase text-red-400 hover:text-red-600 dark:hover:text-red-300">Delete</button></x-slot>
                        <x-slot name="modalTitle"><div class="text-left dark:text-white">Fshi {{ $item->name }}?</div></x-slot>
                        <x-slot name="content"><div class="text-left space-y-2"><p class="text-sm text-gray-500 dark:text-gray-400">Ky veprim nuk mund të kthehet mbrapa.</p><input x-model="confirmation" placeholder="Shkruaj {{ $item->name }} për konfirmim" class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-red-500 outline-none font-bold text-sm"></div></x-slot>
                        <x-slot name="footer"><x-button variant="gray" @click="on = false">Anulo</x-button><x-button variant="red" x-bind:disabled="confirmation !== '{{ $item->name }}'" wire:click="$parent.deleteBarber('{{ $item->id }}')" @click="on = false">Fshi</x-button></x-slot>
                    </x-modal>
                </div>
            @endcan
        </div>
    </td>
</tr>
