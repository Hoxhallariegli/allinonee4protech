<div class="bg-gray-50 min-h-screen selection:bg-orange-100 selection:text-orange-900">
    {{-- Hero Section --}}
    <section class="relative h-[85vh] flex items-center overflow-hidden bg-gray-900">
        <div class="absolute inset-0 z-0 opacity-60">
            <img src="https://images.unsplash.com/photo-1486006396123-c775170aa562?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover scale-110">
        </div>

        <div class="container mx-auto px-6 relative z-20 text-center md:text-left">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-3 px-3 py-1 bg-orange-600 text-white rounded-lg text-[10px] font-black uppercase tracking-[0.3em] mb-8">
                    {{ __('front/auto-repair-management.welcome_to') }}
                </div>
                <h1 class="text-6xl md:text-8xl font-black text-white tracking-tighter mb-8 leading-[0.9]">
                    @php
                        $titleParts = explode(' ', __('front/auto-repair-management.elevate_experience'), 2);
                    @endphp
                    {{ $titleParts[0] }}<br><span class="text-orange-500">{{ $titleParts[1] ?? '' }}</span>
                </h1>
                <p class="text-white/80 text-lg md:text-xl max-w-xl mb-12 font-medium leading-relaxed italic">
                    {{ __('front/auto-repair-management.hero_subtitle') }}
                </p>
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <button class="w-full sm:w-auto px-12 py-5 bg-orange-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-orange-700 transition-all shadow-xl shadow-orange-600/20">
                        {{ __('front/auto-repair-management.book_now') }}
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Services Section --}}
    <section class="py-32 px-6 bg-white">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-20">
                <div class="max-w-2xl">
                    <span class="text-orange-600 font-bold text-xs uppercase tracking-[0.3em]">{{ __('front/auto-repair-management.our_services') }}</span>
                    <h2 class="text-5xl font-black text-gray-900 mt-4 uppercase tracking-tighter">{{ __('front/auto-repair-management.our_services') }}.</h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                    <div class="group bg-gray-50 p-10 rounded-[3rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                            <x-heroicon-o-wrench-screwdriver class="size-24 text-orange-600"/>
                        </div>
                        <div class="relative z-10">
                            <div class="size-16 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center mb-10 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                                <x-heroicon-o-check-badge class="size-8"/>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900 mb-4 uppercase leading-none">{{ $service->name }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed mb-10 line-clamp-3 italic">
                                {{ $service->description ?? 'Complete vehicle diagnostic and repair service using state-of-the-art computer systems and professional tools.' }}
                            </p>
                            <div class="flex items-center justify-between pt-6 border-t border-gray-200/50">
                                <span class="text-2xl font-black text-orange-600">L{{ number_format($service->price, 0) }}</span>
                                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Professional Grade</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <p class="text-gray-400 italic text-xl">Our specialized services catalog is being updated.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Mechanics Section --}}
    <section class="py-32 bg-gray-900 text-white relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-24">
                <h2 class="text-5xl font-black uppercase tracking-tighter leading-none mb-4">{{ __('front/auto-repair-management.meet_team') }}</h2>
                <div class="h-1.5 w-20 bg-orange-600 mx-auto rounded-full"></div>
                <p class="text-gray-400 mt-6 text-lg">{{ __('front/auto-repair-management.team_subtitle') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                @foreach($mechanics as $mechanic)
                    <div class="group text-center">
                        <div class="relative size-56 mx-auto mb-10">
                            <div class="absolute inset-0 bg-orange-600 rounded-[3rem] rotate-6 group-hover:rotate-0 transition-transform duration-500"></div>
                            <div class="absolute inset-0 bg-gray-800 rounded-[3rem] overflow-hidden border border-gray-700 shadow-2xl">
                                @if($mechanic->employee?->photo)
                                    <img src="{{ asset('uploads/'.$mechanic->employee->photo) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-5xl font-black text-gray-700 bg-gray-800 italic">
                                        {{ substr($mechanic->employee?->name ?? 'M', 0, 1) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold uppercase tracking-tight">{{ $mechanic->employee?->name ?? 'John Doe' }}</h3>
                        <p class="text-orange-500 text-[10px] font-black uppercase tracking-widest mt-2">{{ $mechanic->specialization ?? 'Master Tech' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-white border-t border-gray-100">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-12">
                <h2 class="text-3xl font-black text-gray-900 tracking-tighter">AUTO<span class="text-orange-600">STATION.</span></h2>
                <div class="flex gap-12 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">
                    <a href="#" class="hover:text-orange-600 transition-colors">Services</a>
                    <a href="#" class="hover:text-orange-600 transition-colors">Our Team</a>
                    <a href="#" class="hover:text-orange-600 transition-colors">Location</a>
                </div>
            </div>
            <div class="mt-20 pt-8 border-t border-gray-50 flex justify-between items-center text-[9px] font-black uppercase tracking-widest text-gray-400">
                <p>&copy; {{ date('Y') }} THE AUTO STATION TIRANA.</p>
                <p>Engineering Excellence</p>
            </div>
        </div>
    </footer>
</div>
