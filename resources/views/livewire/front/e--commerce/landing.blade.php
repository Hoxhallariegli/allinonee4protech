<div class="bg-white min-h-screen selection:bg-blue-100 selection:text-blue-900 font-body antialiased">
    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 overflow-hidden bg-zinc-50">
        <div class="container mx-auto px-6 text-center">
            <span class="inline-block px-4 py-2 bg-blue-600 text-white text-[10px] font-black uppercase tracking-[0.4em] mb-10 rounded-full shadow-lg shadow-blue-600/20">
                {{ __('front/e--commerce.welcome_to') }}
            </span>
            <h1 class="text-6xl md:text-[9rem] font-black text-gray-900 tracking-tighter mb-10 leading-[0.8] uppercase">
                @php
                    $titleParts = explode(' ', __('front/e--commerce.elevate_experience'), 2);
                @endphp
                {{ $titleParts[0] }}<br><span class="text-blue-600 italic">{{ $titleParts[1] ?? '' }}</span>
            </h1>
            <p class="text-gray-400 text-xl md:text-2xl max-w-xl mx-auto font-medium leading-relaxed italic mb-16">
                {{ __('front/e--commerce.hero_subtitle') }}
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <button class="px-14 py-6 bg-gray-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-600 transition-all shadow-2xl">
                    {{ __('front/e--commerce.book_now') }}
                </button>
            </div>
        </div>
    </section>

    {{-- Products Grid --}}
    <section class="py-32 px-6">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-24">
                <h2 class="text-6xl font-black text-gray-900 uppercase tracking-tighter italic leading-none">
                    @php
                        $curParts = explode(' ', __('front/e--commerce.our_services'), 2);
                    @endphp
                    {{ $curParts[0] }}<br><span class="text-blue-600">{{ $curParts[1] ?? '' }}.</span>
                </h2>
                <div class="h-px flex-1 bg-gray-100 hidden lg:block mb-8 mx-12"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16">
                @forelse($products as $product)
                    <div class="group">
                        <div class="relative aspect-square bg-gray-50 rounded-[3rem] overflow-hidden mb-8 border border-gray-100 group-hover:border-blue-100 transition-all duration-700 shadow-sm hover:shadow-2xl">
                            @if($product->photo)
                                <img src="{{ asset('uploads/'.$product->photo) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-7xl font-black text-gray-200 italic bg-gray-50 group-hover:text-blue-100 transition-colors">
                                    {{ substr($product->name, 0, 1) }}
                                </div>
                            @endif
                            <button class="absolute bottom-8 right-8 size-16 rounded-[1.5rem] bg-white text-gray-900 flex items-center justify-center shadow-2xl opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-blue-600 hover:text-white">
                                <x-heroicon-o-shopping-bag class="size-7"/>
                            </button>
                        </div>
                        <div class="px-2 text-left">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-2xl font-black uppercase tracking-tight text-gray-900 group-hover:text-blue-600 transition-colors">{{ $product->name }}</h3>
                                <span class="text-blue-600 font-black text-xl italic">L{{ number_format($product->price ?? 0, 0) }}</span>
                            </div>
                            <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">{{ $product->category->name ?? 'Premium Essentials' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-24 text-center">
                        <p class="text-gray-300 italic text-2xl">Inventory is currently being curated for the next season.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-gray-950 text-white italic">
        <div class="container mx-auto px-6 text-center opacity-30">
            <h2 class="text-4xl font-black tracking-tighter mb-16 uppercase italic">STATION<span class="text-blue-600">SHOP.</span></h2>
            <div class="flex flex-wrap justify-center gap-12 text-[10px] font-black uppercase tracking-[0.3em] mb-20">
                <a href="#" class="hover:text-blue-600">Privacy</a>
                <a href="#" class="hover:text-blue-600">Terms</a>
                <a href="#" class="hover:text-blue-600">Help</a>
                <a href="#" class="hover:text-blue-600">Contact</a>
            </div>
            <p class="text-[9px] font-black uppercase tracking-widest italic">© {{ date('Y') }} THE STATION SHOP. RETAIL REDEFINED.</p>
        </div>
    </footer>
</div>
