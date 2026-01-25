<div class="fixed bottom-4 right-4 md:bottom-6 md:right-6 z-[100] flex flex-col items-end">
    <div id="chat-window" class="hidden w-[calc(100vw-2rem)] md:w-96 bg-white rounded-2xl shadow-2xl border border-gray-200 flex flex-col mb-4 overflow-hidden">
        <div class="bg-blue-600 p-4 text-white flex justify-between items-center">
            <span class="font-bold flex items-center gap-2">🤖 Asisten Stunting</span>
            <button onclick="toggleChat()" class="hover:text-gray-200 text-xl">×</button>
        </div>

        <div id="chat-messages" class="h-80 md:h-96 overflow-y-auto p-4 space-y-4 bg-gray-50 flex flex-col">
            <div class="bg-blue-100 text-blue-800 p-3 rounded-lg max-w-[85%] self-start shadow-sm text-sm">
                Halo! Ada yang bisa saya bantu seputar stunting?
            </div>
            <div id="loading-indicator" class="hidden bg-gray-200 text-gray-600 p-4 rounded-lg max-w-[60px] self-start shadow-sm">
                <div class="flex gap-1">
                    <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce-slow" style="animation-delay: 0.1s"></div>
                    <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce-slow" style="animation-delay: 0.2s"></div>
                    <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce-slow" style="animation-delay: 0.3s"></div>
                </div>
            </div>
        </div>

        <div class="p-3 border-t bg-white flex gap-2">
            <input type="text" id="user-input" onkeypress="handleKey(event)" placeholder="Ketik pesan..." class="flex-1 border rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            <button onclick="sendMessage()" class="bg-blue-600 text-white p-2 rounded-xl w-10 h-10 flex items-center justify-center hover:bg-blue-700">➤</button>
        </div>
    </div>

    <button onclick="toggleChat()" class="bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-full shadow-xl transition-transform active:scale-90">
        <span class="text-2xl">💬</span>
    </button>
</div>

<script>
    const nvidiaToken = "{{ \App\Models\Setting::where('key', 'nvidia_token')->first()?->value }}";
    const fastApiUrl = "{{ config('services.fastapi.url') }}";

    const chatMessages = document.getElementById('chat-messages');
    const loadingIndicator = document.getElementById('loading-indicator');

    function handleKey(e) { if (e.key === 'Enter') sendMessage(); }

    async function sendMessage() {
        const input = document.getElementById('user-input');
        const message = input.value.trim();
        if (!message) return;

        // User Message
        appendMessage(message, 'user');
        input.value = '';

        // Show Loading (Pindahkan ke bawah pesan terakhir)
        loadingIndicator.classList.remove('hidden');
        chatMessages.appendChild(loadingIndicator);
        chatMessages.scrollTop = chatMessages.scrollHeight;

        try {
            const response = await fetch(`${fastApiUrl}/api/chat`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message: message, token: nvidiaToken })
            });
            const data = await response.json();
            
            loadingIndicator.classList.add('hidden');
            appendMessage(data.reply, 'bot');
        } catch (error) {
            loadingIndicator.classList.add('hidden');
            appendMessage('Maaf, server sedang sibuk. Coba lagi nanti.', 'bot');
        }
    }

    function appendMessage(text, sender) {
        const div = document.createElement('div');
        const isUser = sender === 'user';
        div.className = `${isUser ? 'bg-blue-600 text-white self-end ml-auto' : 'bg-white border text-gray-800 self-start'} p-3 rounded-2xl max-w-[85%] shadow-sm text-sm mb-4`;
        div.innerText = text;
        chatMessages.insertBefore(div, loadingIndicator);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function toggleChat() {
        document.getElementById('chat-window').classList.toggle('hidden');
    }
</script>