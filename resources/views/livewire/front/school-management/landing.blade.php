<div class="bg-white min-h-screen selection:bg-sky-100 selection:text-sky-900">
    {{-- Hero Section --}}
    <section class="relative pt-32 pb-32 overflow-hidden bg-sky-50/50">
        <div class="container mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center relative z-10">
            <div>
                <span class="inline-block px-4 py-2 bg-sky-100 text-sky-600 text-[10px] font-black uppercase tracking-[0.4em] mb-10 rounded-lg">
                    {{ __('front/school-management.welcome_to') }}
                </span>
                <h1 class="text-6xl md:text-8xl font-black text-gray-900 tracking-tighter mb-10 leading-[0.9]">
                    @php
                        $titleParts = explode(' ', __('front/school-management.elevate_experience'), 2);
                    @endphp
                    {{ $titleParts[0] }}<br><span class="text-sky-600 underline decoration-8 decoration-sky-600/10 underline-offset-8">{{ $titleParts[1] ?? '' }}</span>
                </h1>
                <p class="text-gray-500 text-xl md:text-2xl max-w-xl mb-12 font-medium leading-relaxed italic">
                    {{ __('front/school-management.hero_subtitle') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-6">
                    <button class="px-12 py-5 bg-gray-900 text-white rounded-full font-black text-xs uppercase tracking-widest hover:bg-sky-600 transition-all shadow-2xl shadow-sky-100">
                        {{ __('front/school-management.book_now') }}
                    </button>
                </div>
            </div>
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-sky-600 rounded-[4rem] rotate-6 opacity-10"></div>
                <div class="relative aspect-[4/5] bg-white rounded-[4rem] overflow-hidden border-8 border-white shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1523050335102-c3251f17b384?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- Subjects Section --}}
    <section class="py-32 px-6">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-12 mb-24">
                <div class="max-w-2xl">
                    <span class="text-sky-600 font-bold text-xs uppercase tracking-[0.3em]">{{ __('front/school-management.services_subtitle') }}</span>
                    <h2 class="text-6xl font-black text-gray-900 mt-6 uppercase tracking-tighter leading-none">
                        @php
                            $subjParts = explode(' ', __('front/school-management.our_services'), 2);
                        @endphp
                        {{ $subjParts[0] }}<br>{{ $subjParts[1] ?? '' }}.
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($subjects as $subject)
                    <div class="group p-10 bg-white rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex items-center gap-6">
                        <div class="size-16 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:bg-sky-600 group-hover:text-white transition-colors shrink-0">
                            <x-heroicon-o-book-open class="size-8"/>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tight">{{ $subject->name }}</h3>
                            <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mt-1">CODE: {{ $subject->code ?? 'ACA-101' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Faculty Section --}}
    <section class="py-32 bg-gray-900 text-white relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-24">
                <h2 class="text-6xl font-black uppercase tracking-tighter leading-none italic mb-4">
                    @php
                        $facParts = explode(' ', __('front/school-management.meet_team'), 2);
                    @endphp
                    {{ $facParts[0] }}<br><span class="text-sky-500">{{ $facParts[1] ?? '' }}.</span>
                </h2>
                <p class="text-gray-400 text-lg italic max-w-xl mx-auto">{{ __('front/school-management.team_subtitle') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                @foreach($teachers as $teacher)
                    <div class="group text-center">
                        <div class="relative size-60 mx-auto mb-10 rounded-full overflow-hidden p-2 border-2 border-dashed border-gray-700 group-hover:border-sky-500 transition-all duration-700">
                            <div class="w-full h-full rounded-full overflow-hidden grayscale group-hover:grayscale-0 transition-all duration-700">
                                @if($teacher->photo)
                                    <img src="{{ asset('uploads/'.$teacher->photo) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-800 flex items-center justify-center text-6xl font-black text-gray-700 italic">
                                        {{ substr($teacher->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold uppercase tracking-tight">{{ $teacher->name }}</h3>
                        <p class="text-sky-400 text-[10px] font-black uppercase tracking-[0.2em] mt-3 italic">{{ $teacher->subject ?? 'Lead Instructor' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-24 bg-white border-t border-gray-100">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-black text-gray-900 tracking-tighter italic mb-16 uppercase">KNOWLEDGE<span class="text-sky-600">ACADEMY.</span></h2>
            <div class="flex flex-wrap justify-center gap-12 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 mb-20">
                <a href="#" class="hover:text-sky-600 transition-colors">Curriculum</a>
                <a href="#" class="hover:text-sky-600 transition-colors">Campus</a>
                <a href="#" class="hover:text-sky-600 transition-colors">Contact</a>
            </div>
            <div class="pt-10 border-t border-gray-50 text-[9px] font-black uppercase tracking-widest text-gray-400">
                © {{ date('Y') }} THE KNOWLEDGE ACADEMY TIRANA. BUILDING BRIGHTER FUTURES.
            </div>
        </div>
    </footer>
</div>
