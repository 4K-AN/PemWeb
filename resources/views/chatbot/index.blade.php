<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi Jurusan - Edvizo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .chat-bubble {
            max-width: 80%;
            padding: 12px 16px;
            border-radius: 1rem;
            font-size: 0.95rem;
            line-height: 1.5;
            position: relative;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .user-bubble {
            background-color: #0f766e; /* Teal-700 */
            color: white;
            border-bottom-right-radius: 4px;
            margin-left: auto;
        }

        .bot-bubble {
            background-color: #f3f4f6; /* Gray-100 */
            color: #1f2937; /* Gray-800 */
            border-bottom-left-radius: 4px;
            margin-right: auto;
            border: 1px solid #e5e7eb;
        }
    </style>
</head>
<body class="bg-gray-50 h-screen flex flex-col">

    <header class="bg-teal-700 text-white p-4 shadow-md flex items-center gap-3">
        <button onclick="window.history.back()" class="hover:bg-teal-600 p-2 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </button>
        <div>
            <h1 class="font-bold text-lg">Advizo (Chatbot)</h1>
            <p class="text-xs text-teal-100">Online • Siap membantu konsultasi jurusan</p>
        </div>
    </header>

    <main id="chat-container" class="flex-1 overflow-y-auto p-4 space-y-4">
        <div class="flex w-full mt-2 space-x-3 max-w-xs">
            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-teal-100 flex items-center justify-center">
                🤖
            </div>
            <div>
                <div class="bot-bubble chat-bubble">
                    Halo! Saya <strong>Advizo</strong>. 👋<br>
                    Bingung pilih jurusan? Ceritakan minat atau pelajaran favoritmu, saya akan bantu carikan rekomendasi jurusan yang cocok!
                </div>
                <span class="text-xs text-gray-400 leading-none">Baru saja</span>
            </div>
        </div>
    </main>

    <div class="bg-white p-4 border-t border-gray-200">
        <form id="chat-form" class="flex items-center gap-2 max-w-4xl mx-auto">
            <input type="text" id="user-input"
                class="flex-1 border border-gray-300 rounded-full px-6 py-3 focus:outline-none focus:border-teal-600 focus:ring-1 focus:ring-teal-600 shadow-sm transition"
                placeholder="Ketik pertanyaanmu di sini..." autocomplete="off">

            <button type="submit"
                class="bg-teal-700 hover:bg-teal-800 text-white p-3 rounded-full shadow-md transition transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed" id="send-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                </svg>
            </button>
        </form>
    </div>

    <script>
        const chatContainer = document.getElementById('chat-container');
        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');
        const sendBtn = document.getElementById('send-btn');

        // Array untuk menyimpan riwayat chat (Konteks)
        let chatHistory = [];

        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = userInput.value.trim();
            if (!message) return;

            // 1. Tampilkan Pesan User
            appendMessage('user', message);
            userInput.value = '';
            sendBtn.disabled = true;

            // 2. Tampilkan Loading Bubble
            const loadingId = showLoading();

            try {
                // 3. Kirim ke Backend Laravel
                const response = await fetch("{{ route('chatbot.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        message: message,
                        history: chatHistory // Kirim riwayat agar bot ingat konteks
                    })
                });

                const data = await response.json();

                // Hapus loading
                document.getElementById(loadingId).remove();

                // 4. Tampilkan Balasan Bot
                if (data.reply) {
                    appendMessage('bot', data.reply);

                    // Simpan ke history lokal client
                    chatHistory.push({ role: 'user', text: message });
                    chatHistory.push({ role: 'model', text: data.reply });

                    // Batasi history agar tidak terlalu panjang (misal 10 chat terakhir)
                    if (chatHistory.length > 10) chatHistory = chatHistory.slice(-10);
                }

            } catch (error) {
                document.getElementById(loadingId).remove();
                appendMessage('bot', 'Maaf, terjadi kesalahan koneksi. Silakan coba lagi.');
                console.error(error);
            } finally {
                sendBtn.disabled = false;
                userInput.focus();
            }
        });

        function appendMessage(sender, text) {
            const div = document.createElement('div');
            const isUser = sender === 'user';

            div.className = `flex w-full mt-4 space-x-3 max-w-md ${isUser ? 'ml-auto justify-end' : ''}`;

            // Icon Bot (hanya muncul jika bot)
            const botIcon = `
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-teal-100 flex items-center justify-center">
                    🤖
                </div>`;

            // Format teks (ganti baris baru dengan <br>)
            const formattedText = text.replace(/\n/g, '<br>');

            div.innerHTML = `
                ${!isUser ? botIcon : ''}
                <div>
                    <div class="${isUser ? 'user-bubble' : 'bot-bubble'} chat-bubble">
                        ${formattedText}
                    </div>
                </div>
            `;

            chatContainer.appendChild(div);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function showLoading() {
            const id = 'loading-' + Date.now();
            const div = document.createElement('div');
            div.id = id;
            div.className = 'flex w-full mt-4 space-x-3 max-w-md';
            div.innerHTML = `
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-teal-100 flex items-center justify-center">🤖</div>
                <div class="bot-bubble chat-bubble text-gray-500">
                    <span class="animate-pulse">Sedang mengetik...</span>
                </div>
            `;
            chatContainer.appendChild(div);
            chatContainer.scrollTop = chatContainer.scrollHeight;
            return id;
        }
    </script>
</body>
</html>
