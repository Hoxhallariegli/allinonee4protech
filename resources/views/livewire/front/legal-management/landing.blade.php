<div class="bg-slate-50 min-h-screen selection:bg-slate-200 selection:text-slate-900 font-body antialiased">
    {{-- Hero Section --}}
    <section class="relative pt-40 pb-32 overflow-hidden bg-white">
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl">
                <span class="inline-block px-4 py-2 bg-slate-900 text-white text-[10px] font-black uppercase tracking-[0.4em] mb-12 rounded-sm">
                    {{ __('front/legal-management.welcome_to') }}
                </span>
                <h1 class="text-7xl md:text-[9rem] font-black text-slate-900 tracking-tighter mb-12 leading-[0.8] uppercase">
                    @php
                        $titleParts = explode(' ', __('front/legal-management.elevate_experience'), 2);
                    @endphp
                    {{ $titleParts[0] }}<br><span class="text-slate-400 italic">{{ $titleParts[1] ?? '' }}</span>
                </h1>
                <p class="text-slate-500 text-xl md:text-2xl max-w-xl font-medium leading-relaxed italic mb-16 border-l-8 border-slate-900 pl-10">
                    {{ __('front/legal-management.hero_subtitle') }}
                </p>
                <div class="flex flex-col sm:flex-row items-center gap-10">
                    <button class="px-14 py-6 bg-slate-900 text-white rounded-sm font-black text-xs uppercase tracking-widest hover:bg-slate-700 transition-all shadow-2xl">
                        {{ __('front/legal-management.book_now') }}
                    </button>
                    <div class="flex items-center gap-4 text-xs font-black uppercase tracking-widest text-slate-400">
                        <x-heroicon-o-scale class="size-6 text-slate-900"/> {{ __('front/legal-management.meet_team') }}
                    </div>
                </div>
            </div>
        </div>
        {{-- Absolute background text --}}
        <div class="absolute -bottom-20 -right-20 text-[20rem] font-black text-slate-50 select-none -z-10 uppercase tracking-tighter opacity-50 italic">LAW</div>
    </section>

    {{-- Cases Section --}}
    <section class="py-32 px-6 bg-slate-50">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-24">
                <h2 class="text-6xl font-black text-slate-900 uppercase tracking-tighter leading-none italic">
                    @php
                        $docParts = explode(' ', __('front/legal-management.our_services'), 2);
                    @endphp
                    {{ $docParts[0] }}<br><span class="text-slate-300">{{ $docParts[1] ?? '' }}.</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($cases as $case)
                    <div class="group bg-white p-12 rounded-sm border border-slate-100 hover:shadow-2xl transition-all duration-700 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-slate-900 transform -translate-x-full group-hover:translate-x-0 transition-transform"></div>
                        <h3 class="text-2xl font-black text-slate-900 mb-4 uppercase tracking-tighter">{{ $case->title }}</h3>
                        <p class="text-slate-400 text-xs font-black uppercase tracking-widest mb-10">{{ $case->client->name ?? 'Corporate Entity' }}</p>
                        <div class="flex items-center justify-between pt-8 border-t border-slate-50">
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-300 italic">Status: {{ $case->status ?? 'Active' }}</span>
                            <x-heroicon-o-chevron-right class="size-4 text-slate-900 group-hover:translate-x-2 transition-transform"/>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Hearings Section --}}
    <section class="py-32 px-6 bg-slate-900 text-white overflow-hidden relative">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row gap-24 items-start">
                <div class="lg:sticky lg:top-40 max-w-md">
                    <h2 class="text-6xl font-black uppercase tracking-tighter leading-none italic mb-12">Court<br><span class="text-slate-500">Presence.</span></h2>
                    <p class="text-slate-400 text-lg leading-relaxed italic">Real-time tracking of our courtroom engagements. Transparency and readiness in every legal procedure.</p>
                </div>

                <div class="flex-1 space-y-8">
                    @foreach($hearings as $hearing)
                        <div class="flex items-center gap-12 p-10 border border-slate-800 rounded-sm hover:bg-slate-800/50 transition-all group">
                            <div class="text-center shrink-0">
                                <p class="text-4xl font-black italic tracking-tighter">{{ Carbon\Carbon::parse($hearing->date)->format('d') }}</p>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">{{ Carbon\Carbon::parse($hearing->date)->format('M') }}</p>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold uppercase tracking-tight mb-2 group-hover:text-slate-300 transition-colors">{{ $hearing->legalCase->title ?? 'Legal Procedure' }}</h4>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-600">{{ $hearing->location ?? 'High Court of Tirana' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-white border-t border-slate-100">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-12 opacity-30 italic">
            <h2 class="text-3xl font-black tracking-tighter uppercase">LEGAL<span class="text-slate-500">PRESTIGE.</span></h2>
            <div class="flex flex-wrap justify-center gap-12 text-[10px] font-black uppercase tracking-[0.3em]">
                <a href="#">Ethics</a>
                <a href="#">Litigation</a>
                <a href="#">Privacy</a>
                <a href="#">Contact</a>
            </div>
            <p class="text-[9px] font-black uppercase tracking-widest">© {{ date('Y') }} THE PRESTIGE LAW GROUP. TIRANA.</p>
        </div>
    </footer>
</div>
