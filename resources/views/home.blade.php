@extends('layouts.app')

@section('title', 'ICU AgroProducts — Quality Agricultural Products')

@section('content')

    {{-- HERO SLIDER --}}
    <section id="hero-slider" class="relative h-[400px] md:h-[500px] w-full overflow-hidden bg-[#1B4D3E]">
        
        {{-- Slide 1 --}}
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-0" data-slide="0">
            <img src="{{ asset('images/slides/home.jpg') }}" alt="Slide 1" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30"></div>
        </div>

        {{-- Slide 2 --}}
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-0" data-slide="1">
            <img src="{{ asset('images/slides/slide2.jpg') }}" alt="Slide 2" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30"></div>
        </div>

        {{-- Slide 3 --}}
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 opacity-0" data-slide="2">
            <img src="{{ asset('images/slides/slide3.jpg') }}" alt="Slide 3" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30"></div>
        </div>

        {{-- Logo Overlay --}}
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10">
            <img src="{{ asset('images/logo.png') }}" alt="ICU AgroProducts" class="h-24 md:h-32 w-auto object-contain drop-shadow-2xl">
        </div>

        {{-- Slider Dots --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-3 z-20">
            <button class="hero-dot h-2 w-8 rounded-full bg-white/50 hover:bg-white transition" data-goto="0"></button>
            <button class="hero-dot h-2 w-8 rounded-full bg-white/50 hover:bg-white transition" data-goto="1"></button>
            <button class="hero-dot h-2 w-8 rounded-full bg-white/50 hover:bg-white transition" data-goto="2"></button>
        </div>
    </section>

    {{-- INTRO TEXT --}}
    <section class="max-w-7xl mx-auto px-5 lg:px-8 pt-12 pb-8 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-[#1B4D3E] mb-4">Quality Agricultural Products from Zambia</h1>
        <p class="text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Healthy livestock and fresh produce, grown and raised with care. Supporting farmers, feeding communities, and growing a stronger Zambia.
        </p>
    </section>

    {{-- PRODUCTS GRID --}}
    <section class="max-w-7xl mx-auto px-5 lg:px-8 pb-16">
        
        @php
            $products = [
                [
                    'name' => 'Pigs',
                    'img' => 'pigs.jpg',
                    'tag' => 'LIVESTOCK',
                    'desc' => 'Our pigs are raised in clean, healthy environments, ensuring high quality and great value for your farm or business.',
                    'facts' => ['Healthy & well cared for', 'Good weight gain', 'Market ready']
                ],
                [
                    'name' => 'Goats',
                    'img' => 'goats.jpg',
                    'tag' => 'LIVESTOCK',
                    'desc' => 'Strong, healthy goats, ideal for meat, milk and breeding. Raised with proper nutrition and veterinary care.',
                    'facts' => ['Healthy & strong', 'Good for meat and milk', 'Well adapted to local conditions']
                ],
                [
                    'name' => 'Green Pepper',
                    'img' => 'green-pepper.jpg',
                    'tag' => 'VEGETABLES',
                    'desc' => 'Fresh, crisp and nutrient-rich green peppers, grown using modern farming practices for the best quality.',
                    'facts' => ['Fresh and clean', 'Rich in vitamins', 'Locally grown']
                ],
                [
                    'name' => 'Maize',
                    'img' => 'maize.jpg',
                    'tag' => 'GRAINS',
                    'desc' => 'High quality maize, grown for great yield and nutrition. Ideal for home use, feed or commercial purposes.',
                    'facts' => ['High yield', 'Clean and dry', 'Locally sourced']
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">
            @foreach($products as $item)
                
                {{-- Card --}}
                <div class="bg-[#F1F7EA] rounded-[2rem] p-4 md:p-5 flex flex-col sm:flex-row gap-5 hover:shadow-lg transition duration-300">
                    
                    {{-- Image Left --}}
                    <div class="w-full sm:w-[45%] aspect-square rounded-2xl overflow-hidden shrink-0">
                        <img src="{{ asset('images/products/' . $item['img']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                    </div>

                    {{-- Info Right --}}
                    <div class="w-full sm:w-[55%] flex flex-col justify-between py-2">
                        <div>
                            <div class="inline-block bg-white text-[#1B4D3E] px-3 py-1 rounded-full text-[10px] font-bold tracking-wider mb-3">
                                {{ $item['tag'] }}
                            </div>

                            <h3 class="text-2xl font-bold text-[#1B4D3E] mb-2">{{ $item['name'] }}</h3>
                            <p class="text-gray-700 text-sm leading-relaxed mb-4">
                                {{ $item['desc'] }}
                            </p>

                            <ul class="space-y-2 mb-6">
                                @foreach($item['facts'] as $fact)
                                    <li class="flex items-center gap-2 text-xs font-medium text-gray-700">
                                        <span class="text-[#1B4D3E] text-sm">✓</span> {{ $fact }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ route('shop') }}" class="inline-flex items-center justify-center gap-2 bg-[#1B4D3E] text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-[#143B30] transition self-start sm:self-auto w-full sm:w-max">
                            View Product <span>→</span>
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    </section>

@endsection

@push('scripts')
<script>
    (function () {
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.hero-dot');
        let current = 0;
        let interval;

        function show(index) {
            slides.forEach((s, i) => { s.style.opacity = i === index ? '1' : '0'; });
            dots.forEach((d, i) => {
                d.style.backgroundColor = i === index ? '#ffffff' : 'rgba(255,255,255,0.5)';
            });
            current = index;
        }
        function next() { show((current + 1) % slides.length); }
        function start() { interval = setInterval(next, 5000); }
        function stop() { clearInterval(interval); }

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => { stop(); show(i); start(); });
        });

        if (slides.length) { show(0); start(); }
    })();
</script>
@endpush