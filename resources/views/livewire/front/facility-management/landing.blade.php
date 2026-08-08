<div class="bg-white min-h-screen selection:bg-slate-100 selection:text-slate-900">
    {{-- Hero Section --}}
    <section class="relative pt-40 pb-32 overflow-hidden bg-slate-900 text-white">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 0 L100 0 L100 100 Z" fill="currentColor"></path>
            </svg>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <span class="inline-block px-4 py-2 bg-white text-slate-900 text-[10px] font-black uppercase tracking-[0.4em] mb-12 rounded-sm">
                {{ __('front/facility-management.welcome_to') }}
            </span>
            <h1 class="text-7xl md:text-[9rem] font-black tracking-tighter mb-12 leading-[0.8] uppercase italic">
                @php
                    $titleParts = explode(' ', __('front/facility-management.elevate_experience'), 2);
                @endphp
                {{ $titleParts[0] }}<br><span class="text-slate-400">{{ $titleParts[1] ?? '' }}</span>
            </h1>
            <p class="text-slate-400 text-xl md:text-2xl max-w-xl font-medium leading-relaxed italic mb-16">
                {{ __('front/facility-management.hero_subtitle') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-8">
                <button class="px-14 py-6 bg-white text-slate-900 rounded-sm font-black text-xs uppercase tracking-widest hover:bg-slate-200 transition-all">
                    {{ __('front/facility-management.book_now') }}
                </button>
            </div>
        </div>
    </section>

    {{-- Managed Buildings --}}
    <section class="py-32 px-6">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-24">
                <h2 class="text-5xl font-black text-slate-900 uppercase tracking-tighter italic leading-none">
                    @php
                        $porParts = explode(' ', __('front/facility-management.our_services'), 2);
                    @endphp
                    {{ $porParts[0] }} {{ $porParts[1] ?? '' }}<br>Reliability.
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($managedBuildings as $building)
                    <div class="group bg-slate-50 p-12 rounded-[3rem] border border-slate-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                        <div class="size-16 rounded-2xl bg-slate-900 text-white flex items-center justify-center mb-10 group-hover:scale-110 transition-transform">
                            <x-heroicon-o-building-office-2 class="size-8"/>
                        </div>
                        <h3 class="text-3xl font-black text-slate-900 mb-6 uppercase tracking-tight">{{ $building->name }}</h3>
                        <p class="text-slate-400 text-sm font-medium leading-relaxed mb-10 italic">Providing comprehensive maintenance, security, and operational management for premium urban infrastructures.</p>
                        <div class="flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-slate-300">
                            <span class="size-2 rounded-full bg-emerald-500"></span> Fully Managed
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-slate-950 text-white">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-12 opacity-30">
            <h2 class="text-3xl font-black tracking-tighter italic uppercase">FACILITY<span class="text-slate-400">STATION.</span></h2>
            <div class="flex flex-wrap justify-center gap-12 text-[10px] font-black uppercase tracking-[0.3em]">
                <a href="#" class="hover:text-white">Assets</a>
                <a href="#" class="hover:text-white">Team</a>
                <a href="#" class="hover:text-white">Maintenance</a>
                <a href="#" class="hover:text-white">Contact</a>
            </div>
            <p class="text-[9px] font-black uppercase tracking-widest italic">© {{ date('Y') }} FACILITY STATION GROUP.</p>
        </div>
    </footer>
</div>
