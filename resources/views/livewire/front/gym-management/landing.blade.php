<div class="bg-black min-h-screen text-white selection:bg-yellow-400 selection:text-black font-body antialiased">
    {{-- Hero Section --}}
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent z-10"></div>
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover">
        </div>

        <div class="relative z-20 text-center px-6">
            <div class="inline-block px-4 py-2 bg-yellow-400 text-black text-[10px] font-black uppercase tracking-[0.4em] mb-10 rounded-sm">
                {{ __('front/gym-management.welcome_to') }}
            </div>
            <h1 class="font-display text-[5rem] md:text-[10rem] tracking-tighter mb-10 leading-[0.8] uppercase italic">
                @php
                    $titleParts = explode(' ', __('front/gym-management.elevate_experience'), 2);
                @endphp
                {{ $titleParts[0] }}<br><span class="text-yellow-400">{{ $titleParts[1] ?? '' }}</span>
            </h1>
            <p class="text-white/60 text-lg md:text-xl max-w-xl mx-auto italic font-bold leading-relaxed mb-16">
                {{ __('front/gym-management.hero_subtitle') }}
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="#plans" class="px-14 py-6 bg-white text-black rounded-sm font-black text-xs uppercase tracking-[0.2em] hover:bg-yellow-400 transition-all shadow-2xl">
                    {{ __('front/gym-management.book_now') }}
                </a>
                <a href="#trainers" class="px-14 py-6 border-2 border-white/20 text-white rounded-sm font-black text-xs uppercase tracking-[0.2em] hover:border-yellow-400 hover:text-yellow-400 transition-all">
                    {{ __('front/gym-management.view_portfolio') }}
                </a>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 animate-bounce hidden md:block">
            <x-heroicon-o-arrow-down class="size-6 text-yellow-400"/>
        </div>
    </section>

    {{-- Membership Plans --}}
    <section id="plans" class="py-32 px-6 bg-zinc-950">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-24">
                <h2 class="text-6xl md:text-8xl font-black uppercase italic tracking-tighter leading-none">{{ __('front/gym-management.our_services') }}.</h2>
                <div class="h-1 w-24 bg-yellow-400 mx-auto mt-8"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($plans as $plan)
                    <div class="bg-zinc-900 p-12 rounded-sm border-t-4 border-transparent hover:border-yellow-400 transition-all group relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 size-32 bg-yellow-400/5 rounded-full blur-3xl group-hover:bg-yellow-400/10 transition-colors"></div>
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-zinc-500 mb-8">{{ $plan->name }}</h3>
                        <div class="flex items-baseline gap-2 mb-12">
                            <span class="text-5xl font-black italic">L{{ number_format($plan->price ?? 0, 0) }}</span>
                            <span class="text-zinc-500 font-bold uppercase text-[10px]">/ month</span>
                        </div>
                        <ul class="space-y-4 mb-12">
                            <li class="flex items-center gap-3 text-sm font-bold opacity-80"><x-heroicon-o-check class="size-4 text-yellow-400"/> 24/7 Gym Access</li>
                            <li class="flex items-center gap-3 text-sm font-bold opacity-80"><x-heroicon-o-check class="size-4 text-yellow-400"/> Modern Equipment</li>
                            <li class="flex items-center gap-3 text-sm font-bold opacity-80 italic"><x-heroicon-o-check class="size-4 text-yellow-400"/> {{ $plan->description ?? 'Basic coaching included' }}</li>
                        </ul>
                        <button class="w-full py-5 border-2 border-white font-black text-[10px] uppercase tracking-widest hover:bg-white hover:text-black transition-all">Join The Tribe</button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Trainers Section --}}
    <section id="trainers" class="py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-24">
                <h2 class="text-6xl md:text-8xl font-black uppercase italic tracking-tighter leading-none">
                    @php
                        $teamParts = explode(' ', __('front/gym-management.meet_team'), 2);
                    @endphp
                    {{ $teamParts[0] }}<br><span class="text-yellow-400">{{ $teamParts[1] ?? '' }}.</span>
                </h2>
                <p class="text-zinc-500 max-w-sm text-lg italic">{{ __('front/gym-management.team_subtitle') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($trainers as $trainer)
                    <div class="group relative aspect-[3/4] overflow-hidden rounded-sm">
                        @if($trainer->photo)
                            <img src="{{ asset('uploads/'.$trainer->photo) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700">
                        @else
                            <div class="w-full h-full bg-zinc-900 flex items-end p-8 border border-zinc-800">
                                <span class="text-9xl font-black text-white/5 absolute -top-10 -left-10">{{ substr($trainer->name, 0, 1) }}</span>
                                <div class="absolute inset-0 flex items-center justify-center opacity-10">
                                     <x-heroicon-o-user class="size-32 text-white"/>
                                </div>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80 group-hover:opacity-60 transition-opacity"></div>
                        <div class="absolute bottom-0 left-0 p-8">
                            <h3 class="text-2xl font-black uppercase italic tracking-tighter">{{ $trainer->name }}</h3>
                            <p class="text-yellow-400 text-[10px] font-black uppercase tracking-[0.2em] mt-2 italic">{{ $trainer->specialization ?? 'Strength Coach' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 px-6 border-t border-white/5 bg-black">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-12 text-center md:text-left">
            <h2 class="text-4xl font-black italic tracking-tighter uppercase leading-none">IRON<span class="text-yellow-400">POWER</span><br><span class="text-zinc-800 text-sm">GYM HQ</span></h2>
            <div class="flex flex-wrap justify-center gap-12 text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500 font-body">
                <a href="#" class="hover:text-yellow-400 transition-colors">Membership</a>
                <a href="#" class="hover:text-yellow-400 transition-colors">Trainers</a>
                <a href="#" class="hover:text-yellow-400 transition-colors">Contact</a>
            </div>
            <p class="text-[10px] font-black uppercase tracking-widest text-zinc-700 italic">© {{ date('Y') }} IRON POWER GYM. NO EXCUSES.</p>
        </div>
    </footer>
</div>
