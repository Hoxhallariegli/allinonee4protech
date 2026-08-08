<div class="bg-white min-h-screen selection:bg-rose-100 selection:text-rose-900">
    {{-- Hero Section --}}
    <section class="relative pt-32 pb-32 overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div>
                    <span class="inline-block px-4 py-2 bg-rose-50 text-rose-600 text-[10px] font-black uppercase tracking-[0.4em] mb-10 rounded-lg">
                        {{ __('front/c-r-m.welcome_to') }}
                    </span>
                    <h1 class="text-6xl md:text-8xl font-black text-gray-900 tracking-tighter mb-10 leading-[0.9]">
                        @php
                            $titleParts = explode(' ', __('front/c-r-m.elevate_experience'), 2);
                        @endphp
                        {{ $titleParts[0] }} {{ $titleParts[1] ?? '' }}<br><span class="text-rose-600">Pixels.</span>
                    </h1>
                    <p class="text-gray-500 text-xl md:text-2xl max-w-xl mb-12 font-medium leading-relaxed italic">
                        {{ __('front/c-r-m.hero_subtitle') }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6">
                        <button class="px-12 py-5 bg-gray-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-rose-600 transition-all shadow-2xl">
                            {{ __('front/c-r-m.book_now') }}
                        </button>
                    </div>
                </div>
                <div class="relative hidden lg:block">
                    <div class="absolute inset-0 bg-rose-600 rounded-[5rem] translate-x-12 translate-y-12 -z-10 opacity-10"></div>
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" class="w-full aspect-[4/5] object-cover rounded-[5rem] shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    {{-- Value Props --}}
    <section class="py-32 px-6 bg-slate-50 rounded-[5rem]">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-20">
                <div class="text-center group">
                    <div class="size-20 mx-auto rounded-full bg-white flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform mb-10">
                        <x-heroicon-o-chat-bubble-left-right class="size-10 text-rose-600"/>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter mb-4">{{ __('front/c-r-m.our_services') }}</h3>
                    <p class="text-gray-500 italic">Every conversation matters. We track every touchpoint to build a complete 360° view of your customer.</p>
                </div>
                <div class="text-center group">
                    <div class="size-20 mx-auto rounded-full bg-white flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform mb-10">
                        <x-heroicon-o-presentation-chart-bar class="size-10 text-rose-600"/>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter mb-4">{{ __('front/c-r-m.services_subtitle') }}</h3>
                    <p class="text-gray-500 italic">Turn data into deals. Our AI models predict customer behavior so you can act before the opportunity fades.</p>
                </div>
                <div class="text-center group">
                    <div class="size-20 mx-auto rounded-full bg-white flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform mb-10">
                        <x-heroicon-o-sparkles class="size-10 text-rose-600"/>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter mb-4">{{ __('front/c-r-m.meet_team') }}</h3>
                    <p class="text-gray-500 italic">{{ __('front/c-r-m.team_subtitle') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-white border-t border-gray-100">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-black text-gray-900 tracking-tighter italic mb-16 uppercase">RELATIONSHIP<span class="text-rose-600">STATION.</span></h2>
            <div class="flex flex-wrap justify-center gap-12 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 mb-20">
                <a href="#" class="hover:text-rose-600">Methodology</a>
                <a href="#" class="hover:text-rose-600">Privacy</a>
                <a href="#" class="hover:text-rose-600">Contact</a>
            </div>
            <p class="text-[9px] font-black uppercase tracking-widest text-gray-400 italic">© {{ date('Y') }} THE RELATIONSHIP STATION. CONNECT BETTER.</p>
        </div>
    </footer>
</div>
