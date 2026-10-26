@extends('layouts.app')

@section('title', 'Contact — ICU AgroProducts')

@section('content')

    <div class="bg-white rounded-2xl border border-[#1B4D3E]/10 p-6 md:p-10">
        <div class="max-w-2xl">
            <h1 class="text-3xl font-bold text-[#1B4D3E] mb-2">Get in Touch</h1>
            <p class="text-gray-500 mb-8">
                Interested in a product? Have a question? Send us a message and we'll get back to you.
            </p>

            @if(session('success'))
                <div class="bg-[#F1F7EA] border border-[#6DBE45]/40 text-[#1B4D3E] p-4 rounded-xl mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-[#1B4D3E] mb-1">Your Name *</label>
                        <input type="text" name="name" required value="{{ old('name') }}"
                               class="w-full px-4 py-3 rounded-xl border border-[#1B4D3E]/15 focus:border-[#6DBE45] focus:ring-2 focus:ring-[#6DBE45]/20 focus:outline-none text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[#1B4D3E] mb-1">Phone *</label>
                        <input type="text" name="phone" required value="{{ old('phone') }}"
                               class="w-full px-4 py-3 rounded-xl border border-[#1B4D3E]/15 focus:border-[#6DBE45] focus:ring-2 focus:ring-[#6DBE45]/20 focus:outline-none text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-[#1B4D3E] mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-3 rounded-xl border border-[#1B4D3E]/15 focus:border-[#6DBE45] focus:ring-2 focus:ring-[#6DBE45]/20 focus:outline-none text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-[#1B4D3E] mb-1">Product of Interest</label>
                    <select name="product_id"
                            class="w-full px-4 py-3 rounded-xl border border-[#1B4D3E]/15 focus:border-[#6DBE45] focus:ring-2 focus:ring-[#6DBE45]/20 focus:outline-none text-sm">
                        <option value="">— None / General inquiry —</option>
                        @foreach(\App\Models\Product::active()->orderBy('name')->get() as $prod)
                            <option value="{{ $prod->id }}"
                                    {{ (request('product') === $prod->slug || old('product_id') == $prod->id) ? 'selected' : '' }}>
                                {{ $prod->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-[#1B4D3E] mb-1">Message</label>
                    <textarea name="message" rows="5"
                              class="w-full px-4 py-3 rounded-xl border border-[#1B4D3E]/15 focus:border-[#6DBE45] focus:ring-2 focus:ring-[#6DBE45]/20 focus:outline-none text-sm"
                              placeholder="Tell us what you're looking for...">{{ old('message') }}</textarea>
                </div>

                <button type="submit"
                        class="inline-flex items-center gap-2 bg-[#6DBE45] text-white px-6 py-3 rounded-full font-semibold text-sm hover:bg-[#5aa838] transition">
                    Send Message →
                </button>
            </form>
        </div>
    </div>

@endsection