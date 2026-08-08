<div class="bg-white min-h-screen selection:bg-emerald-100 selection:text-emerald-900 font-body antialiased">
    {{-- Hero Section --}}
    <section class="relative h-[90vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0 bg-emerald-900">
            <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover opacity-60">
        </div>

        <div class="relative z-20 text-center px-6">
            <div class="inline-block px-6 py-2 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-[0.5em] mb-12 rounded-full shadow-2xl shadow-emerald-500/20">
                {{ __('front/travel-agency.welcome_to') }}
            </div>
            <h1 class="text-7xl md:text-[10rem] font-black text-white tracking-tighter mb-12 leading-[0.8] uppercase italic">
                @php
                    $titleParts = explode(' ', __('front/travel-agency.elevate_experience'), 2);
                @endphp
                {{ $titleParts[0] }}<br><span class="underline decoration-wavy decoration-emerald-400 underline-offset-8">{{ $titleParts[1] ?? '' }}</span>
            </h1>
            <p class="text-white text-lg md:text-2xl max-w-2xl mx-auto font-bold leading-relaxed mb-20 drop-shadow-xl italic">
                {{ __('front/travel-agency.hero_subtitle') }}
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-10">
                <a href="#packages" class="px-16 py-7 bg-white text-emerald-950 rounded-full font-black text-xs uppercase tracking-widest hover:bg-emerald-500 hover:text-white transition-all shadow-2xl">
                    {{ __('front/travel-agency.book_now') }}
                </a>
            </div>
        </div>

        {{-- Floating indicator --}}
        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 z-30 animate-bounce">
            <x-heroicon-o-chevron-down class="size-8 text-white/50"/>
        </div>
    </section>

    {{-- Tour Packages Section --}}
    <section id="packages" class="py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-32">
                <div class="text-left">
                    <span class="text-emerald-500 font-bold text-xs uppercase tracking-[0.3em]">{{ __('front/travel-agency.services_subtitle') }}</span>
                    <h2 class="text-7xl font-black text-gray-900 mt-6 uppercase tracking-tighter leading-none italic">
                        @php
                            $icParts = explode(' ', __('front/travel-agency.our_services'), 2);
                        @endphp
                        {{ $icParts[0] }}<br>{{ $icParts[1] ?? '' }}.
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($packages as $package)
                    <div class="group relative bg-white rounded-[3.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-700 border border-gray-100 flex flex-col h-full">
                        <div class="relative h-96 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute top-10 left-10">
                                <span class="px-5 py-2.5 bg-white/90 backdrop-blur-md rounded-2xl text-[10px] font-black uppercase text-emerald-600 shadow-xl tracking-[0.2em]">
                                    Premium Experience
                                </span>
                            </div>
                        </div>
                        <div class="p-14 flex flex-col flex-1 text-left">
                            <h3 class="text-4xl font-black text-gray-900 mb-6 uppercase tracking-tighter leading-none group-hover:text-emerald-600 transition-colors">{{ $package->name }}</h3>
                            <p class="text-gray-400 text-lg leading-relaxed mb-12 italic font-medium">Experience the ultimate getaway with private guides, premium accommodation, and curated local experiences.</p>

                            <div class="mt-auto flex items-center justify-between pt-10 border-t border-gray-50">
                                <div>
                                    <p class="text-[10px] font-black uppercase text-gray-300 mb-2">Package starts at</p>
                                    <p class="text-4xl font-black text-gray-900 italic">€{{ number_format($package->price ?? 0, 0) }}</p>
                                </div>
                                <button class="size-20 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-all shadow-lg">
                                    <x-heroicon-o-arrow-right class="size-8"/>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-24 text-center">
                         <p class="text-gray-300 italic text-2xl uppercase tracking-widest">New expeditions are being charted.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Destinations Section --}}
    <section id="destinations" class="py-32 bg-gray-900 text-white overflow-hidden relative rounded-t-[5rem]">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-32">
                <h2 class="text-7xl font-black uppercase tracking-tighter italic leading-none opacity-90">
                    @php
                        $wdParts = explode(' ', __('front/travel-agency.meet_team'), 2);
                    @endphp
                    {{ $wdParts[0] }} {{ $wdParts[1] ?? '' }}<br><span class="text-emerald-400">Destinations.</span>
                </h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-10">
                @foreach($destinations as $dest)
                    <div class="group relative aspect-[4/5] overflow-hidden rounded-[3rem] bg-gray-800 border border-white/5">
                        <img src="https://images.unsplash.com/photo-1493246507139-91e8bef99c02?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 opacity-40 group-hover:opacity-100 grayscale group-hover:grayscale-0">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent opacity-80"></div>
                        <div class="absolute bottom-0 left-0 p-10 text-left">
                            <p class="text-emerald-400 text-[10px] font-black uppercase tracking-[0.3em] mb-4">{{ $dest->country ?? 'DESTINATION' }}</p>
                            <h3 class="text-3xl font-black italic uppercase tracking-tighter leading-none group-hover:text-white transition-colors">{{ $dest->name ?? 'Unknown' }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-32 bg-white border-t border-gray-100 italic">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-20">
            <h2 class="text-5xl font-black tracking-tighter uppercase italic text-gray-900">TRAVEL<span class="text-emerald-500">STATION.</span></h2>
            <div class="flex flex-wrap justify-center gap-16 text-[11px] font-black uppercase tracking-[0.4em] text-gray-400">
                <a href="#" class="hover:text-emerald-600 transition-all">Portfolio</a>
                <a href="#" class="hover:text-emerald-600 transition-all">Impact</a>
                <a href="#" class="hover:text-emerald-600 transition-all">Press</a>
                <a href="#" class="hover:text-emerald-600 transition-all">Contact</a>
            </div>
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-300 italic text-center">© {{ date('Y') }} THE TRAVEL STATION. GO WILD.</p>
        </div>
    </footer>
</div>
