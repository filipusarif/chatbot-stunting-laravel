@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Edit Artikel</h2>
            <a href="{{ route('admin.articles') }}" class="text-gray-500 hover:underline text-sm">Kembali</a>
        </div>

        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-2">Judul Artikel</label>
                <input type="text" name="title" value="{{ $article->title }}" class="w-full border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Konten</label>
                <textarea name="content" rows="8" class="w-full border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 outline-none" required>{{ $article->content }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Ganti Gambar (Opsional)</label>
                @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" class="w-32 h-32 object-cover rounded-xl mb-4 border">
                @endif
                <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection