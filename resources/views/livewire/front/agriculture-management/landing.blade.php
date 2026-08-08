<div class="bg-stone-50 min-h-screen selection:bg-lime-100 selection:text-lime-900">
    {{-- Hero Section --}}
    <section class="relative pt-32 pb-48 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_rgba(132,204,22,0.1),transparent)] -z-10"></div>
        <div class="container mx-auto px-6 text-center">
            <span class="inline-block px-4 py-2 bg-lime-100 text-lime-700 text-[10px] font-black uppercase tracking-[0.4em] mb-10 rounded-full border border-lime-200">
                {{ __('front/agriculture-management.welcome_to') }}
            </span>
            <h1 class="text-7xl md:text-[9rem] font-black text-stone-900 tracking-tighter mb-10 leading-[0.8] uppercase">
                @php
                    $titleParts = explode(' ', __('front/agriculture-management.elevate_experience'), 2);
                @endphp
                {{ $titleParts[0] }}<br><span class="text-lime-500 italic">{{ $titleParts[1] ?? '' }}</span>
            </h1>
            <p class="text-stone-500 text-xl md:text-2xl max-w-2xl mx-auto font-medium leading-relaxed italic mb-16">
                {{ __('front/agriculture-management.hero_subtitle') }}
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <button class="px-14 py-6 bg-stone-900 text-white rounded-full font-black text-xs uppercase tracking-widest hover:bg-lime-500 transition-all shadow-2xl">
                    {{ __('front/agriculture-management.book_now') }}
                </button>
            </div>
        </div>
    </section>

    {{-- Crops Section --}}
    <section class="py-32 px-6 bg-white rounded-t-[5rem]">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-32">
                <div class="max-w-2xl">
                    <span class="text-lime-600 font-bold text-xs uppercase tracking-[0.3em]">{{ __('front/agriculture-management.services_subtitle') }}</span>
                    <h2 class="text-6xl font-black text-stone-900 mt-6 uppercase tracking-tighter leading-none italic">{{ __('front/agriculture-management.our_services') }}.</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-10 gap-y-20">
                @foreach($crops as $crop)
                    <div class="group">
                        <div class="relative aspect-square rounded-[3.5rem] overflow-hidden mb-10 shadow-lg group-hover:shadow-2xl transition-all duration-700">
                            <img src="https://images.unsplash.com/photo-1518843875459-f738682238a6?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 grayscale group-hover:grayscale-0">
                            <div class="absolute inset-0 bg-gradient-to-t from-stone-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <h3 class="text-3xl font-black text-stone-900 uppercase tracking-tighter">{{ $crop->name }}</h3>
                        <p class="text-lime-600 font-bold text-xs uppercase tracking-widest mt-2">Organic Certified</p>
                        <p class="text-stone-400 text-sm mt-6 leading-relaxed italic font-medium">Naturally grown without pesticides, hand-harvested at the peak of ripeness for ultimate flavor.</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Sustainability --}}
    <section class="py-32 px-6 overflow-hidden">
        <div class="container mx-auto grid lg:grid-cols-2 gap-24 items-center">
            <div class="relative">
                <div class="absolute inset-0 bg-lime-500 rounded-[5rem] translate-x-12 translate-y-12 -z-10"></div>
                <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" class="w-full aspect-video object-cover rounded-[5rem] shadow-2xl">
            </div>
            <div>
                <h2 class="text-6xl font-black text-stone-900 uppercase tracking-tighter mb-10 leading-none">Rooted in<br><span class="italic text-lime-500">Innovation.</span></h2>
                <div class="space-y-8">
                    <div class="flex gap-6">
                        <div class="size-12 rounded-2xl bg-lime-100 text-lime-600 flex items-center justify-center shrink-0"><x-heroicon-o-sun class="size-6"/></div>
                        <p class="text-stone-500 text-lg italic leading-relaxed"><b>Smart Irrigation:</b> Optimizing every drop of water through AI-driven moisture sensors and satellite data.</p>
                    </div>
                    <div class="flex gap-6">
                        <div class="size-12 rounded-2xl bg-lime-100 text-lime-600 flex items-center justify-center shrink-0"><x-heroicon-o-sparkles class="size-6"/></div>
                        <p class="text-stone-500 text-lg italic leading-relaxed"><b>Regenerative Soil:</b> Building a living ecosystem in our fields to ensure fertility for generations to come.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-stone-900 text-white">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-12 opacity-50">
            <h2 class="text-3xl font-black tracking-tighter italic uppercase">HARVEST<span class="text-lime-500">STATION.</span></h2>
            <div class="flex flex-wrap justify-center gap-12 text-[10px] font-black uppercase tracking-[0.3em]">
                <a href="#" class="hover:text-lime-500">Produce</a>
                <a href="#" class="hover:text-lime-500">Fields</a>
                <a href="#" class="hover:text-lime-500">Technology</a>
                <a href="#" class="hover:text-lime-500">Contact</a>
            </div>
            <p class="text-[9px] font-black uppercase tracking-widest italic">© {{ date('Y') }} THE HARVEST STATION. PURE BY NATURE.</p>
        </div>
    </footer>
</div>
