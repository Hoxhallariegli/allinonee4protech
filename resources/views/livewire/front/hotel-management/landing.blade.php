<div class="bg-zinc-50 min-h-screen selection:bg-stone-200 selection:text-stone-900">
    {{-- Hero Section --}}
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-stone-900/40 z-10"></div>
            <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover">
        </div>

        <div class="relative z-20 text-center text-white px-6">
            <div class="inline-flex items-center gap-4 mb-10">
                <div class="h-px w-12 bg-white/40"></div>
                <span class="text-[10px] font-black uppercase tracking-[0.5em] opacity-80">{{ __('front/hotel-management.welcome_to') }}</span>
                <div class="h-px w-12 bg-white/40"></div>
            </div>
            <h1 class="font-serif italic text-7xl md:text-9xl tracking-tighter mb-12 leading-none">
                @php
                    $titleParts = explode(' ', __('front/hotel-management.elevate_experience'), 3);
                @endphp
                {{ $titleParts[0] }} {{ $titleParts[1] ?? '' }}<br><span class="text-stone-300">{{ $titleParts[2] ?? '' }}</span>
            </h1>
            <p class="text-white/70 text-lg md:text-xl max-w-xl mx-auto font-medium leading-relaxed mb-16">
                {{ __('front/hotel-management.hero_subtitle') }}
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-8">
                <a href="#rooms" class="px-12 py-5 bg-stone-100 text-stone-900 rounded-full font-black text-xs uppercase tracking-widest hover:bg-stone-200 transition-all shadow-2xl">
                    {{ __('front/hotel-management.book_now') }}
                </a>
            </div>
        </div>

        {{-- Floating Check-in Info --}}
        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 z-30 hidden lg:flex bg-white/10 backdrop-blur-xl border border-white/10 rounded-full p-2 pr-10 items-center gap-10">
            <div class="flex items-center gap-4 pl-6">
                <x-heroicon-o-calendar class="size-5 text-white/60"/>
                <div class="text-left">
                    <p class="text-[9px] font-black uppercase tracking-widest text-white/40">Check In</p>
                    <p class="text-sm font-bold text-white">Select Date</p>
                </div>
            </div>
            <div class="h-8 w-px bg-white/10"></div>
            <div class="flex items-center gap-4">
                <x-heroicon-o-users class="size-5 text-white/60"/>
                <div class="text-left">
                    <p class="text-[9px] font-black uppercase tracking-widest text-white/40">Guests</p>
                    <p class="text-sm font-bold text-white">2 Adults</p>
                </div>
            </div>
            <button class="px-8 py-4 bg-stone-100 text-stone-900 rounded-full font-black text-xs uppercase tracking-widest ml-4">Check Availability</button>
        </div>
    </section>

    {{-- Room Types Section --}}
    <section id="rooms" class="py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-32">
                <span class="text-stone-400 font-bold text-xs uppercase tracking-[0.4em]">{{ __('front/hotel-management.services_subtitle') }}</span>
                <h2 class="font-serif italic text-6xl text-stone-900 mt-6 leading-none">{{ __('front/hotel-management.our_services') }}.</h2>
                <div class="h-12 w-px bg-stone-200 mx-auto mt-12"></div>
            </div>

            <div class="space-y-32">
                @foreach($roomTypes as $type)
                    <div class="grid lg:grid-cols-2 gap-20 items-center group">
                        <div class="relative overflow-hidden rounded-[3rem] {{ $loop->even ? 'lg:order-last' : '' }}">
                            <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" class="w-full aspect-[4/3] object-cover group-hover:scale-105 transition-transform duration-1000">
                            <div class="absolute inset-0 border-[20px] border-white/10 group-hover:border-white/20 transition-all"></div>
                        </div>

                        <div class="text-left">
                            <span class="text-stone-400 font-black text-[10px] uppercase tracking-[0.3em]">Experience</span>
                            <h3 class="font-serif italic text-5xl text-stone-900 mt-6 mb-8">{{ $type->name }}</h3>
                            <p class="text-stone-500 text-lg leading-relaxed mb-10 font-medium italic">
                                Masterfully designed with premium textiles, antique furniture, and modern smart-home technology. Every detail is curated for your peace.
                            </p>

                            <div class="flex items-center gap-12 mb-12">
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-stone-300 mb-2">Starting from</p>
                                    <p class="text-3xl font-black text-stone-900">€{{ number_format($type->base_price ?? 120, 0) }}<span class="text-sm font-medium text-stone-400">/night</span></p>
                                </div>
                                <div class="flex gap-4">
                                    <div class="size-10 rounded-full border border-stone-100 flex items-center justify-center text-stone-400"><x-heroicon-o-wifi class="size-4"/></div>
                                    <div class="size-10 rounded-full border border-stone-100 flex items-center justify-center text-stone-400"><x-heroicon-o-tv class="size-4"/></div>
                                </div>
                            </div>

                            <button class="px-10 py-4 border-2 border-stone-900 text-stone-900 rounded-full font-black text-xs uppercase tracking-widest hover:bg-stone-900 hover:text-white transition-all">
                                Discover More
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-32 bg-stone-900 text-white text-center">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="font-serif italic text-5xl mb-16 opacity-90">Experience the timeless charm of The Grand Station.</h2>
            <div class="flex flex-wrap justify-center gap-12 text-[10px] font-black uppercase tracking-[0.3em] text-stone-500 mb-20">
                <a href="#" class="hover:text-stone-300">Rooms</a>
                <a href="#" class="hover:text-stone-300">Dining</a>
                <a href="#" class="hover:text-stone-300">Wellness</a>
                <a href="#" class="hover:text-stone-300">Contact</a>
            </div>
            <div class="pt-10 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6 text-[9px] font-black uppercase tracking-widest text-stone-600">
                <p>© {{ date('Y') }} THE GRAND STATION HOTEL TIRANA.</p>
                <p>An Iconic Landmark</p>
            </div>
        </div>
    </footer>
</div>
