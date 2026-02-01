@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-50 to-white">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="flex justify-center">
            <div class="w-16 h-16 bg-blue-600 text-white rounded-3xl flex items-center justify-center text-3xl font-black shadow-lg shadow-blue-200">
                S
            </div>
        </div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 tracking-tight">
            Daftar Akun Baru
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Bergabunglah untuk mulai konsultasi cerdas si kecil
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-6 shadow-2xl border border-gray-100 sm:rounded-3xl sm:px-10">
            
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus 
                        class="w-full border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 outline-none transition @error('name') border-red-500 @enderror" 
                        placeholder="Masukkan nama Anda">
                    @error('name')
                        <p class="mt-2 text-xs text-red-500 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required 
                        class="w-full border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 outline-none transition @error('email') border-red-500 @enderror" 
                        placeholder="contoh@gmail.com">
                    @error('email')
                        <p class="mt-2 text-xs text-red-500 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" 
                        class="w-full border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 outline-none transition @error('password') border-red-500 @enderror"
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-2 text-xs text-red-500 italic">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required 
                        class="w-full border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 outline-none transition"
                        placeholder="••••••••">
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-2xl shadow-lg text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all active:scale-[0.98]">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-500 transition">
                        Masuk di sini
                    </a>
                </p>
                <div class="mt-4">
                    <a href="/" class="text-sm text-gray-400 hover:text-blue-600 transition">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection