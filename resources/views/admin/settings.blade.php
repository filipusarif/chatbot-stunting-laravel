@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="bg-white rounded-3xl shadow-sm p-8 border border-gray-100">
        <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">Pengaturan API</h2>
        
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.updateToken') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-2">NVIDIA NIM API Token</label>
                <textarea name="token" rows="3" class="w-full border-2 border-gray-100 rounded-2xl p-4 focus:border-blue-500 outline-none" placeholder="Masukkan nvapi-...">{{ $token?->value }}</textarea>
                <p class="text-xs text-gray-500 mt-2 italic">*Token ini digunakan oleh FastAPI untuk mengakses LLM.</p>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection