<div class="bg-slate-50 min-h-screen selection:bg-indigo-100 selection:text-indigo-900 font-body antialiased">
    {{-- Hero Section --}}
    <section class="relative h-[90vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0 bg-slate-900">
            <img src="https://images.unsplash.com/photo-1600585154340-be6199f7d009?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover opacity-60">
        </div>

        <div class="container mx-auto px-6 relative z-20">
            <div class="max-w-3xl text-left">
                <span class="inline-block px-4 py-2 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-[0.4em] mb-8 rounded-lg shadow-xl shadow-indigo-600/20">
                    {{ __('front/real-estate-c-r-m.welcome_to') }}
                </span>
                <h1 class="text-6xl md:text-8xl font-black text-white tracking-tighter mb-8 leading-[0.85] uppercase">
                    @php
                        $titleParts = explode(' ', __('front/real-estate-c-r-m.elevate_experience'), 2);
                    @endphp
                    {{ $titleParts[0] }} {{ $titleParts[1] ?? '' }}<br><span class="text-indigo-400 italic underline decoration-8 decoration-indigo-400/20 underline-offset-8">Dream Home.</span>
                </h1>
                <p class="text-white/80 text-xl md:text-2xl max-w-xl mb-12 font-medium leading-relaxed italic">
                    {{ __('front/real-estate-c-r-m.hero_subtitle') }}
                </p>

                {{-- Search Bar --}}
                <div class="p-2 bg-white/10 backdrop-blur-md rounded-3xl flex flex-col md:flex-row gap-2 max-w-2xl border border-white/10">
                    <input type="text" wire:model.live="search" placeholder="Search by area or title..." class="flex-1 px-8 py-5 rounded-2xl bg-white border-none focus:ring-2 focus:ring-indigo-500 text-slate-900 font-bold placeholder-slate-400">
                    <button class="px-10 py-5 bg-indigo-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl">{{ __('front/real-estate-c-r-m.book_now') }}</button>
                </div>
            </div>
        </div>
    </section>

    {{-- Properties Grid --}}
    <section class="py-32 px-6">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-24">
                <div class="text-left">
                    <span class="text-indigo-600 font-bold text-xs uppercase tracking-[0.3em]">{{ __('front/real-estate-c-r-m.services_subtitle') }}</span>
                    <h2 class="text-6xl font-black text-slate-900 mt-6 uppercase tracking-tighter leading-none">
                        @php
                            $featParts = explode(' ', __('front/real-estate-c-r-m.our_services'), 2);
                        @endphp
                        {{ $featParts[0] }}<br>{{ $featParts[1] ?? '' }}.
                    </h2>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button wire:click="$set('selectedType', null)" class="px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ is_null($selectedType) ? 'bg-indigo-600 text-white shadow-xl' : 'bg-white text-slate-400 border border-slate-200' }}">All</button>
                    @foreach(['apartment', 'house', 'land'] as $type)
                        <button wire:click="$set('selectedType', '{{ $type }}')" class="px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all {{ $selectedType == $type ? 'bg-indigo-600 text-white shadow-xl' : 'bg-white text-slate-400 border border-slate-200' }}">
                            {{ ucfirst($type) }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($properties as $prop)
                    <div class="group bg-white rounded-[3rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-700 flex flex-col">
                        <div class="relative h-80 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute top-8 right-8">
                                <span class="px-4 py-2 bg-white/90 backdrop-blur-md rounded-2xl text-[10px] font-black uppercase text-indigo-600 shadow-xl tracking-widest">
                                    {{ strtoupper($prop->listing_type ?? 'Sale') }}
                                </span>
                            </div>
                        </div>
                        <div class="p-12 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-6">
                                <h3 class="text-3xl font-black text-slate-900 group-hover:text-indigo-600 transition-colors uppercase tracking-tight">{{ $prop->title }}</h3>
                            </div>
                            <p class="text-slate-400 text-lg mb-10 line-clamp-2 italic font-medium">Premium real estate located in the heart of the city, featuring contemporary architecture and elite finishing.</p>

                            <div class="mt-auto flex items-center justify-between pt-8 border-t border-slate-50">
                                <span class="text-3xl font-black text-slate-900 italic">€{{ number_format($prop->price ?? 0, 0) }}</span>
                                <button class="size-14 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all shadow-lg">
                                    <x-heroicon-o-arrow-right class="size-6"/>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-24 text-center">
                        <div class="size-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <x-heroicon-o-home-modern class="size-10 text-slate-300"/>
                        </div>
                        <p class="text-slate-400 font-serif italic text-xl">No properties matching your criteria at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Agents Section --}}
    <section class="py-32 bg-slate-900 text-white overflow-hidden relative">
        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_bottom_left,_rgba(79,70,229,0.3),transparent)]"></div>
        <div class="container mx-auto px-6 relative z-10 text-center md:text-left">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-24">
                <h2 class="text-6xl font-black uppercase tracking-tighter italic leading-none">Elite<br><span class="text-indigo-500">Advisors.</span></h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                @foreach($agents as $agent)
                    <div class="group text-center">
                        <div class="relative size-60 mx-auto mb-10">
                             <div class="absolute inset-0 bg-indigo-600 rounded-[3.5rem] rotate-6 group-hover:rotate-0 transition-transform duration-500 shadow-2xl shadow-indigo-600/20"></div>
                             <div class="absolute inset-0 bg-slate-800 rounded-[3.5rem] overflow-hidden border border-slate-700">
                                @if($agent->photo)
                                    <img src="{{ asset('uploads/'.$agent->photo) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-7xl font-black text-slate-700 italic bg-slate-800">
                                        {{ substr($agent->name, 0, 1) }}
                                    </div>
                                @endif
                             </div>
                        </div>
                        <h3 class="text-2xl font-bold uppercase tracking-tight">{{ $agent->name }}</h3>
                        <p class="text-indigo-400 text-[10px] font-black uppercase tracking-[0.2em] mt-3 italic">Consultant</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-white border-t border-slate-100 italic">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-12">
                <h2 class="text-4xl font-black text-slate-900 tracking-tighter">ELITE<span class="text-indigo-600">ESTATES.</span></h2>
                <div class="flex gap-12 text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">
                    <a href="#" class="hover:text-indigo-600">Portfolio</a>
                    <a href="#" class="hover:text-indigo-600">Our Story</a>
                    <a href="#" class="hover:text-indigo-600">Contact</a>
                </div>
            </div>
            <div class="mt-20 pt-10 border-t border-slate-50 text-[9px] font-black uppercase tracking-widest text-slate-300 text-center">
                © {{ date('Y') }} ELITE ESTATES TIRANA. PRESTIGE IN EVERY BRICK.
            </div>
        </div>
    </footer>
</div>
