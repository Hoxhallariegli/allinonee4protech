<div class="bg-zinc-50 min-h-screen selection:bg-emerald-100 selection:text-emerald-900">
    {{-- Hero Section --}}
    <section class="relative pt-40 pb-32 overflow-hidden bg-white">
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="inline-block px-4 py-2 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-[0.4em] mb-12 rounded-full border border-emerald-100">
                {{ __('front/finance.welcome_to') }}
            </span>
            <h1 class="text-7xl md:text-[9rem] font-black text-zinc-900 tracking-tighter mb-12 leading-[0.8] uppercase">
                @php
                    $titleParts = explode(' ', __('front/finance.elevate_experience'), 2);
                @endphp
                {{ $titleParts[0] }}<br><span class="text-emerald-500 italic">{{ $titleParts[1] ?? '' }}</span>
            </h1>
            <p class="text-zinc-400 text-xl md:text-2xl max-w-2xl mx-auto font-medium leading-relaxed italic mb-16">
                {{ __('front/finance.hero_subtitle') }}
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-10">
                <button class="px-14 py-6 bg-zinc-900 text-white rounded-full font-black text-xs uppercase tracking-widest hover:bg-emerald-600 transition-all shadow-2xl">
                    {{ __('front/finance.book_now') }}
                </button>
                <div class="flex items-center gap-4 text-xs font-black uppercase tracking-widest text-zinc-400">
                    <x-heroicon-o-shield-check class="size-6 text-emerald-500"/> Fully Regulated & Secure
                </div>
            </div>
        </div>
        {{-- Geometric Elements --}}
        <div class="absolute top-1/2 left-0 -translate-y-1/2 -translate-x-1/2 size-[600px] border border-emerald-100 rounded-full opacity-40"></div>
    </section>

    {{-- Services Section --}}
    <section class="py-32 px-6">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                <div class="space-y-8">
                    <div class="size-16 rounded-3xl bg-emerald-600 text-white flex items-center justify-center shadow-xl shadow-emerald-200">
                        <x-heroicon-o-banknotes class="size-8"/>
                    </div>
                    <h3 class="text-4xl font-black text-zinc-900 uppercase tracking-tighter">{{ __('front/finance.our_services') }}</h3>
                    <p class="text-zinc-500 text-lg italic leading-relaxed">Personalized portfolio management designed to preserve and grow your generational wealth through global markets.</p>
                </div>
                <div class="space-y-8">
                    <div class="size-16 rounded-3xl bg-zinc-900 text-white flex items-center justify-center">
                        <x-heroicon-o-presentation-chart-line class="size-8"/>
                    </div>
                    <h3 class="text-4xl font-black text-zinc-900 uppercase tracking-tighter">{{ __('front/finance.services_subtitle') }}</h3>
                    <p class="text-zinc-500 text-lg italic leading-relaxed">Bespoke financial strategies for corporations looking to optimize their balance sheets and maximize shareholder value.</p>
                </div>
                <div class="space-y-8">
                    <div class="size-16 rounded-3xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <x-heroicon-o-document-duplicate class="size-8"/>
                    </div>
                    <h3 class="text-4xl font-black text-zinc-900 uppercase tracking-tighter">Tax Advisory</h3>
                    <p class="text-zinc-500 text-lg italic leading-relaxed">International tax planning and compliance services tailored to navigate the complex global financial landscape.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Trust Section --}}
    <section class="py-40 bg-zinc-950 text-white overflow-hidden relative">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-6xl md:text-8xl font-black italic tracking-tighter mb-16 uppercase opacity-90">
                @php
                    $exParts = explode(' ', __('front/finance.meet_team'), 2);
                @endphp
                {{ $exParts[0] }}<br><span class="text-emerald-500">{{ $exParts[1] ?? '' }}.</span>
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
                <div>
                    <p class="text-5xl font-black italic mb-2">$4.2B</p>
                    <p class="text-zinc-600 text-[10px] font-black uppercase tracking-widest">Assets Under Advisory</p>
                </div>
                <div>
                    <p class="text-5xl font-black italic mb-2">15+</p>
                    <p class="text-zinc-600 text-[10px] font-black uppercase tracking-widest">Global Markets</p>
                </div>
                <div>
                    <p class="text-5xl font-black italic mb-2">1200</p>
                    <p class="text-zinc-600 text-[10px] font-black uppercase tracking-widest">Enterprise Clients</p>
                </div>
                <div>
                    <p class="text-5xl font-black italic mb-2">AA+</p>
                    <p class="text-zinc-600 text-[10px] font-black uppercase tracking-widest">Credit Rating</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-white border-t border-zinc-100">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-12">
            <h2 class="text-3xl font-black text-zinc-900 tracking-tighter italic uppercase">CAPITAL<span class="text-emerald-500">STATION.</span></h2>
            <div class="flex gap-12 text-[10px] font-black uppercase tracking-[0.3em] text-zinc-400">
                <a href="#" class="hover:text-emerald-600 transition-colors">Services</a>
                <a href="#" class="hover:text-emerald-600 transition-colors">Legal</a>
                <a href="#" class="hover:text-emerald-600 transition-colors">Contact</a>
            </div>
            <p class="text-[9px] font-black uppercase tracking-widest text-zinc-400 italic">© {{ date('Y') }} CAPITAL STATION GLOBAL ADVISORY.</p>
        </div>
    </footer>
</div>
