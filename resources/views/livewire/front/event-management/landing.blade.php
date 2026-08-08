<div class="bg-zinc-950 min-h-screen text-white selection:bg-rose-100 selection:text-rose-900 font-body antialiased">
    {{-- Hero Section --}}
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-black/70 z-10"></div>
            <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover">
        </div>

        <div class="relative z-20 text-center px-6">
            <div class="inline-block px-6 py-2 border border-rose-500/30 bg-rose-500/10 text-rose-500 text-[10px] font-black uppercase tracking-[0.5em] mb-12 rounded-full shadow-2xl shadow-rose-500/10">
                {{ __('front/event-management.welcome_to') }}
            </div>
            <h1 class="font-display text-[5rem] md:text-[10rem] tracking-tighter mb-10 leading-[0.8] uppercase italic">
                @php
                    $titleParts = explode(' ', __('front/event-management.elevate_experience'), 3);
                @endphp
                {{ $titleParts[0] }} {{ $titleParts[1] ?? '' }}<br><span class="text-rose-500">{{ $titleParts[2] ?? '' }}</span>
            </h1>
            <p class="text-white/40 text-lg md:text-2xl max-w-xl mx-auto italic font-bold leading-relaxed mb-16">
                {{ __('front/event-management.hero_subtitle') }}
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-10">
                <button class="px-16 py-7 bg-white text-black font-black text-xs uppercase tracking-widest hover:bg-rose-500 hover:text-white transition-all shadow-2xl">
                    {{ __('front/event-management.book_now') }}
                </button>
            </div>
        </div>

        {{-- Floating indicator --}}
        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 z-30 animate-bounce">
            <x-heroicon-o-chevron-down class="size-8 text-rose-500/50"/>
        </div>
    </section>

    {{-- Events Section --}}
    <section class="py-32 px-6 bg-zinc-950">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-32">
                <h2 class="text-6xl md:text-8xl font-black uppercase italic tracking-tighter leading-[0.9] text-left">
                    @php
                        $expParts = explode(' ', __('front/event-management.our_services'), 2);
                    @endphp
                    {{ $expParts[0] }}<br><span class="text-rose-500">{{ $expParts[1] ?? '' }}.</span>
                </h2>
                <p class="text-zinc-500 max-w-xs text-lg italic text-left">{{ __('front/event-management.team_subtitle') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                @forelse($events as $event)
                    <div class="group relative aspect-video overflow-hidden rounded-[4rem] border border-white/5 shadow-2xl bg-zinc-900">
                        <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-1000 opacity-60">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-16 text-left">
                            <span class="text-rose-500 text-[10px] font-black uppercase tracking-[0.4em] mb-6 block">{{ $event->event_date ?? 'Coming Soon' }}</span>
                            <h3 class="text-5xl font-black italic tracking-tighter uppercase mb-10 leading-none group-hover:text-rose-400 transition-colors">{{ $event->title ?? $event->name }}</h3>
                            <button class="px-10 py-5 border-2 border-white/20 rounded-full text-[11px] font-black uppercase tracking-widest hover:bg-white hover:text-black transition-all shadow-xl">Get Access</button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-24 text-center">
                        <p class="text-zinc-700 italic text-2xl uppercase tracking-widest">The next season of events is being curated.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Organizers Section --}}
    <section class="py-32 px-6 border-t border-white/5 bg-zinc-900 relative overflow-hidden">
        <div class="container mx-auto relative z-10">
             <div class="text-center mb-32">
                <span class="text-zinc-500 font-bold text-xs uppercase tracking-[0.5em]">{{ __('front/event-management.services_subtitle') }}</span>
                <h2 class="text-6xl font-black uppercase italic tracking-tighter mt-6">{{ __('front/event-management.meet_team') }}.</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                @foreach($organizers as $org)
                    <div class="group text-center">
                        <div class="relative size-64 mx-auto mb-10">
                            <div class="absolute inset-0 bg-rose-600 rounded-[4rem] rotate-12 group-hover:rotate-0 transition-transform duration-700 opacity-20"></div>
                            <div class="absolute inset-0 bg-zinc-800 rounded-[4rem] overflow-hidden border border-white/5 flex items-center justify-center">
                                @if($org->photo)
                                    <img src="{{ asset('uploads/'.$org->photo) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                                @else
                                     <x-heroicon-o-sparkles class="size-20 text-rose-500/20 group-hover:text-rose-500 transition-colors"/>
                                @endif
                            </div>
                        </div>
                        <h3 class="text-3xl font-black italic tracking-tighter uppercase leading-none">{{ $org->name }}</h3>
                        <p class="text-rose-500 text-[10px] font-black uppercase tracking-[0.2em] mt-4">Master Organizer</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-32 px-6 bg-black italic">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-20">
            <h2 class="text-5xl font-black italic tracking-tighter uppercase text-white leading-none">EVENT<br><span class="text-rose-500">STATION.</span></h2>
            <div class="flex flex-wrap justify-center gap-16 text-[11px] font-black uppercase tracking-[0.4em] text-zinc-700">
                <a href="#" class="hover:text-rose-500 transition-all">Gala</a>
                <a href="#" class="hover:text-rose-500 transition-all">Press</a>
                <a href="#" class="hover:text-rose-500 transition-all">Careers</a>
                <a href="#" class="hover:text-rose-500 transition-all">Contact</a>
            </div>
            <p class="text-[10px] font-black uppercase tracking-widest text-zinc-800 italic text-center">© {{ date('Y') }} THE EVENT STATION. UNFORGETTABLE MOMENTS.</p>
        </div>
    </footer>
</div>
