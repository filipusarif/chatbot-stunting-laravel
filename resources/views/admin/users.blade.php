@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="bg-white rounded-3xl shadow-sm p-6 md:p-8 border border-gray-100">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h2>
                <p class="text-sm text-gray-500">Total terdaftar: {{ $users->count() }} pengguna</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition flex items-center gap-2">
                <span>+ Tambah User</span>
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-6 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-2 border-gray-50">
                        <th class="px-4 py-4 text-sm font-semibold text-gray-600">Nama</th>
                        <th class="px-4 py-4 text-sm font-semibold text-gray-600">Email</th>
                        <th class="px-4 py-4 text-sm font-semibold text-gray-600">Tanggal Bergabung</th>
                        <th class="px-4 py-4 text-sm font-semibold text-gray-600 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="font-medium text-gray-700">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="px-4 py-4 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-4">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition" title="Edit User">
                                    ✏️
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-10 text-center text-gray-400 italic">
                            Belum ada pengguna lain yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection