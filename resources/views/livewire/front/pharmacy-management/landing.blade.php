<div class="bg-white min-h-screen selection:bg-teal-100 selection:text-teal-900 font-body antialiased">
    {{-- Hero Section --}}
    <section class="relative pt-40 pb-32 overflow-hidden bg-teal-50/20">
        <div class="container mx-auto px-6 relative z-10 text-center md:text-left">
            <div class="max-w-3xl">
                <span class="inline-block px-4 py-2 bg-teal-600 text-white text-[10px] font-black uppercase tracking-[0.4em] mb-10 rounded-lg shadow-xl shadow-teal-600/20">
                    {{ __('front/pharmacy-management.welcome_to') }}
                </span>
                <h1 class="text-6xl md:text-8xl font-black text-gray-900 tracking-tighter mb-10 leading-[0.9]">
                    @php
                        $titleParts = explode(' ', __('front/pharmacy-management.elevate_experience'), 2);
                    @endphp
                    {{ $titleParts[0] }}<br><span class="text-teal-600 italic">{{ $titleParts[1] ?? '' }}</span>
                </h1>
                <p class="text-gray-500 text-xl md:text-2xl max-w-xl mb-12 font-medium leading-relaxed italic">
                    {{ __('front/pharmacy-management.hero_subtitle') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-6">
                    <button class="px-12 py-5 bg-teal-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-teal-700 transition-all shadow-xl">
                        {{ __('front/pharmacy-management.book_now') }}
                    </button>
                </div>
            </div>
        </div>
        {{-- Floating Shapes --}}
        <div class="absolute top-0 right-0 size-[800px] bg-teal-600/5 rounded-full -mr-96 -mt-96 opacity-50 blur-3xl -z-10"></div>
    </section>

    {{-- Medicines Grid --}}
    <section class="py-32 px-6">
        <div class="container mx-auto">
            <div class="flex items-center justify-between gap-12 mb-24">
                <h2 class="text-5xl font-black text-gray-900 uppercase tracking-tighter italic leading-none">
                    @php
                        $essParts = explode(' ', __('front/pharmacy-management.our_services'), 2);
                    @endphp
                    {{ $essParts[0] }}<br><span class="text-teal-600">{{ $essParts[1] ?? '' }}.</span>
                </h2>
                <div class="h-px flex-1 bg-teal-50 hidden md:block mx-12"></div>
                <a href="#" class="text-[10px] font-black uppercase tracking-widest text-teal-600 hover:text-teal-700 transition-colors">{{ __('front/pharmacy-management.services_subtitle') }}</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                @forelse($medicines as $item)
                    <div class="group bg-white p-10 rounded-[3rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 text-center">
                        <div class="size-24 mx-auto rounded-[2rem] bg-teal-50 text-teal-600 flex items-center justify-center mb-10 group-hover:bg-teal-600 group-hover:text-white transition-all transform group-hover:rotate-6 shadow-sm">
                            <x-heroicon-o-beaker class="size-12"/>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 mb-2 uppercase tracking-tight">{{ $item->name }}</h3>
                        <p class="text-teal-600 text-[10px] font-black uppercase tracking-widest mb-8 italic">Available</p>
                        <div class="flex flex-col gap-3">
                            <span class="text-2xl font-black text-gray-900 italic">L{{ number_format($item->price ?? 0, 0) }}</span>
                            <button class="w-full py-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-teal-600 transition-all">Quick Purchase</button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-24 text-center">
                        <p class="text-gray-300 italic text-2xl">Our online pharmacy inventory is currently being synchronized.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-gray-950 text-white italic">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-12 text-center md:text-left opacity-30">
            <div>
                <h2 class="text-3xl font-black tracking-tighter mb-4 uppercase italic leading-none text-white">VITAL<span class="text-teal-500">PHARMACY.</span></h2>
                <p class="text-gray-500 text-[9px] font-bold uppercase tracking-[0.3em]">Open 24/7 • Professional Healthcare</p>
            </div>
            <div class="flex gap-12 text-[10px] font-black uppercase tracking-[0.3em]">
                <a href="#" class="hover:text-teal-500 transition-colors">Advice</a>
                <a href="#" class="hover:text-teal-500 transition-colors">Emergency</a>
                <a href="#" class="hover:text-teal-500 transition-colors">Contact</a>
            </div>
            <p class="text-[9px] font-black uppercase tracking-widest">© {{ date('Y') }} THE VITAL PHARMACY STATION. TIRANA.</p>
        </div>
    </footer>
</div>
