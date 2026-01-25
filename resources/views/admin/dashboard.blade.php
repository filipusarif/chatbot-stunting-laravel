@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-gray-900">Dashboard Admin</h1>
        <p class="text-gray-500">Selamat datang kembali, {{ auth()->user()->name }}. Berikut ringkasan sistem hari ini.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-blue-50 flex items-center gap-5">
            <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl">
                📝
            </div>
            <div>
                <span class="text-sm text-gray-500 font-medium">Total Artikel</span>
                <p class="text-2xl font-black text-gray-800">{{ $stats['total_articles'] }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-blue-50 flex items-center gap-5">
            <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center text-2xl">
                👥
            </div>
            <div>
                <span class="text-sm text-gray-500 font-medium">Total Pengguna</span>
                <p class="text-2xl font-black text-gray-800">{{ $stats['total_users'] }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-blue-50 flex items-center gap-5">
            <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center text-2xl">
                📊
            </div>
            <div>
                <span class="text-sm text-gray-500 font-medium">Total Deteksi AI</span>
                <p class="text-2xl font-black text-gray-800">{{ $stats['total_detections'] }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Artikel Terbaru</h3>
                <a href="{{ route('admin.articles') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="p-0">
                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-bold text-gray-400 uppercase">Judul</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-400 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-xs font-bold text-gray-400 uppercase text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($stats['latest_articles'] as $article)
                        <tr class="hover:bg-blue-50/30 transition">
                            <td class="px-6 py-4">
                                <span class="font-semibold text-gray-700 block truncate max-w-xs">{{ $article->title }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $article->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.articles.edit', $article->id) }}" class="text-blue-600 font-bold text-sm">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 mb-6">Pengguna Baru</h3>
            <div class="space-y-6">
                @foreach($stats['latest_users'] as $user)
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-blue-400 text-white rounded-full flex items-center justify-center font-bold text-sm">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-gray-800 truncate">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-8">
                <a href="{{ route('admin.users') }}" class="block w-full text-center py-3 bg-gray-50 text-gray-600 rounded-xl font-bold text-sm hover:bg-gray-100 transition">
                    Kelola Semua Pengguna
                </a>
            </div>
        </div>
    </div>
</div>
@endsection