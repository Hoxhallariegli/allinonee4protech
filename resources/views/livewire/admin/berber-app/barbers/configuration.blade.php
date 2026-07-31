<div class="space-y-10">
    <div class="flex items-center justify-between gap-4 px-1">
        <div>
            <x-h1>Konfigurimi: {{ $barber->name }}</x-h1>
            <x-short-description class="dark:text-gray-400">Menaxho oraret e punës, pushimet dhe mbylljet emergjente.</x-short-description>
        </div>
        <x-back-btn route="admin.berber-app.barbers.index" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Standard Working Hours --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xl font-black text-gray-900 dark:text-white uppercase tracking-tight">Orari Javor</h2>
                    <x-button wire:click="saveWorkingHours" variant="blue">Ruaj Oraret</x-button>
                </div>

                <div class="divide-y divide-gray-50 dark:divide-gray-700">
                    @foreach($days as $index => $name)
                        <div class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="w-32">
                                <span class="font-bold text-gray-900 dark:text-white">{{ __($name) }}</span>
                            </div>

                            <div class="flex items-center gap-4 flex-1 justify-end">
                                @if(!($workingHours[$index]['is_off'] ?? false))
                                    <div class="flex items-center gap-2">
                                        <input type="time" wire:model.defer="workingHours.{{ $index }}.start_time" class="p-2 bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-sm font-bold">
                                        <span class="text-gray-400">-</span>
                                        <input type="time" wire:model.defer="workingHours.{{ $index }}.end_time" class="p-2 bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-sm font-bold">
                                    </div>
                                @else
                                    <span class="text-xs font-black uppercase tracking-widest text-red-400 py-2">Pushim</span>
                                @endif

                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model.live="workingHours.{{ $index }}.is_off" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    <span class="ml-3 text-xs font-bold text-gray-400">OFF</span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Absence List --}}
            <div class="bg-white dark:bg-gray-800 p-8 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700">
                <h2 class="text-xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-8">Absencat & Pushimet e Planifikuara</h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="bg-gray-50 dark:bg-gray-900/50 text-[10px] font-black uppercase tracking-widest text-gray-400">
                            <tr>
                                <th class="px-4 py-3">Lloji</th>
                                <th class="px-4 py-3">Fillimi</th>
                                <th class="px-4 py-3">Mbarimi</th>
                                <th class="px-4 py-3">Arsyeja</th>
                                <th class="px-4 py-3 text-right">Veprime</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                            @forelse($barber->exceptions->sortByDesc('start_datetime') as $exc)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-colors">
                                    <td class="px-4 py-4">
                                        <span class="px-2 py-1 rounded-lg text-[10px] font-black uppercase {{ $exc->type === 'emergency' ? 'bg-red-50 text-red-500' : 'bg-amber-50 text-amber-500' }}">
                                            {{ $exc->type }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 font-bold text-gray-700 dark:text-gray-300">{{ $exc->start_datetime->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-4 font-bold text-gray-700 dark:text-gray-300">{{ $exc->end_datetime->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-4 text-xs italic">{{ $exc->reason ?? '-' }}</td>
                                    <td class="px-4 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button wire:click="editAbsence({{ $exc->id }})" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors"><x-heroicon-o-pencil class="size-4"/></button>
                                            <button onclick="confirm('A jeni i sigurt?') || event.stopImmediatePropagation()" wire:click="deleteAbsence({{ $exc->id }})" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors"><x-heroicon-o-trash class="size-4"/></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-400 italic">Asnjë absencë e regjistruar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Add/Edit Absence Form --}}
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-[2.5rem] shadow-sm border border-gray-50 dark:border-gray-700 sticky top-24">
                <h2 class="text-xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-6">
                    {{ $editingAbsenceId ? 'Edito Absencën' : 'Shto Absencë të Re' }}
                </h2>

                <form wire:submit.prevent="scheduleAbsence" class="space-y-5">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Lloji</label>
                        <select wire:model.defer="absenceType" class="w-full p-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl font-bold text-sm">
                            <option value="emergency">Emergjencë (Anullon rezervimet)</option>
                            <option value="vacation">Pushime / Jo i disponueshëm</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Fillimi</label>
                            <input type="datetime-local" wire:model.defer="absenceStart" class="w-full p-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl font-bold text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Mbarimi</label>
                            <input type="datetime-local" wire:model.defer="absenceEnd" class="w-full p-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl font-bold text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Arsyeja</label>
                        <textarea wire:model.defer="absenceReason" placeholder="Psh: Probleme shëndetësore..." class="w-full p-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl font-bold text-sm h-24"></textarea>
                    </div>

                    <div class="pt-4 flex flex-col gap-3">
                        <x-button type="submit" variant="blue" class="w-full !py-4 !rounded-2xl">
                            {{ $editingAbsenceId ? 'Përditëso' : 'Regjistro & Njofto' }}
                        </x-button>
                        @if($editingAbsenceId)
                            <button type="button" wire:click="$set('editingAbsenceId', null)" class="text-xs font-bold text-gray-400 hover:text-gray-600 uppercase tracking-widest">Anulo Editimin</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
