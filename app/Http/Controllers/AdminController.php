<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function index() {
        $stats = [
            'articles' => Article::count(),
            'users' => User::count(),
            'token' => Setting::where('key', 'nvidia_token')->first()?->value ?? 'Belum diatur',
            'total_articles' => \App\Models\Article::count(),
            'total_users'    => \App\Models\User::count(),
            'latest_articles' => \App\Models\Article::latest()->take(5)->get(),
            'latest_users'    => \App\Models\User::latest()->take(5)->get(),
            'total_detections' => 120, 
            'api_status'     => 'Connected'
        ];
        return view('admin.dashboard', compact('stats'));
    }

    // Tampilkan & Update Token
    public function settings() {
        $token = Setting::where('key', 'nvidia_token')->first();
        return view('admin.settings', compact('token'));
    }

    public function updateToken(Request $request) {
        $request->validate(['token' => 'required']);
        
        Setting::updateOrCreate(
            ['key' => 'nvidia_token'],
            ['value' => $request->token]
        );

        return back()->with('success', 'Token NVIDIA berhasil diperbarui!');
    }

    // Artikel Management (Contoh Store)
    public function storeArticle(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $path = $request->file('image') ? $request->file('image')->store('articles', 'public') : null;

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path
        ]);

        return back()->with('success', 'Artikel berhasil dipublikasikan!');
    }


    public function editArticle($id) {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function updateArticle(Request $request, $id) {
        $article = Article::findOrFail($id);
        
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            // Simpan gambar baru
            $path = $request->file('image')->store('articles', 'public');
            $article->image = $path;
        }

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.articles')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroyArticle($id) {
        $article = Article::findOrFail($id);
        
        // Hapus file gambar dari storage
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        
        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus!');
    }

    // Tambahkan di dalam class AdminController

    public function users()
    {
        // Mengambil semua user kecuali admin yang sedang login (opsional)
        $users = User::where('id', '!=', auth()->id())->latest()->get();
        return view('admin.users', compact('users'));
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        
        // Proteksi agar tidak menghapus diri sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $user->delete();
        return back()->with('success', 'Pengguna berhasil dihapus!');
    }

    public function createUser() {
        return view('admin.users.create');
    }

    // Simpan user baru
    public function storeUser(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function editUser($id) {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update data user
    public function updateUser(Request $request, $id) {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function showArticle($id)
    {
        // Mengambil artikel berdasarkan ID, atau berikan error 404 jika tidak ditemukan
        $article = Article::findOrFail($id);
        
        return view('admin.articles.show', compact('article'));
    }
}
