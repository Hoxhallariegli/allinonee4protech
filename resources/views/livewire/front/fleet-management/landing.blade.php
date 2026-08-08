<div class="bg-slate-50 min-h-screen selection:bg-orange-100 selection:text-orange-900">
    {{-- Hero Section --}}
    <section class="relative h-[80vh] flex items-center overflow-hidden bg-slate-900">
        <div class="absolute inset-0 opacity-40">
            <img src="https://images.unsplash.com/photo-1519003722824-192d992a6058?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover">
        </div>

        <div class="container mx-auto px-6 relative z-20">
            <div class="max-w-3xl">
                <span class="inline-block px-4 py-2 bg-orange-600 text-white text-[10px] font-black uppercase tracking-[0.4em] mb-10 rounded-sm">
                    {{ __('front/fleet-management.welcome_to') }}
                </span>
                <h1 class="text-6xl md:text-9xl font-black text-white tracking-tighter mb-10 leading-[0.8] uppercase">
                    @php
                        $titleParts = explode(' ', __('front/fleet-management.elevate_experience'), 2);
                    @endphp
                    {{ $titleParts[0] }}<br><span class="text-orange-500">{{ $titleParts[1] ?? '' }}</span>
                </h1>
                <p class="text-white/70 text-lg md:text-2xl max-w-xl mb-16 font-medium leading-relaxed italic">
                    {{ __('front/fleet-management.hero_subtitle') }}
                </p>

                {{-- Tracking Widget --}}
                <div class="bg-white/10 backdrop-blur-xl border border-white/10 p-2 rounded-3xl flex flex-col md:flex-row gap-2">
                    <input type="text" wire:model="shipmentId" placeholder="Enter Shipment ID..." class="flex-1 px-8 py-5 bg-transparent border-none focus:ring-0 text-white font-bold placeholder-white/30">
                    <button wire:click="trackShipment" class="px-12 py-5 bg-orange-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-orange-700 transition-all">{{ __('front/fleet-management.book_now') }}</button>
                </div>

                @if($shipmentResult)
                    <div class="mt-6 p-6 bg-white rounded-[2rem] shadow-2xl animate-fade-in">
                        <div class="flex items-center gap-4 text-slate-900">
                            <div class="size-10 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center">
                                <x-heroicon-o-truck class="size-6"/>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status</p>
                                <p class="text-lg font-bold">Shipment #{{ $shipmentResult->id }} - <span class="text-orange-600">IN TRANSIT</span></p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Fleet Section --}}
    <section class="py-32 px-6">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-24">
                <div>
                    <span class="text-orange-600 font-bold text-xs uppercase tracking-[0.3em]">{{ __('front/fleet-management.services_subtitle') }}</span>
                    <h2 class="text-6xl font-black text-slate-900 mt-6 uppercase tracking-tighter leading-none">
                        @php
                            $flParts = explode(' ', __('front/fleet-management.our_services'), 2);
                        @endphp
                        {{ $flParts[0] }}<br>{{ $flParts[1] ?? '' }}.
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($vehicles as $vehicle)
                    <div class="group bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500">
                        <div class="relative h-64 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1586191582056-94033be153e9?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute top-6 left-6 px-4 py-2 bg-slate-900/80 backdrop-blur-md rounded-xl text-white text-[9px] font-black uppercase tracking-widest">
                                {{ $vehicle->type ?? 'Heavy Truck' }}
                            </div>
                        </div>
                        <div class="p-10">
                            <h3 class="text-2xl font-black text-slate-900 mb-4 uppercase">{{ $vehicle->license_plate ?? 'ABC-1234' }}</h3>
                            <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                                <span class="text-xs font-black text-slate-300 uppercase tracking-widest">Capacity: 24 Tons</span>
                                <x-heroicon-o-check-circle class="size-5 text-emerald-500"/>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="py-24 bg-orange-600 text-white rounded-[4rem] mx-6 mb-32 overflow-hidden relative shadow-2xl shadow-orange-200">
        <div class="container mx-auto px-10 grid grid-cols-1 md:grid-cols-3 gap-12 text-center relative z-10 font-black italic">
            <div>
                <p class="text-7xl mb-2">2.5M</p>
                <p class="text-orange-100 uppercase tracking-[0.3em] text-[10px]">KM Driven</p>
            </div>
            <div>
                <p class="text-7xl mb-2">120</p>
                <p class="text-orange-100 uppercase tracking-[0.3em] text-[10px]">Certified Vehicles</p>
            </div>
            <div>
                <p class="text-7xl mb-2">99%</p>
                <p class="text-orange-100 uppercase tracking-[0.3em] text-[10px]">On-Time Delivery</p>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-slate-900 text-white">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-12 opacity-50">
            <h2 class="text-3xl font-black tracking-tighter italic uppercase">FLEET<span class="text-orange-500">STATION.</span></h2>
            <div class="flex flex-wrap justify-center gap-12 text-[10px] font-black uppercase tracking-[0.3em]">
                <a href="#" class="hover:text-orange-500">Services</a>
                <a href="#" class="hover:text-orange-500">Tracking</a>
                <a href="#" class="hover:text-orange-500">Hiring</a>
                <a href="#" class="hover:text-orange-500">Contact</a>
            </div>
            <p class="text-[9px] font-black uppercase tracking-widest italic">© {{ date('Y') }} GLOBAL FLEET SOLUTIONS.</p>
        </div>
    </footer>
</div>
