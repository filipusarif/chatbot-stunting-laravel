@extends('layouts.app') @section('content')
<div class="flex flex-col md:flex-row min-h-screen bg-gray-100">
    <div class="w-full md:w-64 bg-white shadow-md">
        <div class="p-6">
            <h2 class="text-xl font-bold text-blue-600">Admin Panel</h2>
        </div>
        <nav class="mt-4 px-4 space-y-2">
            <a href="/admin/settings" class="block p-3 hover:bg-blue-50 rounded-lg font-medium">⚙️ API Settings</a>
            <a href="/admin/articles" class="block p-3 hover:bg-blue-50 rounded-lg font-medium">📝 Manage Content</a>
            <a href="/admin/users" class="block p-3 hover:bg-blue-50 rounded-lg font-medium">👥 User Management</a>
        </nav>
    </div>

    <div class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Selamat Datang, Admin</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <span class="text-gray-500">Total Artikel</span>
                <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Article::count() }}</p>
            </div>
            </div>
    </div>
</div>
@endsection