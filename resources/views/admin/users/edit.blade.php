@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Pengguna</h2>
            <a href="{{ route('admin.users') }}" class="text-gray-500 hover:text-blue-600 transition text-sm flex items-center gap-1">
                ← Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            {{-- Karena route-nya menggunakan POST di web.php, kita tidak perlu @method('PUT') 
                 kecuali jika Anda mengubah rute tersebut menjadi PUT --}}
            
            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                       class="w-full border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 outline-none transition" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 text-gray-700">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                       class="w-full border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 outline-none transition" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100">
                <h3 class="text-sm font-bold text-blue-800 mb-4 flex items-center gap-2">
                    🔒 Keamanan (Opsional)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-600">Password Baru</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin ganti" 
                               class="w-full border-2 border-white rounded-xl p-4 focus:border-blue-500 outline-none transition bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-600">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password baru" 
                               class="w-full border-2 border-white rounded-xl p-4 focus:border-blue-500 outline-none transition bg-white">
                    </div>
                </div>
                <p class="text-[10px] text-blue-400 mt-3 italic">*Biarkan kosong jika pengguna tidak ingin mengganti password mereka.</p>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full md:w-auto bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 active:scale-[0.98]">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection