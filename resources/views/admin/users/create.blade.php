@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-100">
        <h2 class="text-2xl font-bold mb-6">Tambah Pengguna Baru</h2>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-2">Nama Lengkap</label>
                <input type="text" name="name" class="w-full border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Alamat Email</label>
                <input type="email" name="email" class="w-full border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 outline-none" required>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold mb-2">Password</label>
                    <input type="password" name="password" class="w-full border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 outline-none" required>
                </div>
            </div>
            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">Simpan Pengguna</button>
                <a href="{{ route('admin.users') }}" class="bg-gray-100 text-gray-600 px-8 py-4 rounded-2xl font-bold hover:bg-gray-200 transition text-center">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection