@extends('layouts.app')

@section('title', 'Our Products — ICU AgroProducts')

@section('hero')
    {{-- PRODUCTS HERO BANNER --}}
    <section class="relative h-[400px] md:h-[500px] w-full overflow-hidden bg-[#1B4D3E]">
        <img src="{{ asset('images/slides/products-hero.jpg') }}" alt="Our Products" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/30"></div>

        <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10">
            <img src="{{ asset('images/logo.png') }}" alt="ICU AgroProducts" class="h-24 md:h-32 w-auto object-contain drop-shadow-2xl">
        </div>
    </section>
@endsection

@section('content')

    {{-- CATEGORIES SECTION (Under Hero) --}}
    <section class="max-w-7xl mx-auto px-5 lg:px-8 py-12 border-b border-gray-200">
        <div class="mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-[#1B4D3E]">Shop by Category</h2>
            <p class="text-gray-500 text-sm mt-1">Browse our fresh produce and livestock</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($categories as $cat)
                <a href="{{ route('shop') }}?category={{ $cat->slug }}" 
                   class="group bg-[#F9FAF8] rounded-3xl p-6 border border-gray-100 hover:shadow-md hover:border-[#1B4D3E]/30 transition flex flex-col items-center text-center">
                    
                    {{-- Category Image or Smart Icon --}}
                    @if($cat->image)
                        <div class="h-16 w-16 rounded-2xl overflow-hidden mb-4 bg-[#F1F7EA]">
                            <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                        </div>
                    @else
                        <div class="h-16 w-16 rounded-2xl mb-4 bg-[#F1F7EA] flex items-center justify-center text-3xl text-[#6DBE45]">
                            @if(str_contains(strtolower($cat->name), 'animal') || str_contains(strtolower($cat->name), 'livestock'))
                                🐐
                            @elseif(str_contains(strtolower($cat->name), 'maize') || str_contains(strtolower($cat->name), 'grain'))
                                🌽
                            @elseif(str_contains(strtolower($cat->name), 'tomato'))
                                🍅
                            @elseif(str_contains(strtolower($cat->name), 'onion'))
                                🧅
                            @elseif(str_contains(strtolower($cat->name), 'vegetable'))
                                🥬
                            @else
                                🌿
                            @endif
                        </div>
                    @endif
                    
                    <h3 class="font-bold text-[#1B4D3E]">{{ $cat->name }}</h3>
                    <p class="text-xs text-gray-400 mt-1">{{ $cat->products()->count() }} items</p>
                </a>
            @endforeach
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-5 lg:px-8 pt-12 pb-16">
        
        {{-- Page Header --}}
        <div class="mb-8 text-center md:text-left flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-[#1B4D3E] mb-2">
                    @if(request('q'))
                        Search Results for "{{ request('q') }}"
                    @elseif(request('category'))
                        {{ ucfirst(str_replace('-', ' ', request('category'))) }}
                    @else
                        Browse All Products
                    @endif
                </h2>
                <p class="text-gray-500 text-sm">
                    Showing {{ $products->total() }} {{ Str::plural('product', $products->total()) }}
                </p>
            </div>
            
            {{-- Clear filter button --}}
            @if(request('category') || request('q'))
                <a href="{{ route('shop') }}" class="text-sm font-semibold text-[#6DBE45] hover:underline mt-2 md:mt-0">
                    Clear Filters ✕
                </a>
            @endif
        </div>

        {{-- Top Filter Bar (Categories) --}}
        <div class="flex flex-wrap gap-2 mb-10 border-b border-gray-200 pb-6">
            <a href="{{ route('shop') }}" 
               class="px-5 py-2 rounded-full text-sm font-semibold transition border
                      {{ !request('category') ? 'bg-[#1B4D3E] text-white border-[#1B4D3E]' : 'bg-white text-gray-600 border-gray-200 hover:border-[#1B4D3E]' }}">
                All
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('shop') }}?category={{ $cat->slug }}" 
                   class="px-5 py-2 rounded-full text-sm font-semibold transition border
                          {{ request('category') === $cat->slug ? 'bg-[#1B4D3E] text-white border-[#1B4D3E]' : 'bg-white text-gray-600 border-gray-200 hover:border-[#1B4D3E]' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        {{-- Products Grid --}}
        @if($products->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($products as $product)
                    
                    {{-- Product Card --}}
                    <div class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group flex flex-col">
                        
                        {{-- Image --}}
                        <a href="{{ route('product.show', $product->slug) }}" class="relative aspect-square bg-[#F1F7EA] overflow-hidden block">
                            
                            {{-- FALLBACK LOGIC: Checks new gallery, then old image_main --}}
                            @php
                                $firstImage = $product->images->first()?->url ?? $product->image_main;
                            @endphp

                            @if($firstImage)
                                <img src="{{ asset('storage/' . $firstImage) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-6xl text-[#6DBE45]">🌿</div>
                            @endif
                            
                            {{-- Category Tag --}}
                            @if($product->category)
                                <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold text-[#1B4D3E] uppercase tracking-wider shadow-sm">
                                    {{ $product->category->name }}
                                </div>
                            @endif
                        </a>

                        {{-- Content --}}
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-[#1B4D3E] mb-2 leading-snug">
                                {{ $product->name }}
                            </h3>
                            <p class="text-gray-500 text-sm line-clamp-2 mb-6 flex-1">
                                {{ $product->short_description }}
                            </p>

                            {{-- Button --}}
                            <a href="{{ route('product.show', $product->slug) }}"
                               class="w-full inline-flex items-center justify-center gap-2 bg-[#F1F7EA] text-[#1B4D3E] 
                                      px-4 py-3 rounded-full font-bold text-sm 
                                      hover:bg-[#1B4D3E] hover:text-white transition group">
                                View Details
                                <span class="group-hover:translate-x-1 transition">→</span>
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12 flex justify-center">
                {{ $products->links() }}
            </div>

        @else
            {{-- Empty State --}}
            <div class="bg-[#F1F7EA] rounded-[2rem] p-16 text-center max-w-2xl mx-auto">
                <div class="text-6xl mb-4">🌿</div>
                <h3 class="text-2xl font-bold text-[#1B4D3E] mb-2">No products found</h3>
                <p class="text-gray-600 mb-8">
                    We couldn't find anything matching your search. Try adjusting your filters or browse all products.
                </p>
                <a href="{{ route('shop') }}"
                   class="inline-flex items-center gap-2 bg-[#1B4D3E] text-white px-6 py-3 rounded-full font-semibold text-sm hover:bg-[#143B30] transition">
                    Clear Filters
                </a>
            </div>
        @endif

    </div>

@endsection