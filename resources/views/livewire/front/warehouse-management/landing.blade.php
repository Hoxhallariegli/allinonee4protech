<div class="bg-zinc-50 min-h-screen selection:bg-zinc-200 selection:text-zinc-900">
    {{-- Hero Section --}}
    <section class="relative pt-40 pb-32 overflow-hidden bg-white">
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="inline-block px-4 py-2 bg-zinc-900 text-white text-[10px] font-black uppercase tracking-[0.4em] mb-12 rounded-full">
                {{ __('front/warehouse-management.welcome_to') }}
            </span>
            <h1 class="text-7xl md:text-[9rem] font-black text-zinc-900 tracking-tighter mb-12 leading-[0.8] uppercase">
                @php
                    $titleParts = explode(' ', __('front/warehouse-management.elevate_experience'), 2);
                @endphp
                {{ $titleParts[0] }}<br><span class="text-zinc-400 italic">{{ $titleParts[1] ?? '' }}</span>
            </h1>
            <p class="text-zinc-400 text-xl md:text-2xl max-w-xl mx-auto font-medium leading-relaxed italic mb-16">
                {{ __('front/warehouse-management.hero_subtitle') }}
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-10">
                <button class="px-14 py-6 bg-zinc-900 text-white rounded-full font-black text-xs uppercase tracking-widest hover:bg-zinc-700 transition-all shadow-2xl shadow-zinc-200">
                    {{ __('front/warehouse-management.book_now') }}
                </button>
                <div class="flex items-center gap-4 text-xs font-black uppercase tracking-widest text-zinc-400">
                    <x-heroicon-o-shield-check class="size-6 text-zinc-900"/> Secure & Automated
                </div>
            </div>
        </div>
        {{-- Absolute background line --}}
        <div class="absolute top-1/2 left-0 w-full h-px bg-zinc-100 -z-10"></div>
    </section>

    {{-- Warehouses Section --}}
    <section class="py-32 px-6">
        <div class="container mx-auto">
            <div class="text-center mb-24">
                <h2 class="text-6xl font-black text-zinc-900 uppercase tracking-tighter leading-none italic mb-4">
                    @php
                        $hubParts = explode(' ', __('front/warehouse-management.our_services'), 2);
                    @endphp
                    {{ $hubParts[0] }}<br><span class="text-zinc-300">{{ $hubParts[1] ?? '' }}.</span>
                </h2>
                <div class="h-1 w-20 bg-zinc-900 mx-auto rounded-full mt-8"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($warehouses as $wh)
                    <div class="group bg-white p-12 rounded-[3.5rem] border border-zinc-100 hover:shadow-2xl transition-all duration-700">
                        <div class="size-16 rounded-2xl bg-zinc-50 text-zinc-900 flex items-center justify-center mb-10 group-hover:bg-zinc-900 group-hover:text-white transition-all">
                            <x-heroicon-o-building-office-2 class="size-8"/>
                        </div>
                        <h3 class="text-3xl font-black text-zinc-900 mb-4 uppercase tracking-tighter">{{ $wh->name }}</h3>
                        <p class="text-zinc-400 text-sm leading-relaxed mb-10 italic">Premium logistics facility featuring automated sorting, climate control, and real-time inventory tracking.</p>
                        <div class="flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-zinc-300 italic">
                            <span class="size-2 rounded-full bg-emerald-500"></span> Fully Operational
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Product Highlights --}}
    <section class="py-32 bg-zinc-900 text-white rounded-t-[5rem]">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-24">
                <h2 class="text-6xl font-black uppercase tracking-tighter leading-none italic">
                    @php
                        $invParts = explode(' ', __('front/warehouse-management.meet_team'), 2);
                    @endphp
                    {{ $invParts[0] }}<br><span class="text-zinc-600">{{ $invParts[1] ?? '' }}.</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div class="group relative aspect-square overflow-hidden rounded-[3rem] bg-zinc-800 border border-zinc-700/50 p-10 flex flex-col justify-between">
                        <div class="relative z-10">
                            <h3 class="text-2xl font-black italic tracking-tighter uppercase leading-none mb-2">{{ $product->name }}</h3>
                            <p class="text-zinc-500 text-[10px] font-black uppercase tracking-widest">{{ $product->category->name ?? 'Category A' }}</p>
                        </div>

                        <div class="relative z-10 flex items-end justify-between">
                            <span class="text-4xl font-black italic text-zinc-600 group-hover:text-white transition-colors">#{{ $product->stock ?? 0 }}</span>
                            <div class="size-12 rounded-2xl border border-zinc-700 flex items-center justify-center group-hover:bg-white group-hover:text-zinc-900 transition-all">
                                <x-heroicon-o-cube class="size-5"/>
                            </div>
                        </div>

                        {{-- Background icon --}}
                        <x-heroicon-o-cube class="absolute -right-10 -bottom-10 size-48 text-zinc-700/10 group-hover:text-zinc-700/20 transition-all duration-700"/>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-zinc-900 border-t border-zinc-800 text-white">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-12 opacity-20 italic">
            <h2 class="text-3xl font-black tracking-tighter uppercase">STOCK<span class="text-zinc-500">FLOW.</span></h2>
            <div class="flex flex-wrap justify-center gap-12 text-[10px] font-black uppercase tracking-[0.3em]">
                <a href="#">Network</a>
                <a href="#">Compliance</a>
                <a href="#">Security</a>
                <a href="#">Contact</a>
            </div>
            <p class="text-[9px] font-black uppercase tracking-widest">© {{ date('Y') }} GLOBAL WAREHOUSE GROUP.</p>
        </div>
    </footer>
</div>
