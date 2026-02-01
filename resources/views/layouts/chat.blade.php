@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-white overflow-hidden" x-data="{ sidebarOpen: true }">
    <aside x-show="sidebarOpen" 
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="-translate-x-full"
           x-transition:enter-end="translate-x-0"
           class="w-72 bg-gray-50 border-r flex flex-col z-20">
        
        <div class="p-4 border-b bg-white">
            <a href="{{ route('chat.index') }}" class="w-full py-3 border-2 border-dashed border-gray-200 rounded-2xl font-bold text-gray-400 hover:border-blue-500 hover:text-blue-500 hover:bg-blue-50 transition-all flex items-center justify-center gap-2">
                <span>+</span> Chat Baru
            </a>
        </div>
        
        <nav class="flex-1 overflow-y-auto p-4 space-y-3">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-2">Riwayat Konsultasi</p>
            
            @forelse($sessions as $s)
                <a href="{{ route('chat.show', $s->id) }}" 
                   class="block p-4 {{ isset($session) && $session->id == $s->id ? 'bg-blue-50 border-blue-300' : 'bg-white border-gray-100' }} border shadow-sm rounded-2xl text-sm font-bold text-gray-700 hover:border-blue-300 transition">
                    <p class="truncate">{{ $s->title }}</p>
                    <span class="text-[10px] text-gray-400 font-medium italic">{{ $s->created_at->diffForHumans() }}</span>
                </a>
            @empty
                <p class="text-xs text-gray-400 text-center py-10 italic">Belum ada riwayat chat.</p>
            @endforelse
        </nav>

        <div class="p-4 border-t bg-gray-50">
            <div class="bg-white p-4 rounded-3xl border border-gray-100 flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-black shadow-lg shadow-blue-100 text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-gray-800 truncate leading-none">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">Orang Tua</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col relative bg-white">
        <header class="p-4 border-b flex justify-between items-center bg-white/80 backdrop-blur-md sticky top-0 z-10">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 hover:bg-gray-100 rounded-xl text-gray-500 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <h2 class="font-black text-gray-800 tracking-tight text-lg">Stunting<span class="text-blue-600">Care</span> AI</h2>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span class="text-[10px] font-bold text-gray-400 uppercase">AI Online</span>
            </div>
        </header>

        <div id="chat-container" class="flex-1 overflow-y-auto p-6 space-y-8 scroll-smooth">
            @if(!isset($messages) || $messages->isEmpty())
                <div class="flex flex-col items-center justify-center h-full text-center space-y-4 opacity-50">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-3xl flex items-center justify-center text-3xl">🤖</div>
                    <div>
                        <h3 class="font-black text-gray-800">Mulai Konsultasi</h3>
                        <p class="text-sm text-gray-500 max-w-xs">Tanyakan apa saja terkait pertumbuhan anak atau masukkan data untuk deteksi stunting.</p>
                    </div>
                </div>
            @else
                @foreach($messages as $msg)
                    <div class="flex {{ $msg->sender === 'user' ? 'justify-end gap-4' : 'gap-4 max-w-3xl' }}">
                        @if($msg->sender === 'bot')
                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex-shrink-0 flex items-center justify-center text-white text-[10px] font-bold shadow-md shadow-blue-100">AI</div>
                        @endif
                        
                        <div class="{{ $msg->sender === 'user' ? 'bg-blue-600 text-white rounded-tr-none shadow-blue-100' : 'bg-gray-50 text-gray-700 border border-gray-100 rounded-tl-none' }} p-4 rounded-2xl shadow-sm leading-relaxed">
                            {!! nl2br(e($msg->message)) !!}
                        </div>

                        @if($msg->sender === 'user')
                            <div class="w-8 h-8 bg-gray-200 rounded-lg flex-shrink-0 flex items-center justify-center text-gray-500 text-[10px] font-bold">ME</div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>

        <div class="p-6 bg-white border-t">
            <div class="max-w-3xl mx-auto">
                <div class="relative flex items-end gap-2 bg-gray-50 p-2 rounded-[2rem] border-2 border-gray-100 focus-within:border-blue-400 focus-within:bg-white transition-all shadow-sm shadow-blue-50/50">
                    <textarea id="user-input" rows="1" 
                        class="w-full bg-transparent p-3 pl-4 border-none focus:ring-0 resize-none text-gray-700 placeholder-gray-400" 
                        placeholder="Tulis pesan atau data anak (cth: Cek anak Lk, 24bln...)"
                        oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                    
                    <button onclick="sendMessage()" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 hover:scale-105 transition shadow-lg shadow-blue-200 flex-shrink-0">
                        <svg class="w-5 h-5 transform rotate-90" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                    </button>
                </div>
                <p class="text-[10px] text-center text-gray-400 mt-3 font-medium">AI menggunakan RAG & CNN Model. Gunakan sebagai referensi edukasi pertumbuhan.</p>
            </div>
        </div>
    </main>
</div>

<script>
    const chatContainer = document.getElementById('chat-container');
    const userInput = document.getElementById('user-input');
    const csrfToken = "{{ csrf_token() }}";

    // Tracking session ID dari Laravel
    let currentSessionId = @json(isset($session) ? $session->id : null);

    // Auto-scroll ke bawah saat halaman dimuat
    window.onload = () => scrollToBottom();

    async function sendMessage() {
        const message = userInput.value.trim();
        if (!message) return;

        appendMessage('user', message);
        userInput.value = '';
        userInput.style.height = 'auto';

        const loadingId = appendLoading();
        scrollToBottom();

        try {
            const response = await fetch("{{ route('chat.send') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    message: message,
                    session_id: currentSessionId // Kirim ID jika sedang dalam sesi tertentu
                })
            });

            const data = await response.json();
            document.getElementById(loadingId).remove();

            if (response.ok) {
                appendMessage('bot', data.reply);
                
                // Jika ini adalah chat pertama (sesi baru), redirect ke URL sesi tersebut
                if (!currentSessionId && data.session_id) {
                    window.location.href = `/chat/${data.session_id}`;
                }
            } else {
                appendMessage('bot', 'Maaf, terjadi kesalahan pada sistem.');
            }
        } catch (error) {
            console.error('Error:', error);
            if (document.getElementById(loadingId)) document.getElementById(loadingId).remove();
            appendMessage('bot', 'Koneksi gagal. Pastikan Server AI aktif.');
        }

        scrollToBottom();
    }

    function appendMessage(sender, text) {
        // Membersihkan chat-container dari tampilan "Mulai Konsultasi" jika ada
        if (chatContainer.querySelector('.opacity-50')) {
            chatContainer.innerHTML = '';
        }

        const bubble = document.createElement('div');
        bubble.className = sender === 'user' ? 'flex justify-end gap-4' : 'flex gap-4 max-w-3xl';
        
        const avatar = sender === 'user' 
            ? `<div class="w-8 h-8 bg-gray-200 rounded-lg flex-shrink-0 flex items-center justify-center text-gray-500 text-[10px] font-bold uppercase tracking-tighter">ME</div>`
            : `<div class="w-8 h-8 bg-blue-600 rounded-lg flex-shrink-0 flex items-center justify-center text-white text-[10px] font-bold shadow-md shadow-blue-100 uppercase tracking-tighter">AI</div>`;

        const contentClass = sender === 'user'
            ? 'bg-blue-600 text-white p-4 rounded-2xl rounded-tr-none shadow-sm shadow-blue-50'
            : 'bg-gray-50 p-4 rounded-2xl rounded-tl-none border border-gray-100 text-gray-700 leading-relaxed';

        bubble.innerHTML = sender === 'user'
            ? `<div class="${contentClass}">${text.replace(/\n/g, '<br>')}</div>${avatar}`
            : `${avatar}<div class="${contentClass}">${text.replace(/\n/g, '<br>')}</div>`;

        chatContainer.appendChild(bubble);
    }

    function appendLoading() {
        const id = 'loading-' + Date.now();
        const loading = document.createElement('div');
        loading.id = id;
        loading.className = 'flex gap-4 max-w-3xl animate-pulse';
        loading.innerHTML = `
            <div class="w-8 h-8 bg-gray-200 rounded-lg flex-shrink-0"></div>
            <div class="bg-gray-50 p-4 rounded-2xl rounded-tl-none border border-gray-100 space-y-2 w-48">
                <div class="h-2 bg-gray-200 rounded w-full"></div>
                <div class="h-2 bg-gray-200 rounded w-2/3"></div>
            </div>
        `;
        chatContainer.appendChild(loading);
        return id;
    }

    function scrollToBottom() {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    userInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });
</script>
@endsection