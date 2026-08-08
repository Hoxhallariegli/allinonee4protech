<div class="bg-white selection:bg-rose-100 selection:text-rose-900">
    @php $trans = 'front/clinic-management'; @endphp

    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-[radial-gradient(circle_at_top,_rgba(244,63,94,0.07),via-white,to-transparent)] -z-10"></div>
        <div class="container mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-rose-50 text-rose-600 rounded-full text-xs font-black uppercase tracking-widest mb-8">
                <span class="size-2 rounded-full bg-rose-600 animate-pulse"></span>
                {{ __('front/clinic-management.welcome_to') }}
            </div>
            <h1 class="text-6xl md:text-8xl font-black text-gray-900 tracking-tighter mb-8 leading-[0.9]">
                @php
                    $titleParts = explode(' ', __('front/clinic-management.elevate_experience'), 3);
                    $lastWord = array_pop($titleParts);
                @endphp
                {{ implode(' ', $titleParts) }}<br><span class="text-rose-600">{{ $lastWord }}</span>
            </h1>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto mb-12 leading-relaxed">
                {{ __('front/clinic-management.hero_subtitle') }}
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <button class="px-10 py-5 bg-gray-900 text-white rounded-[2rem] font-bold text-lg hover:bg-rose-600 hover:shadow-2xl hover:shadow-rose-200 transition-all duration-300">{{ __('front/clinic-management.book_now') }}</button>
                <button class="px-10 py-5 bg-white text-gray-900 border border-gray-100 rounded-[2rem] font-bold text-lg hover:border-gray-300 transition-all">{{ __('front/clinic-management.emergency_contact') }}</button>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-6">
        {{-- Doctors Section --}}
        <section class="py-24 border-t border-gray-100">
            <div class="text-center mb-20">
                <span class="text-rose-600 font-bold text-xs uppercase tracking-widest">{{ __('front/clinic-management.meet_team') }}</span>
                <h2 class="text-5xl font-black text-gray-900 mt-4 uppercase tracking-tighter">{{ __('front/clinic-management.meet_team') }}</h2>
                <div class="h-1.5 w-20 bg-rose-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($doctors as $item)
                    <div class="group text-center">
                        <div class="relative size-64 mx-auto mb-8 rounded-[3.5rem] overflow-hidden shadow-2xl group-hover:scale-105 transition-transform duration-500">
                            @if($item->photo)
                                <img src="{{ asset('uploads/'.$item->photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-rose-50 flex items-center justify-center text-7xl font-black text-rose-200">
                                    {{ substr($item->name, 0, 1) }}
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-rose-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <h3 class="text-3xl font-black text-gray-900 mb-2">{{ $item->name }}</h3>
                        <p class="text-rose-600 font-bold text-xs uppercase tracking-[0.2em]">{{ $item->specialization ?? 'General Practitioner' }}</p>
                        <div class="mt-6 flex justify-center gap-4 opacity-0 group-hover:opacity-100 transition-all transform translate-y-4 group-hover:translate-y-0">
                            <span class="text-xs font-bold text-gray-400">View Bio</span>
                            <span class="text-xs font-bold text-gray-400">•</span>
                            <span class="text-xs font-bold text-gray-400">Book Appointment</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Stats Section --}}
        <section class="py-20 bg-rose-600 rounded-[3rem] my-20 text-white overflow-hidden relative">
            <div class="absolute top-0 right-0 size-96 bg-white/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center relative z-10">
                <div>
                    <p class="text-6xl font-black mb-2">15k+</p>
                    <p class="text-rose-100 font-bold uppercase tracking-widest text-xs">Happy Patients</p>
                </div>
                <div>
                    <p class="text-6xl font-black mb-2">{{ $doctors->count() }}</p>
                    <p class="text-rose-100 font-bold uppercase tracking-widest text-xs">Specialist Doctors</p>
                </div>
                <div>
                    <p class="text-6xl font-black mb-2">24/7</p>
                    <p class="text-rose-100 font-bold uppercase tracking-widest text-xs">Medical Support</p>
                </div>
            </div>
        </section>
    </div>

    {{-- Footer --}}
    <footer class="py-20 bg-gray-900 text-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 pb-16 border-b border-white/10">
                <div class="col-span-2">
                    <h2 class="text-3xl font-black mb-6">{{ __('front/clinic-management.title') }}</h2>
                    <p class="text-gray-400 max-w-sm text-lg italic font-serif leading-relaxed">
                        "{{ __('front/clinic-management.services_subtitle') }}"
                    </p>
                </div>
                <div>
                    <h4 class="font-bold uppercase tracking-widest text-xs text-rose-600 mb-8">Navigation</h4>
                    <ul class="space-y-4 text-gray-300 font-bold text-sm">
                        <li><a href="#" class="hover:text-rose-500 transition-colors">Our Doctors</a></li>
                        <li><a href="#" class="hover:text-rose-500 transition-colors">Medical Services</a></li>
                        <li><a href="#" class="hover:text-rose-500 transition-colors">Appointment</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold uppercase tracking-widest text-xs text-rose-600 mb-8">Location</h4>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        Medical District, Street 45<br>Tirana, Albania<br>
                        <span class="text-white mt-4 block">+355 6X XXX XXXX</span>
                    </p>
                </div>
            </div>
            <div class="pt-8 flex justify-between items-center text-xs font-bold text-gray-500 uppercase tracking-[0.2em]">
                <p>&copy; {{ date('Y') }} CLINIC CENTRAL.</p>
                <p>Designed for Excellence</p>
            </div>
        </div>
    </footer>
</div>
