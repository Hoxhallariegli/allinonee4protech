<div class="bg-white dark:bg-slate-900 selection:bg-blue-100 selection:text-blue-900 min-h-screen" x-data="{ showBooking: @entangle('showBookingModal') }">

    {{-- Theme Toggle for Client Side --}}
    <div class="fixed top-6 right-6 z-[110]">
        <button id="theme-toggle-front" class="p-3 bg-white/80 dark:bg-slate-800/80 backdrop-blur-md rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:scale-110 transition-all">
            <x-heroicon-o-sun class="size-6 dark:hidden" />
            <x-heroicon-o-moon class="size-6 hidden dark:block" />
        </button>
    </div>

    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(circle_at_top,_var(--tw-gradient-stops))] from-blue-50/50 dark:from-blue-900/20 via-transparent to-transparent -z-10"></div>
        <div class="container mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full text-xs font-black uppercase tracking-widest mb-8">
                <span class="size-2 rounded-full bg-blue-600 animate-pulse"></span>
                {{ __('front/berber-app.welcome_to') }} Berber App
            </div>
            <h1 class="text-6xl md:text-8xl font-black text-slate-900 dark:text-white tracking-tighter mb-8 leading-[0.9]">
                Elevate your <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Style.</span>
            </h1>
            <p class="text-xl text-slate-500 dark:text-slate-400 max-w-2xl mx-auto mb-12 leading-relaxed">
                Unlock the full potential of your look with our premium barber services. Quality, precision, and passion in every cut.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#services" class="px-10 py-5 bg-slate-900 dark:bg-blue-600 text-white rounded-[2rem] font-bold text-lg hover:scale-105 transition-all duration-300 shadow-xl shadow-slate-200 dark:shadow-blue-900/20">Rezervo Tani</a>
                <button class="px-10 py-5 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border border-slate-100 dark:border-slate-700 rounded-[2rem] font-bold text-lg hover:border-slate-300 dark:hover:border-slate-500 transition-all">Galeria</button>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-6 space-y-32 pb-32">

        {{-- Services Section --}}
        <section id="services" class="pt-20">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-4 tracking-tight">Shërbimet Tona</h2>
                <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto text-lg italic">Zgjidh shërbimin që dëshiron dhe lër takimin tënd në pak sekonda.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $item)
                    <div class="group p-10 bg-white dark:bg-slate-800 rounded-[3rem] border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-2xl hover:-translate-y-2 flex flex-col justify-between">
                        <div>
                            <div class="mb-8 flex items-center justify-between">
                                <div class="p-4 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-[1.5rem] group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 shadow-sm">
                                    <x-heroicon-o-scissors class="size-8"/>
                                </div>
                                <div class="text-xs font-black uppercase tracking-widest text-slate-400">{{ $item->duration_minutes }} Minuta</div>
                            </div>
                            <h3 class="text-3xl font-black text-slate-900 dark:text-white mb-4 tracking-tight">{{ $item->name }}</h3>
                            <p class="text-slate-500 dark:text-slate-400 leading-relaxed mb-10 text-lg">Përjetoni një eksperiencë unike të kujdesit ndaj vetes me mjeshtrat tanë.</p>
                        </div>
                        <button wire:click="selectService({{ $item->id }})" class="w-full py-5 text-lg font-black text-slate-900 dark:text-white group-hover:text-white group-hover:bg-blue-600 bg-slate-50 dark:bg-slate-900 rounded-[2rem] border border-slate-100 dark:border-slate-700 group-hover:border-blue-600">Zgjidh Shërbimin</button>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Team Section --}}
        <section id="team">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-4 tracking-tight">Mjeshtrat Tanë</h2>
                <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto text-lg">Ekipi ynë i profesionistëve është këtu për t'ju ofruar stilin që meritoni.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-5xl mx-auto">
                @foreach($barbers as $item)
                    <div class="flex flex-col items-center group">
                        <div class="size-56 rounded-[4rem] overflow-hidden mb-8 shadow-xl group-hover:scale-105 border-4 border-white dark:border-slate-800 ring-1 ring-slate-100 dark:ring-slate-700">
                            @if($item->photo)
                                <img src="{{ asset('storage/'.$item->photo) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                            @else
                                <div class="w-full h-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-5xl font-black text-slate-300 dark:text-slate-600 uppercase tracking-tighter">{{ substr($item->name, 0, 1) }}</div>
                            @endif
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-2 tracking-tight">{{ $item->name }}</h3>
                        <p class="text-blue-600 dark:text-blue-400 font-bold text-sm uppercase tracking-[0.2em]">{{ $item->specialization }}</p>
                    </div>
                @endforeach
            </div>
        </section>

    </div>

    <div x-show="showBooking"
         x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6">

        <div class="absolute inset-0 bg-slate-900/60 dark:bg-slate-950/80 backdrop-blur-md" @click="showBooking = false"></div>

        <div class="relative bg-white dark:bg-slate-800 w-full max-w-2xl rounded-[3rem] shadow-2xl overflow-hidden">

            <div class="p-8 sm:p-12">
                {{-- Header --}}
                <div class="flex items-center justify-between mb-10">
                    <div>
                        <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Rezervo Takimin</h2>
                        @if($step < 4)
                            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Hapi {{ $step }} nga 3</p>
                        @endif
                    </div>
                    <button @click="showBooking = false" class="p-3 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-2xl transition-colors">
                        <x-heroicon-o-x-mark class="size-6 text-slate-400 dark:text-slate-500"/>
                    </button>
                </div>

                {{-- Step 2: Date & Time --}}
                @if($step == 2)
                    <div class="space-y-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-4 ml-1">Zgjidh Datën</label>
                                <input type="date" wire:model.live="selectedDate" min="{{ date('Y-m-d') }}" class="w-full p-5 bg-slate-50 dark:bg-slate-900 border-none rounded-3xl focus:ring-4 focus:ring-blue-500/10 font-bold text-slate-900 dark:text-white">
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-4 ml-1">Zgjidh Berberin (Opsionale)</label>
                                <select wire:model.live="selectedBarberId" class="w-full p-5 bg-slate-50 dark:bg-slate-900 border-none rounded-3xl focus:ring-4 focus:ring-blue-500/10 font-bold text-slate-900 dark:text-white appearance-none">
                                    <option value="">Cilido Berber</option>
                                    @foreach($barbers as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-4 ml-1">Orarët e Lirë</label>
                            <div class="grid grid-cols-3 sm:grid-cols-4 gap-3 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                                @forelse($this->availableSlots as $time)
                                    <button wire:click="confirmTime('{{ $time }}')" class="p-4 bg-slate-50 dark:bg-slate-900 hover:bg-blue-600 hover:text-white rounded-2xl font-black text-slate-900 dark:text-white border border-transparent hover:scale-105 active:scale-95 shadow-sm">
                                        {{ $time }}
                                    </button>
                                @empty
                                    <div class="col-span-full py-10 text-center bg-slate-50 dark:bg-slate-900/50 rounded-3xl text-slate-400 dark:text-slate-500 font-bold italic border border-dashed border-slate-200 dark:border-slate-700">Nuk u gjet asnjë orar i lirë për këtë datë.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Step 3: Info --}}
                @if($step == 3 && $selectedService)
                    <div class="space-y-8">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-3xl border border-blue-100 dark:border-blue-800 flex items-center gap-6">
                            <div class="size-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center shrink-0 shadow-lg">
                                <x-heroicon-o-calendar class="size-8"/>
                            </div>
                            <div>
                                <p class="text-blue-600 dark:text-blue-400 font-black uppercase text-[10px] tracking-widest mb-0.5">Përmbledhja e rezervimit</p>
                                <h4 class="text-slate-900 dark:text-white font-bold text-lg leading-tight">{{ $selectedService->name }}</h4>
                                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">{{ Carbon\Carbon::parse($selectedDate)->format('d M Y') }} në orën {{ $selectedTime }} me {{ $selectedBarber->name ?? 'Mjeshtrin e parë të lirë' }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-2 ml-1">Emri dhe Mbiemri</label>
                                <input type="text" wire:model="customerName" placeholder="Emri juaj" class="w-full p-5 bg-slate-50 dark:bg-slate-900 border-none rounded-3xl focus:ring-4 focus:ring-blue-500/10 font-bold text-slate-900 dark:text-white placeholder:text-slate-300 dark:placeholder:text-slate-700">
                                @error('customerName') <span class="text-red-500 text-xs font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-slate-400 dark:text-slate-500 mb-2 ml-1">Numri i Telefonit</label>
                                <input type="tel" wire:model="customerPhone" placeholder="069 XX XX XXX" class="w-full p-5 bg-slate-50 dark:bg-slate-900 border-none rounded-3xl focus:ring-4 focus:ring-blue-500/10 font-bold text-slate-900 dark:text-white placeholder:text-slate-300 dark:placeholder:text-slate-700">
                                @error('customerPhone') <span class="text-red-500 text-xs font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex items-center p-2">
                            <input type="checkbox" id="notify" wire:model="allowNotifications"
                                x-on:change="if($el.checked) window.requestNotificationPermission()"
                                class="size-6 rounded-lg text-blue-600 focus:ring-blue-500 border-slate-200 dark:bg-slate-900 dark:border-slate-700">
                            <label for="notify" class="ml-4 text-slate-600 dark:text-slate-400 font-bold cursor-pointer select-none">Dua të marr njoftime për takimin tim</label>
                        </div>

                        <div class="pt-4 flex gap-4">
                            <button wire:click="$set('step', 2)" class="px-8 py-5 text-slate-400 dark:text-slate-500 font-bold hover:text-slate-900 dark:hover:text-white transition-colors">Mbrapa</button>
                            <button wire:click="submitBooking" class="flex-1 px-10 py-5 bg-blue-600 text-white rounded-3xl font-black text-lg hover:bg-blue-700 shadow-xl shadow-blue-200 dark:shadow-none transition-all active:scale-95">Konfirmo Rezervimin</button>
                        </div>
                    </div>
                @endif

                {{-- Step 4: Success --}}
                @if($step == 4)
                    <div class="text-center py-10 space-y-8">
                        <div class="size-32 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 dark:text-emerald-400 rounded-[3rem] flex items-center justify-center mx-auto shadow-sm">
                            <x-heroicon-o-check-circle class="size-20"/>
                        </div>
                        <div>
                            <h2 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight mb-3">Rezervimi u krye!</h2>
                            <p class="text-slate-500 dark:text-slate-400 text-lg leading-relaxed px-4">Faleminderit <strong>{{ $customerName }}</strong>. Takimi juaj u konfirmua me sukses. Ju presim!</p>
                        </div>
                        <button wire:click="resetBooking" class="px-12 py-5 bg-slate-900 dark:bg-blue-600 text-white rounded-[2rem] font-bold text-lg hover:scale-105 transition-all">Mbyll</button>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <footer class="py-20 bg-white dark:bg-slate-950 border-t border-slate-100 dark:border-slate-800">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-2">
                <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-6 tracking-tight">Berber App</h2>
                <p class="text-slate-500 dark:text-slate-400 max-w-sm leading-relaxed font-medium">Përjetoni kujdesin më të lartë për pamjen tuaj me teknologjinë më të fundit të rezervimeve online.</p>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase tracking-widest text-xs text-slate-400 dark:text-slate-600">Linqe</h4>
                <ul class="space-y-4 text-slate-500 dark:text-slate-400 font-bold">
                    <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Rreth Nesh</a></li>
                    <li><a href="#services" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Shërbimet</a></li>
                    <li><a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Kontakt</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase tracking-widest text-xs text-slate-400 dark:text-slate-600">Kontakt</h4>
                <ul class="space-y-4 text-slate-500 dark:text-slate-400 font-bold text-sm">
                    <li class="flex items-center gap-3"><x-heroicon-o-map-pin class="size-5 text-blue-500"/> Tiranë, Shqipëri</li>
                    <li class="flex items-center gap-3"><x-heroicon-o-phone class="size-5 text-blue-500"/> +355 6X XXX XXXX</li>
                </ul>
            </div>
        </div>
    </footer>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 20px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; }
    </style>

    <script>
        document.getElementById('theme-toggle-front').addEventListener('click', function() {
            let isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    </script>
</div>
