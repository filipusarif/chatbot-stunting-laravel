@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="flex flex-col md:flex-row gap-8">
        
        <div class="w-full md:w-1/3">
            <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-100 sticky top-24">
                <h2 class="text-xl font-bold mb-4">Tambah Artikel Baru</h2>
                
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold mb-1">Judul Artikel</label>
                        <input type="text" name="title" class="w-full border-2 border-gray-100 rounded-xl p-3 focus:border-blue-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Konten</label>
                        <textarea name="content" rows="5" class="w-full border-2 border-gray-100 rounded-xl p-3 focus:border-blue-500 outline-none" required></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Gambar Cover</label>
                        <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition">Publikasikan</button>
                </form>
            </div>
        </div>

        <div class="w-full md:w-2/3">
            <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-bold mb-6">Kelola Konten</h2>
                
                <div class="space-y-4">
                    @forelse(\App\Models\Article::latest()->get() as $article)
                        <div class="flex items-center gap-4 p-4 border-2 border-gray-50 rounded-2xl hover:border-blue-100 transition">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" class="w-16 h-16 object-cover rounded-lg">
                            @else
                                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-xs text-gray-400">No Image</div>
                            @endif
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800">{{ $article->title }}</h3>
                                <p class="text-sm text-gray-500 line-clamp-1">{{ $article->content }}</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.articles.edit', $article->id) }}" class="text-blue-500 hover:bg-blue-50 p-2 rounded-lg transition">✏️</a>

                                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition">🗑️</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 py-10">Belum ada artikel yang dipublikasikan.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection