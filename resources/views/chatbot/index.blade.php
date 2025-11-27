<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi Jurusan - Edvizo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: white; overflow: hidden; }

        :root {
            --edvizo-green: #3B8773;
            --edvizo-dark: #2E6B5B;
            --edvizo-light: #E8F5F3;
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94A3B8; }

        .fade-in { animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }

        .tab-btn { transition: all 0.3s ease; }

        .tab-active {
            background-color: var(--edvizo-green);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(59, 135, 115, 0.3);
        }

        .tab-inactive {
            color: #6B7280;
            font-weight: 500;
            background-color: transparent;
        }
        .tab-inactive:hover {
            background-color: #F3F4F6;
            color: var(--edvizo-green);
        }

        .tab-disabled { opacity: 0.5; pointer-events: none; cursor: not-allowed; }

        .chat-content-area { padding-bottom: 160px !important; }
    </style>
</head>
<body class="flex flex-col h-screen w-full bg-gray-50">

    <header class="h-20 bg-white px-8 md:px-12 flex items-center justify-between shadow-sm border-b border-gray-100 z-50 relative flex-shrink-0">

        <div class="flex items-center gap-8">
            <div class="flex items-center gap-3 cursor-pointer hover:opacity-80 transition">
                <img src="{{ asset('images/Vectoredvizo.svg') }}" alt="Logo" class="w-8 h-8">
                <span class="text-xl font-bold text-[#3B8773] tracking-wide">Edvizo.</span>
            </div>
            <div class="hidden md:flex h-6 w-px bg-gray-200"></div>
            <a href="/" class="hidden md:block text-gray-500 hover:text-[#3B8773] text-sm font-medium transition">Home</a>
        </div>

        <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="flex bg-gray-100 p-1 rounded-full border border-gray-200">
                <button id="tab-chat" onclick="switchTab('chat')" class="tab-btn tab-active px-6 py-2 rounded-full text-sm">
                    Percakapan
                </button>
                <button id="tab-analisis" onclick="switchTab('analisis')" class="tab-btn tab-inactive px-6 py-2 rounded-full text-sm tab-disabled">
                    Hasil Analisa
                </button>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                @auth
                    <p class="text-sm font-bold text-[#3B8773]">{{ Auth::user()->name }}</p>
                @else
                    <p class="text-sm font-bold text-[#3B8773]">Ghani Baskara</p>
                @endauth
                <p class="text-xs text-gray-500">Siswa</p>
            </div>
            <div class="relative group cursor-pointer">
                <div class="w-10 h-10 bg-[#E8F5F3] rounded-full flex items-center justify-center border border-white shadow-sm ring-2 ring-transparent hover:ring-[#3B8773]/20 transition">
                    <span class="text-[#3B8773] font-bold">
                        @auth
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @else
                            G
                        @endauth
                    </span>
                </div>
                <div class="absolute right-0 top-full mt-2 w-40 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50">
                    @auth
                        <a href="#" class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-t-xl transition">
                            Pengaturan
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-3 text-sm text-red-600 hover:bg-red-50 rounded-b-xl transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-3 text-sm text-[#3B8773] hover:bg-[#F0F9F7] rounded-t-xl transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 rounded-b-xl transition">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 relative overflow-hidden bg-white">

        <div id="view-chat" class="h-full flex flex-col relative">
            <div id="chat-container" class="flex-1 overflow-y-auto px-4 md:px-32 lg:px-60 py-8 scroll-smooth bg-[#FAFAFA] chat-content-area">

                <div id="welcome-screen" class="h-full flex flex-col items-center justify-center -mt-10 fade-in select-none">
                    <div class="w-24 h-24 bg-white rounded-[28px] flex items-center justify-center shadow-xl shadow-teal-50 mb-6 ring-1 ring-gray-50">
                        <img src="{{ asset('images/Vectoredvizo.svg') }}" class="w-12 h-12" alt="Bot">
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#3B8773] mb-3 tracking-tight">
                        Hai,
                        @auth
                            {{ Auth::user()->name }}
                        @else
                            Pengunjung
                        @endauth
                        !
                    </h1>
                    <p class="text-gray-400 text-lg font-light mb-10 text-center max-w-md leading-relaxed">
                        Ceritakan minatmu, saya akan bantu temukan jurusan impianmu.
                    </p>

                    <div class="flex flex-wrap justify-center gap-3">
                        <button onclick="fillInput('Saya ingin rekomendasi jurusan kuliah')" class="bg-white border border-gray-200 px-6 py-3 rounded-full text-sm font-medium text-gray-600 hover:border-[#3B8773] hover:text-[#3B8773] hover:shadow-md transition transform hover:-translate-y-0.5">
                            Minta Rekomendasi
                        </button>
                        <button onclick="fillInput('Apa jurusan yang cocok untuk orang introver?')" class="bg-white border border-gray-200 px-6 py-3 rounded-full text-sm font-medium text-gray-600 hover:border-[#3B8773] hover:text-[#3B8773] hover:shadow-md transition transform hover:-translate-y-0.5">
                            Konsultasi Minat
                        </button>
                    </div>
                </div>

                <div class="chat-spacer h-20"></div>
            </div>

            <div class="absolute bottom-0 left-0 w-full px-4 md:px-32 lg:px-60 pb-10 pt-12 bg-gradient-to-t from-[#FAFAFA] via-[#FAFAFA]/80 to-transparent pointer-events-none flex justify-center z-20">
                <div class="w-full max-w-4xl pointer-events-auto">
                    <div class="bg-white p-2 rounded-[2rem] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] border border-gray-200 flex items-center gap-3 transition-all focus-within:ring-4 focus-within:ring-teal-50 focus-within:border-[#3B8773]">

                        <form id="chat-form" class="flex-1 pl-6">
                            <input type="text" id="user-input"
                                class="w-full py-3.5 outline-none text-gray-700 placeholder-gray-400 bg-transparent font-medium"
                                placeholder="Ketik pesan Anda..." autocomplete="off">
                        </form>

                        <button id="send-btn" class="w-12 h-12 bg-[#3B8773] hover:bg-[#2E6B5B] text-white rounded-full flex items-center justify-center transition shadow-lg shadow-teal-100 transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg class="w-5 h-5 ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                        </button>
                    </div>
                    <p class="text-center text-xs text-gray-400 mt-4 font-medium">Edvizo AI dapat membuat kesalahan. Mohon verifikasi informasi penting.</p>
                </div>
            </div>
        </div>

        <div id="view-analisis" class="flex-1 hidden h-full overflow-y-auto px-4 md:px-32 lg:px-60 py-10 bg-white">
            <div class="max-w-5xl mx-auto fade-in space-y-10 pb-20">

                <div class="text-center">
                    <span class="inline-block bg-green-50 text-[#3B8773] px-5 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest border border-green-100 mb-4">Jurusan Terpilih</span>
                    <h1 id="analisis-judul" class="text-4xl md:text-5xl font-bold text-gray-900 mb-2 tracking-tight leading-tight">-</h1>
                </div>

                <div class="bg-gradient-to-br from-[#F0F9F7] to-white p-8 rounded-[2rem] border border-[#3B8773]/10 relative overflow-hidden shadow-sm group hover:shadow-md transition">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-48 h-48 bg-[#3B8773] rounded-full opacity-5 blur-3xl group-hover:opacity-10 transition"></div>
                    <div class="relative z-10">
                        <h3 class="font-bold text-xl mb-4 text-[#3B8773] flex items-center gap-3">
                            <span class="bg-white p-2 rounded-lg shadow-sm"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                            Kenapa Anda Cocok?
                        </h3>
                        <p id="analisis-alasan" class="text-gray-700 text-lg leading-relaxed font-light text-justify">
                            Analisis mendalam belum tersedia. Silakan lakukan fiksasi jurusan terlebih dahulu.
                        </p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-lg transition duration-300">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center text-green-600 font-bold text-xl shadow-inner">S</div>
                            <h3 class="font-bold text-xl text-gray-800">Strengths <span class="block text-xs text-gray-400 font-normal mt-0.5">Kekuatan Internal</span></h3>
                        </div>
                        <ul id="swot-s" class="space-y-3 text-gray-600 list-disc list-outside pl-5 marker:text-green-500"></ul>
                    </div>
                    <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-lg transition duration-300">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center text-red-600 font-bold text-xl shadow-inner">W</div>
                            <h3 class="font-bold text-xl text-gray-800">Weaknesses <span class="block text-xs text-gray-400 font-normal mt-0.5">Kelemahan Internal</span></h3>
                        </div>
                        <ul id="swot-w" class="space-y-3 text-gray-600 list-disc list-outside pl-5 marker:text-red-500"></ul>
                    </div>
                    <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-lg transition duration-300">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-xl shadow-inner">O</div>
                            <h3 class="font-bold text-xl text-gray-800">Opportunities <span class="block text-xs text-gray-400 font-normal mt-0.5">Peluang Eksternal</span></h3>
                        </div>
                        <ul id="swot-o" class="space-y-3 text-gray-600 list-disc list-outside pl-5 marker:text-blue-500"></ul>
                    </div>
                    <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-lg transition duration-300">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600 font-bold text-xl shadow-inner">T</div>
                            <h3 class="font-bold text-xl text-gray-800">Threats <span class="block text-xs text-gray-400 font-normal mt-0.5">Tantangan Eksternal</span></h3>
                        </div>
                        <ul id="swot-t" class="space-y-3 text-gray-600 list-disc list-outside pl-5 marker:text-orange-500"></ul>
                    </div>
                </div>

                <div class="flex justify-center pt-8">
                    <button onclick="switchTab('chat')" class="text-[#3B8773] font-semibold hover:text-[#2A6E5C] flex items-center gap-2 transition px-6 py-3 rounded-full hover:bg-green-50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Percakapan
                    </button>
                </div>
            </div>
        </div>

    </main>

    <script>
        // DOM Elements
        const chatContainer = document.getElementById('chat-container');
        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');
        const sendBtn = document.getElementById('send-btn');
        const welcomeScreen = document.getElementById('welcome-screen');
        const tabChat = document.getElementById('tab-chat');
        const tabAnalisis = document.getElementById('tab-analisis');
        const viewChat = document.getElementById('view-chat');
        const viewAnalisis = document.getElementById('view-analisis');

        let chatHistory = [];
        let isFirstMessage = true;
        let recommendationsMap = {};

        // --- GLOBAL FUNCTIONS ---
        window.fillInput = (text) => { userInput.value = text; handleChat(); };
        window.rerollRecommendation = () => fillInput("Berikan rekomendasi jurusan alternatif yang berbeda dan lain dari sebelumnya");

        window.fixRecommendation = (recId) => {
            const data = recommendationsMap[recId];
            if (!data) return alert("Data analisis kadaluarsa atau tidak ditemukan.");

            // Populate Analisis
            document.getElementById('analisis-judul').textContent = data.jurusan;
            document.getElementById('analisis-alasan').textContent = data.alasan_cocok;

            const renderList = (id, items) => {
                document.getElementById(id).innerHTML = items?.map(i => `<li class="flex gap-3"><span class="text-[#3B8773] mt-1.5">•</span><span>${i}</span></li>`).join('') || '';
            };

            renderList('swot-s', data.swot.strengths);
            renderList('swot-w', data.swot.weaknesses);
            renderList('swot-o', data.swot.opportunities);
            renderList('swot-t', data.swot.threats);

            // Activate Tab
            tabAnalisis.disabled = false;
            tabAnalisis.classList.remove('tab-disabled', 'tab-inactive');
            tabAnalisis.classList.add('tab-active');

            tabChat.classList.remove('tab-active');
            tabChat.classList.add('tab-inactive');

            switchTab('analisis');
        };

        window.switchTab = (tab) => {
            if (tab === 'chat') {
                viewChat.classList.remove('hidden');
                viewAnalisis.classList.add('hidden');

                tabChat.classList.add('tab-active');
                tabChat.classList.remove('tab-inactive');

                tabAnalisis.classList.remove('tab-active');
                tabAnalisis.classList.add('tab-inactive');

                setTimeout(() => chatContainer.scrollTop = chatContainer.scrollHeight, 100);
            } else {
                viewAnalisis.classList.remove('hidden');
                viewChat.classList.add('hidden');

                tabAnalisis.classList.add('tab-active');
                tabAnalisis.classList.remove('tab-inactive');

                tabChat.classList.remove('tab-active');
                tabChat.classList.add('tab-inactive');
            }
        };

        // --- CHAT ENGINE ---
        const handleChat = async (e) => {
            if (e) e.preventDefault();
            const message = userInput.value.trim();
            if (!message) return;

            if (isFirstMessage) {
                welcomeScreen.style.display = 'none';
                isFirstMessage = false;
            }

            appendMessage('user', message);
            userInput.value = '';
            sendBtn.disabled = true;
            const loadingId = showLoading();
            scrollToBottom();

            try {
                const response = await fetch("{{ route('chatbot.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ message, history: chatHistory })
                });

                const data = await response.json();
                document.getElementById(loadingId).remove();

                if (data.type === 'recommendation') {
                    const recId = 'rec_' + Date.now();
                    recommendationsMap[recId] = data.data;
                    appendCard(data.data, recId);
                } else {
                    appendMessage('bot', data.reply);
                    chatHistory.push({ role: 'user', text: message });
                    chatHistory.push({ role: 'model', text: data.reply });
                }
                scrollToBottom();

            } catch (error) {
                document.getElementById(loadingId)?.remove();
                appendMessage('bot', 'Maaf, koneksi terputus.');
            } finally {
                sendBtn.disabled = false;
                userInput.focus();
            }
        };

        sendBtn.addEventListener('click', handleChat);
        chatForm.addEventListener('submit', handleChat);

        function appendMessage(sender, text) {
            const div = document.createElement('div');
            const isUser = sender === 'user';
            div.className = `flex w-full mb-6 ${isUser ? 'justify-end' : 'justify-start'} fade-in`;

            const botIcon = `
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center mr-4 shadow-sm overflow-hidden self-end md:self-start">
                    <img src="{{ asset('images/Vectoredvizo.svg') }}" class="w-6 h-6" alt="Bot">
                </div>`;

            const bubbleClass = isUser
                ? 'bg-white text-gray-700 border border-gray-200 rounded-2xl rounded-tr-sm shadow-sm'
                : 'bg-[#3B8773] text-white rounded-2xl rounded-tl-sm shadow-md';

            const formattedText = text.replace(/\n/g, '<br>');

            div.innerHTML = `
                ${!isUser ? botIcon : ''}
                <div class="${bubbleClass} max-w-[85%] md:max-w-[70%] p-5 text-[15px] leading-relaxed">
                    ${formattedText}
                </div>
            `;
            const spacer = document.querySelector('.chat-spacer');
            if(spacer) chatContainer.insertBefore(div, spacer); else chatContainer.appendChild(div);
        }

        function appendCard(data, recId) {
            const div = document.createElement('div');
            div.className = `flex w-full mb-10 justify-start fade-in`;
            div.innerHTML = `
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center mr-4 shadow-sm overflow-hidden self-start">
                    <img src="{{ asset('images/Vectoredvizo.svg') }}" class="w-6 h-6" alt="Bot">
                </div>
                <div class="bg-white border border-gray-100 rounded-[28px] shadow-xl w-full max-w-[380px] overflow-hidden hover:shadow-2xl transition-all duration-300 ring-1 ring-gray-50">
                    <div class="bg-[#3B8773] p-7 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <p class="text-xs font-bold uppercase tracking-widest opacity-80 mb-1">Rekomendasi Utama</p>
                            <h3 class="text-2xl font-bold leading-tight">${data.jurusan}</h3>
                        </div>
                        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-white opacity-10 rounded-full"></div>
                        <div class="absolute top-4 right-4 opacity-20">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path d="M12 14l9-5-9-5-9 5 9 5z"/></svg>
                        </div>
                    </div>
                    <div class="p-7">
                        <p class="text-sm text-gray-600 leading-relaxed mb-8 font-medium border-l-4 border-[#3B8773] pl-4">${data.deskripsi}</p>
                        <div class="flex gap-3">
                            <button onclick="window.rerollRecommendation()" class="flex-1 py-3.5 rounded-xl border border-gray-200 text-gray-500 text-xs font-bold uppercase tracking-wide hover:bg-gray-50 hover:text-gray-700 transition flex justify-center items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Reroll
                            </button>
                            <button onclick="window.fixRecommendation('${recId}')" class="flex-1 py-3.5 rounded-xl bg-[#3B8773] text-white text-xs font-bold uppercase tracking-wide hover:bg-[#2E6B5B] transition shadow-lg shadow-teal-200/50 flex justify-center items-center gap-2 transform active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Fiksasi
                            </button>
                        </div>
                    </div>
                </div>`;
            const spacer = document.querySelector('.chat-spacer');
            if(spacer) chatContainer.insertBefore(div, spacer); else chatContainer.appendChild(div);
        }

        function showLoading() {
            const id = 'loading-' + Date.now();
            const div = document.createElement('div');
            div.id = id;
            div.className = 'flex w-full mb-6 justify-start fade-in';
            div.innerHTML = `
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center mr-4 shadow-sm overflow-hidden">
                    <img src="{{ asset('images/Vectoredvizo.svg') }}" class="w-6 h-6 opacity-50 grayscale" alt="Bot">
                </div>
                <div class="bg-white px-5 py-4 rounded-2xl rounded-tl-sm shadow-sm flex items-center gap-1.5 border border-gray-100">
                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></div>
                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                </div>`;
            const spacer = document.querySelector('.chat-spacer');
            if(spacer) chatContainer.insertBefore(div, spacer); else chatContainer.appendChild(div);
            return id;
        }

        function scrollToBottom() {
            setTimeout(() => { chatContainer.scrollTop = chatContainer.scrollHeight; }, 50);
        }
    </script>
</body>
</html>
