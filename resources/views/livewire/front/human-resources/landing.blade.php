<div class="bg-white min-h-screen selection:bg-indigo-100 selection:text-indigo-900">
    {{-- Hero Section --}}
    <section class="relative pt-32 pb-32 overflow-hidden bg-slate-50">
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <span class="inline-block px-4 py-2 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-[0.4em] mb-10 rounded-lg">
                    {{ __('front/human-resources.welcome_to') }}
                </span>
                <h1 class="text-6xl md:text-8xl font-black text-gray-900 tracking-tighter mb-10 leading-[0.9]">
                    @php
                        $titleParts = explode(' ', __('front/human-resources.elevate_experience'), 2);
                    @endphp
                    {{ $titleParts[0] }}<br><span class="text-indigo-600">{{ $titleParts[1] ?? '' }}</span>
                </h1>
                <p class="text-gray-500 text-xl md:text-2xl max-w-xl mb-12 font-medium leading-relaxed italic">
                    {{ __('front/human-resources.hero_subtitle') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-6">
                    <button class="px-12 py-5 bg-gray-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-2xl shadow-indigo-100">
                        {{ __('front/human-resources.book_now') }}
                    </button>
                </div>
            </div>
        </div>
        {{-- Abstract Shapes --}}
        <div class="absolute top-0 right-0 w-1/2 h-full opacity-10 pointer-events-none">
            <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" class="w-full h-full fill-indigo-600">
                <path d="M422,316Q393,382,323,419Q253,456,183,419Q113,382,84,316Q55,250,84,184Q113,118,183,81Q253,44,323,81Q393,118,422,184Q451,250,422,316Z" />
            </svg>
        </div>
    </section>

    {{-- Departments Section --}}
    <section class="py-32 px-6">
        <div class="container mx-auto">
            <div class="text-center mb-24">
                <h2 class="text-5xl font-black text-gray-900 uppercase tracking-tighter">{{ __('front/human-resources.our_services') }}</h2>
                <p class="text-gray-500 mt-4 text-lg italic">{{ __('front/human-resources.services_subtitle') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($departments as $dept)
                    <div class="group p-10 bg-white rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500">
                        <div class="size-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-8 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <x-heroicon-o-building-office class="size-8"/>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 mb-4">{{ $dept->name }}</h3>
                        <p class="text-gray-400 text-sm font-medium leading-relaxed mb-8 italic">
                            Driving organizational success through strategic management, talent acquisition, and operational excellence.
                        </p>
                        <button class="flex items-center gap-3 text-[10px] font-black uppercase tracking-widest text-indigo-600 group-hover:gap-5 transition-all">
                            Learn More <x-heroicon-o-arrow-right class="size-4"/>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Leadership Section --}}
    <section class="py-32 bg-gray-900 text-white overflow-hidden relative">
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-24">
                <h2 class="text-6xl font-black uppercase tracking-tighter leading-none">
                    @php
                        $visParts = explode(' ', __('front/human-resources.meet_team'), 2);
                    @endphp
                    {{ $visParts[0] }} {{ $visParts[1] ?? '' }}<br><span class="text-indigo-500 italic">Visionaries.</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                @foreach($leadership as $leader)
                    <div class="group text-center">
                        <div class="relative size-60 mx-auto mb-10 rounded-[3rem] overflow-hidden border-2 border-gray-800 group-hover:border-indigo-500 transition-all duration-700">
                            @if($leader->photo)
                                <img src="{{ asset('uploads/'.$leader->photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-800 flex items-center justify-center text-6xl font-black text-gray-700 italic">{{ substr($leader->name, 0, 1) }}</div>
                            @endif
                        </div>
                        <h3 class="text-2xl font-bold uppercase tracking-tight">{{ $leader->name }}</h3>
                        <p class="text-indigo-400 text-xs font-black uppercase tracking-[0.2em] mt-3">Executive Team</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-white border-t border-gray-100">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-black text-gray-900 tracking-tighter italic mb-16 uppercase">HR<span class="text-indigo-600">STATION.</span></h2>
            <div class="flex flex-wrap justify-center gap-12 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 mb-20">
                <a href="#" class="hover:text-indigo-600">Careers</a>
                <a href="#" class="hover:text-indigo-600">Values</a>
                <a href="#" class="hover:text-indigo-600">Events</a>
                <a href="#" class="hover:text-indigo-600">Contact</a>
            </div>
            <p class="text-[9px] font-black uppercase tracking-widest text-gray-400">© {{ date('Y') }} HR STATION. GROW TOGETHER.</p>
        </div>
    </footer>
</div>
