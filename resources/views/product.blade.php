@extends('layouts.app')

@section('title', $product->name . ' — ICU AgroProducts')

@section('content')

    <nav class="text-xs text-gray-500 mb-4">
        <a href="{{ route('home') }}" class="hover:text-[#6DBE45]">Home</a>
        <span class="mx-1">/</span>
        <a href="{{ route('shop') }}" class="hover:text-[#6DBE45]">Products</a>
        <span class="mx-1">/</span>
        <span class="text-[#1B4D3E] font-medium">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white rounded-3xl border border-gray-100 p-6 md:p-10 shadow-sm">

        {{-- IMAGE GALLERY SECTION --}}
        @php
            // Get images from the new gallery
            $galleryImages = $product->images->pluck('url')->toArray();
            
            // Fallback to old image_main if gallery is empty
            if (empty($galleryImages) && $product->image_main) {
                $galleryImages = [$product->image_main];
            }
            
            // Clean up the array (remove empty entries)
            $galleryImages = array_values(array_filter($galleryImages));
            $mainImage = count($galleryImages) > 0 ? $galleryImages[0] : null;
        @endphp

        {{-- The Main Image --}}
        <div class="flex flex-col gap-4">
            <div class="aspect-square bg-[#F1F7EA] rounded-2xl overflow-hidden flex items-center justify-center border border-gray-100">
                @if($mainImage)
                    <img src="{{ asset('storage/' . $mainImage) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <div class="text-6xl text-[#6DBE45]">🌿</div>
                @endif
            </div>

            {{-- Thumbnails (Only show if there is more than 1 image) --}}
            @if(count($galleryImages) > 1)
                <div class="flex gap-3 overflow-x-auto pb-2">
                    @foreach($galleryImages as $imgUrl)
                        <div class="h-20 w-20 flex-shrink-0 rounded-xl overflow-hidden border-2 border-transparent hover:border-[#1B4D3E] transition">
                            <img src="{{ asset('storage/' . $imgUrl) }}" class="w-full h-full object-cover" alt="Thumbnail">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- PRODUCT DETAILS SECTION --}}
        <div class="flex flex-col">
            @if($product->category)
                <div class="inline-flex self-start px-3 py-1 rounded-full bg-[#F1F7EA] text-[#1B4D3E] text-[10px] font-bold uppercase tracking-wider mb-3">
                    {{ $product->category->name }}
                </div>
            @endif

            <h1 class="text-3xl md:text-4xl font-bold text-[#1B4D3E] mb-3">{{ $product->name }}</h1>

            <p class="text-gray-600 mb-6 leading-relaxed text-base">{{ $product->short_description }}</p>

            @if($product->size)
                <div class="text-sm text-gray-500 mb-8 bg-[#F9FAF8] p-3 rounded-lg inline-block border border-gray-100">
                    <span class="font-semibold text-[#1B4D3E]">Size / Unit:</span> {{ $product->size }}
                </div>
            @endif

            {{-- Call to Action Buttons --}}
            <div class="flex flex-wrap gap-3 mb-8">
                <a href="{{ route('contact', ['product' => $product->slug]) }}"
                   class="inline-flex items-center gap-2 bg-[#6DBE45] text-white px-8 py-3.5 rounded-full font-bold text-sm hover:bg-[#5aa838] transition shadow-sm">
                    Enquire About This Product
                </a>
                <a href="{{ route('shop') }}"
                   class="inline-flex items-center gap-2 bg-white text-[#1B4D3E] px-8 py-3.5 rounded-full font-bold text-sm border border-[#1B4D3E]/15 hover:bg-[#F1F7EA] transition">
                    Back to Products
                </a>
            </div>

            {{-- Disclaimer --}}
            <div class="text-xs text-gray-500 leading-relaxed border-t border-gray-100 pt-6 mt-auto">
                <strong class="text-[#1B4D3E]">Disclaimer:</strong>
                This product is not intended to diagnose, treat, cure, or prevent any disease.
                Consult a healthcare professional before use.
            </div>
        </div>

    </div>

    {{-- Related Products --}}
    @if($related->count())
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-[#1B4D3E] mb-6">You may also like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($related as $rel)
                    <a href="{{ route('product.show', $rel->slug) }}"
                       class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg transition group">
                        <div class="aspect-square bg-[#F1F7EA] overflow-hidden">
                            
                            @php
                                $relImage = $rel->images->first()?->url ?? $rel->image_main;
                            @endphp

                            @if($relImage)
                                <img src="{{ asset('storage/' . $relImage) }}"
                                     alt="{{ $rel->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-4xl text-[#6DBE45]">🌿</div>
                            @endif
                        </div>
                        <div class="p-5">
                            <div class="font-bold text-[#1B4D3E] text-lg mb-1">{{ $rel->name }}</div>
                            <div class="text-sm text-gray-500 line-clamp-1">{{ $rel->short_description }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

@endsection