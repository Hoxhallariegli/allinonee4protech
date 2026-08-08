<div class="bg-white min-h-screen selection:bg-amber-100 selection:text-amber-900">
    {{-- Hero Section --}}
    <section class="relative h-[80vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0 bg-zinc-900">
            <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover opacity-60">
        </div>

        <div class="container mx-auto px-6 relative z-20">
            <div class="max-w-4xl">
                <span class="inline-block px-4 py-2 bg-amber-500 text-black text-[10px] font-black uppercase tracking-[0.4em] mb-10 rounded-sm">
                    {{ __('front/construction-e-r-p.welcome_to') }}
                </span>
                <h1 class="text-6xl md:text-9xl font-black text-white tracking-tighter mb-10 leading-[0.8] uppercase">
                    @php
                        $titleParts = explode(' ', __('front/construction-e-r-p.elevate_experience'), 2);
                    @endphp
                    {{ $titleParts[0] }}<br><span class="text-amber-500">{{ $titleParts[1] ?? '' }}</span>
                </h1>
                <p class="text-white/80 text-lg md:text-2xl max-w-2xl mb-16 font-medium leading-relaxed italic border-l-4 border-amber-500 pl-8">
                    {{ __('front/construction-e-r-p.hero_subtitle') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-6">
                    <button class="px-12 py-5 bg-amber-500 text-black rounded-sm font-black text-xs uppercase tracking-widest hover:bg-amber-400 transition-all shadow-2xl">
                        {{ __('front/construction-e-r-p.book_now') }}
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Projects Section --}}
    <section class="py-32 px-6 bg-zinc-50">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-24">
                <div>
                    <span class="text-amber-600 font-bold text-xs uppercase tracking-[0.3em]">{{ __('front/construction-e-r-p.services_subtitle') }}</span>
                    <h2 class="text-6xl font-black text-zinc-900 mt-6 uppercase tracking-tighter leading-none">{{ __('front/construction-e-r-p.our_services') }}.</h2>
                </div>
                <div class="h-px flex-1 bg-zinc-200 hidden lg:block mb-8 mx-12"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                @forelse($projects as $project)
                    <div class="group bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-700 border border-zinc-100 flex flex-col">
                        <div class="relative h-80 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1503387762-592fca6725ed?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute bottom-0 left-0 p-8 z-20">
                                <div class="px-4 py-2 bg-amber-500 text-black text-[10px] font-black uppercase tracking-widest shadow-xl">
                                    {{ $project->status ?? 'Active' }}
                                </div>
                            </div>
                        </div>
                        <div class="p-12">
                            <h3 class="text-3xl font-black text-zinc-900 mb-6 uppercase tracking-tight">{{ $project->name }}</h3>
                            <p class="text-zinc-500 text-lg mb-10 leading-relaxed italic">High-performance sustainable development featuring cutting-edge architectural designs and optimized urban integration.</p>

                            <div class="grid grid-cols-2 gap-8 border-t border-zinc-50 pt-8 mb-10">
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-zinc-300 mb-2">Location</p>
                                    <p class="text-sm font-bold text-zinc-600 italic">Tirana, Albania</p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-zinc-300 mb-2">Budget</p>
                                    <p class="text-sm font-bold text-zinc-600 italic">€{{ number_format($project->budget ?? 0, 0) }}</p>
                                </div>
                            </div>

                            <button class="flex items-center gap-4 text-xs font-black uppercase tracking-widest text-amber-600 hover:text-amber-500 transition-colors">
                                Project Details <x-heroicon-o-arrow-right class="size-4"/>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <p class="text-zinc-400 italic text-xl">We are currently planning our next major urban transformation.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-zinc-900 text-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 pb-20 border-b border-white/5">
                <div class="lg:col-span-5">
                    <h2 class="text-4xl font-black tracking-tighter mb-8 uppercase italic">BUILD<span class="text-amber-500">STATION.</span></h2>
                    <p class="text-white/40 text-lg leading-relaxed font-medium italic">
                        Constructing the landmarks of tomorrow. Our commitment to quality, safety, and innovation makes us the preferred partner for complex engineering projects.
                    </p>
                </div>
                <div class="lg:col-span-3 lg:col-start-7 text-right">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.4em] text-amber-500 mb-10">Corporate</h4>
                    <ul class="space-y-4 text-sm font-bold text-white/40 uppercase tracking-widest">
                        <li><a href="#" class="hover:text-white transition-colors">Strategic Planning</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Infrastructure</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-12 flex justify-between items-center text-[9px] font-black uppercase tracking-[0.3em] text-white/20">
                <p>© {{ date('Y') }} BUILD STATION CORP. ALL RIGHTS RESERVED.</p>
                <p>Building Excellence</p>
            </div>
        </div>
    </footer>
</div>
