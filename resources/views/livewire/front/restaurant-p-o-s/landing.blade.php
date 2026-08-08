<div class="bg-[var(--paper)] dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 min-h-screen selection:bg-amber-100 selection:text-amber-900 font-body antialiased">
    {{-- Hero Section --}}
    <section class="relative h-[80vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-black/60 z-10"></div>
            <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover">
        </div>

        <div class="relative z-20 text-center px-6">
            <div class="inline-flex items-center gap-3 px-4 py-2 border border-amber-500/30 bg-amber-500/10 rounded-full text-amber-500 text-[10px] font-black uppercase tracking-[0.3em] mb-8 animate-fade-in">
                {{ __('front/restaurant-p-o-s.welcome_to') }}
            </div>
            <h1 class="font-display text-7xl md:text-9xl text-white tracking-tighter mb-8 leading-[0.8] uppercase">
                @php
                    $titleParts = explode(' ', __('front/restaurant-p-o-s.elevate_experience'), 2);
                @endphp
                {{ $titleParts[0] }}<br><span class="text-amber-500 italic">{{ $titleParts[1] ?? '' }}</span>
            </h1>
            <p class="text-white/60 text-lg md:text-xl max-w-xl mx-auto italic font-serif leading-relaxed mb-12">
                "{{ __('front/restaurant-p-o-s.hero_subtitle') }}"
            </p>
            <a href="#menu" class="inline-flex items-center gap-4 px-10 py-5 bg-amber-500 text-black rounded-full font-black text-xs uppercase tracking-widest hover:bg-amber-400 transition-all shadow-2xl shadow-amber-500/20">
                {{ __('front/restaurant-p-o-s.book_now') }}
                <x-heroicon-o-chevron-down class="size-4 animate-bounce"/>
            </a>
        </div>
    </section>

    {{-- Menu Section --}}
    <section id="menu" class="py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-24">
                <div class="max-w-2xl text-left">
                    <span class="text-amber-500 font-bold text-xs uppercase tracking-[0.3em]">{{ __('front/restaurant-p-o-s.services_subtitle') }}</span>
                    <h2 class="font-display text-6xl md:text-8xl mt-4 uppercase leading-[0.9] tracking-tighter italic">
                        @php
                            $flavParts = explode(' ', __('front/restaurant-p-o-s.our_services'), 2);
                        @endphp
                        {{ $flavParts[0] }}<br>{{ $flavParts[1] ?? '' }}.
                    </h2>
                </div>

                {{-- Category Filter --}}
                <div class="flex flex-wrap gap-3">
                    <button wire:click="$set('selectedCategoryId', null)"
                        class="px-8 py-3 rounded-full text-[10px] font-black uppercase tracking-widest border transition-all {{ is_null($selectedCategoryId) ? 'bg-amber-500 border-amber-500 text-black' : 'border-zinc-200 dark:border-zinc-800 text-zinc-500 hover:border-amber-500' }}">
                        All
                    </button>
                    @foreach($categories as $cat)
                        <button wire:click="$set('selectedCategoryId', {{ $cat->id }})"
                            class="px-8 py-3 rounded-full text-[10px] font-black uppercase tracking-widest border transition-all {{ $selectedCategoryId == $cat->id ? 'bg-amber-500 border-amber-500 text-black' : 'border-zinc-200 dark:border-zinc-800 text-zinc-500 hover:border-amber-500' }}">
                            {{ $cat->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-20 gap-y-16">
                @foreach($menuItems as $item)
                    <div class="flex flex-col sm:flex-row gap-8 group">
                        <div class="size-40 rounded-3xl overflow-hidden shadow-xl shrink-0 border border-zinc-100 dark:border-zinc-800 group-hover:scale-105 transition-transform duration-500">
                            @if($item->photo)
                                <img src="{{ asset('uploads/'.$item->photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-amber-50 dark:bg-zinc-900 flex items-center justify-center text-5xl font-black text-amber-200 dark:text-zinc-800">
                                    {{ substr($item->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 pt-2 text-left">
                            <div class="flex items-center justify-between gap-4 mb-3">
                                <h3 class="text-2xl font-black uppercase tracking-tight group-hover:text-amber-500 transition-colors">{{ $item->name }}</h3>
                                <div class="h-px flex-1 bg-dotted-line opacity-20 hidden sm:block"></div>
                                <span class="text-2xl font-black text-amber-500 italic">L{{ number_format($item->price, 0) }}</span>
                            </div>
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm leading-relaxed max-w-md italic font-serif">
                                {{ $item->description ?? 'Chef\'s special selection of the day, prepared with organic local ingredients and seasonal flavors.' }}
                            </p>
                            @if($item->category)
                                <div class="mt-4 inline-flex items-center gap-2">
                                     <span class="size-1.5 rounded-full bg-amber-500"></span>
                                     <span class="text-[9px] font-black uppercase tracking-widest text-zinc-400">{{ $item->category->name }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            @if($menuItems->isEmpty())
                <div class="py-24 text-center">
                    <div class="size-20 bg-zinc-50 dark:bg-zinc-900 rounded-full flex items-center justify-center mx-auto mb-6">
                        <x-heroicon-o-cake class="size-10 text-zinc-200"/>
                    </div>
                    <p class="text-zinc-400 font-serif italic text-xl">Our chefs are preparing something new for this category.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 px-6 bg-black text-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-16 pb-20 border-b border-white/5">
                <div class="col-span-2 text-left">
                    <h2 class="font-display text-5xl uppercase tracking-tighter mb-8 leading-none">GOURMET<br><span class="text-amber-500">STATION.</span></h2>
                    <p class="text-white/40 text-lg leading-relaxed max-w-sm font-serif italic">
                        Experience culinary excellence in the heart of Tirana. We are dedicated to providing an unforgettable dining experience through taste, service, and atmosphere.
                    </p>
                </div>
                <div class="text-left">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-amber-500 mb-10">Reservation</h4>
                    <p class="text-white font-bold text-xl mb-4 italic leading-none">10:00 - 23:00</p>
                    <p class="text-white/40 text-sm leading-relaxed">+355 6X XXX XXXX<br>info@gourmetstation.al</p>
                </div>
                <div class="text-left">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-amber-500 mb-10">Address</h4>
                    <p class="text-white/40 text-sm leading-relaxed italic">
                        Street 78, Blok District<br>Tirana, Albania 1001
                    </p>
                </div>
            </div>
            <div class="pt-10 flex flex-col md:flex-row justify-between items-center gap-6 text-[9px] font-black uppercase tracking-[0.3em] text-white/20">
                <p>© {{ date('Y') }} THE GOURMET STATION. ALL RIGHTS RESERVED.</p>
                <p class="italic">Curated for Quality</p>
            </div>
        </div>
    </footer>

    <style>
        .bg-dotted-line { background-image: radial-gradient(circle, currentColor 1px, transparent 1.5px); background-size: 8px 1px; background-repeat: repeat-x; background-position: center; }
    </style>
</div>
