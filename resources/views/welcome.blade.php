@extends('layouts.app')

@section('content')
<section class="py-12 md:py-20 bg-gradient-to-br from-blue-50 to-white">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="text-center md:text-left order-2 md:order-1">
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                Cegah Stunting, <br class="hidden md:block">
                <span class="text-blue-600">Lindungi Masa Depan.</span>
            </h1>
            <p class="text-base md:text-lg text-gray-600 mb-8">
                Dapatkan informasi akurat dan deteksi dini risiko stunting menggunakan teknologi AI.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                <a href="/deteksi" class="bg-blue-600 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:bg-blue-700 transition text-center">Mulai Deteksi</a>
                <a href="#edukasi" class="px-8 py-4 border border-gray-300 rounded-xl font-bold hover:bg-gray-100 transition text-center">Pelajari</a>
            </div>
        </div>
        <div class="order-1 md:order-2">
            <img src="https://illustrations.popsy.co/blue/mother-with-child.svg" alt="Hero" class="w-full max-w-sm mx-auto">
        </div>
    </div>
</section>

<section id="edukasi" class="py-20 max-w-7xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-center mb-12">Mengenal Stunting</h2>
    <div class="grid md:grid-cols-3 gap-8">
        <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-xl mb-3 text-blue-600">Apa itu Stunting?</h3>
            <p class="text-gray-600">Gangguan pertumbuhan dan perkembangan anak akibat kekurangan gizi kronis dan infeksi berulang.</p>
        </div>
        <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-xl mb-3 text-blue-600">Gejala Utama</h3>
            <p class="text-gray-600">Tinggi badan di bawah standar usianya, pertumbuhan gigi terlambat, dan wajah tampak lebih muda.</p>
        </div>
        <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-xl mb-3 text-blue-600">Pencegahan</h3>
            <p class="text-gray-600">Pemberian ASI eksklusif, MPASI bergizi, dan menjaga kebersihan lingkungan (sanitasi).</p>
        </div>
    </div>
</section>
<section id="edukasi" class="py-20 max-w-7xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-center mb-12">Informasi Terbaru</h2>
    <div class="grid md:grid-cols-3 gap-8">
        @foreach($articles as $article)
        <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-xl mb-3 text-blue-600">{{ $article->title }}</h3>
            <p class="text-gray-600">{{ Str::limit($article->content, 100) }}</p>
        </div>
        @endforeach
    </div>
</section>
@endsection