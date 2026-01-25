@extends('layouts.app')

@section('content')
<article class="py-12 md:py-20 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <a href="/" class="inline-flex items-center text-blue-600 font-semibold mb-8 hover:underline">
            ← Kembali ke Beranda
        </a>

        <header class="mb-10 text-center md:text-left">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-4">
                {{ $article->title }}
            </h1>
            <div class="flex items-center text-gray-500 text-sm gap-4">
                <span>📅 {{ $article->created_at->format('d M Y') }}</span>
                <span>👤 Administrator</span>
            </div>
        </header>

        @if($article->image)
        <div class="mb-12 rounded-3xl overflow-hidden shadow-xl">
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-auto object-cover max-h-[500px]">
        </div>
        @endif

        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed space-y-6">
            {{-- Menggunakan nl2br untuk menjaga format baris baru dari textarea --}}
            {!! nl2br(e($article->content)) !!}
        </div>

        <hr class="my-16 border-gray-100">

        <div class="bg-blue-50 p-8 rounded-3xl flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h4 class="text-xl font-bold text-blue-900 mb-2">Punya Pertanyaan Lain?</h4>
                <p class="text-blue-700">Tanyakan langsung pada Chatbot AI kami di pojok kanan bawah.</p>
            </div>
            <a href="/deteksi" class="bg-blue-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                Cek Deteksi Stunting
            </a>
        </div>
    </div>
</article>
@endsection