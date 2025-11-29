<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#3B8773">
    <title>UI Test - Edvizo</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* --- 1. RESET & VARIABLES --- */
        :root {
            --primary: #3B8773;       /* Hijau Edvizo */
            --primary-dark: #2A6E5C;
            --primary-light: #E8F5F3;
            --text-main: #1F2937;
            --text-muted: #6B7280;
            --border: #E5E7EB;
            --bg: #F8FAFC;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg);
            height: 100vh;
            width: 100%;
            display: flex;
            overflow: hidden;
            color: var(--text-main);
        }

        /* --- 2. LAYOUT --- */
        .app-layout {
            display: flex;
            width: 100%;
            height: 100%;
        }

        /* Sidebar Kiri */
        .sidebar-left {
            width: 260px;
            background-color: var(--primary);
            color: white;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            overflow-y: auto;
            height: 100vh;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: white;
            position: relative;
            width: 100%;
            height: 100vh;
        }

        /* Sidebar Kanan */
        .sidebar-right {
            width: 300px;
            background: white;
            border-left: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            height: 100vh;
        }

        /* Responsive Logic */
        @media (max-width: 1024px) { .sidebar-right { display: none; } }
        @media (max-width: 768px) { .sidebar-left { display: none; } }

        /* --- KOMPONEN --- */

        /* Brand */
        .brand { padding: 25px; display: flex; align-items: center; gap: 12px; }
        .logo-box { background: rgba(255,255,255,0.2); padding: 6px; border-radius: 8px; display: flex; }
        .logo-svg { width: 24px; height: 24px; fill: white; }
        .brand-text { font-size: 20px; font-weight: 700; letter-spacing: 0.5px; }

        /* Navigasi */
        .nav { padding: 0 15px; margin-top: 10px; }
        .nav-item {
            display: flex; align-items: center; gap: 12px; padding: 12px 15px;
            color: rgba(255,255,255,0.85); text-decoration: none; border-radius: 12px;
            margin-bottom: 5px; font-size: 14px; transition: 0.2s; cursor: pointer;
        }
        .nav-item:hover { background: rgba(255,255,255,0.1); color: white; }
        .nav-item.active { background: white; color: var(--primary); font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .nav-icon { width: 20px; height: 20px; stroke-width: 2; fill: none; stroke: currentColor; }

        /* Header */
        .header {
            height: 70px; border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 25px; background: white; z-index: 10;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--text-muted); }
        .badge { background: var(--primary-light); color: var(--primary); padding: 4px 12px; border-radius: 20px; font-weight: 600; font-size: 12px; }

        .user-profile { display: flex; align-items: center; gap: 10px; cursor: pointer; }
        .user-text { text-align: right; display: none; }
        @media (min-width: 768px) { .user-text { display: block; } }
        .user-name { font-weight: 700; font-size: 13px; }
        .user-role { font-size: 11px; color: var(--text-muted); }
        .avatar { width: 38px; height: 38px; background: #eee; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center; font-weight: bold; color: var(--primary); overflow: hidden; }

        /* Chat Area */
        .chat-area {
            flex: 1; overflow-y: auto; padding: 20px; padding-bottom: 100px;
            background-color: #FAFAFA; scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        /* Welcome State */
        .welcome {
            height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 20px;
        }
        .mascot-box {
            width: 80px; height: 80px; background: white; border-radius: 24px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-bottom: 20px;
        }
        .mascot-svg-lg { width: 40px; height: 40px; fill: var(--primary); }
        .welcome h2 { font-size: 24px; margin-bottom: 5px; color: var(--text-main); }
        .welcome p { color: var(--text-muted); font-size: 15px; }

        /* Bubbles */
        .msg-row { display: flex; margin-bottom: 20px; width: 100%; animation: fadeIn 0.3s ease; }
        .msg-row.bot { justify-content: flex-start; }
        .msg-row.user { justify-content: flex-end; }

        .msg-bubble {
            max-width: 85%; padding: 12px 18px; border-radius: 18px;
            font-size: 14px; line-height: 1.5; position: relative; word-wrap: break-word;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        @media (min-width: 768px) { .msg-bubble { max-width: 70%; font-size: 15px; } }

        .msg-bubble.bot {
            background-color: var(--primary); color: white; border-top-left-radius: 4px;
            box-shadow: 0 2px 5px rgba(59, 135, 115, 0.2);
        }
        .msg-bubble.user {
            background-color: white; color: var(--text-main); border: 1px solid var(--border);
            border-top-right-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }

        .bot-icon-small {
            width: 32px; height: 32px; background: white; border: 1px solid var(--border);
            border-radius: 50%; margin-right: 10px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
        }
        .bot-icon-small svg { width: 16px; height: 16px; fill: var(--primary); }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* Input Area Floating */
        .input-container {
            position: absolute; bottom: 0; left: 0; width: 100%;
            background: linear-gradient(to top, #FAFAFA 80%, transparent);
            padding: 20px; display: flex; justify-content: center;
            z-index: 10;
        }

        .input-box {
            background: white; width: 100%; max-width: 800px;
            border: 1px solid var(--border); border-radius: 50px;
            padding: 5px 5px 5px 20px; display: flex; align-items: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05); transition: 0.3s;
        }
        .input-box:focus-within { border-color: var(--primary); box-shadow: 0 5px 25px rgba(59, 135, 115, 0.15); }

        .chat-input {
            flex: 1; border: none; outline: none; font-size: 15px;
            color: var(--text-main); font-family: inherit; background: transparent;
            padding: 12px 0;
        }
        .chat-input::placeholder {
            color: var(--text-muted);
            opacity: 0.7;
        }

        .send-btn {
            width: 42px; height: 42px; background: var(--primary); border: none;
            border-radius: 50%; color: white; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: 0.2s; flex-shrink: 0;
        }
        .send-btn:hover { background: var(--primary-dark); transform: scale(1.05); }
        .send-btn:active { transform: scale(0.95); }

        /* History Sidebar */
        .history-header { padding: 25px; border-bottom: 1px solid #f3f4f6; font-weight: 700; color: var(--text-main); }
        .history-label { font-size: 11px; font-weight: 700; color: var(--text-muted); margin: 15px 20px 10px; text-transform: uppercase; }
        .history-card {
            margin: 5px 20px; padding: 15px; border-radius: 12px; cursor: pointer; transition: 0.2s;
        }
        .history-card.active { background: var(--primary); color: white; box-shadow: 0 4px 10px rgba(59, 135, 115, 0.2); }
        .history-card.inactive { background: #F9FAFB; color: var(--text-main); }
        .history-card.inactive:hover { background: var(--primary-light); }

        .h-title { font-weight: 600; font-size: 13px; margin-bottom: 3px; }
        .h-sub { font-size: 11px; opacity: 0.8; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        /* Footer Sidebar */
        .sidebar-footer { padding: 20px; border-top: 1px solid rgba(255,255,255,0.1); }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .app-layout {
                flex-direction: column;
            }

            .sidebar-left, .sidebar-right {
                width: 100%;
                height: auto;
                max-height: 60vh;
            }

            .sidebar-right {
                border-left: none;
                border-top: 1px solid var(--border);
            }

            .msg-bubble {
                max-width: 90%;
            }

            .input-container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="app-layout">

    <aside class="sidebar-left">
        <div class="brand">
            <div class="logo-box">
                <svg class="logo-svg" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-2 1V17l7 3.5 7-3.5v-5l-2-1-5 2.5z"/></svg>
            </div>
            <span class="brand-text">Edvizo.</span>
        </div>

        <nav class="nav">
            <a class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Home
            </a>
            <a class="nav-item active">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                Konsultasi
            </a>
            <a class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                Layanan Informasi
            </a>
        </nav>

        <div style="flex:1;"></div>

        <div class="sidebar-footer">
            <a class="nav-item" style="margin:0; color:white;">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Keluar
            </a>
        </div>
    </aside>

    <div class="main-content">
        <header class="header">
            <div class="breadcrumb">
                <span>Konsultasi</span>
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                <span class="badge">Percakapan</span>
            </div>
            <div class="user-profile">
                <div class="user-text">
                    <div class="user-name">Ghani Baskara</div>
                    <div class="user-role">Siswa</div>
                </div>
                <div class="avatar">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
            </div>
        </header>

        <div id="chat-container" class="chat-area">
            <div id="welcome-screen" class="welcome">
                <div class="mascot-box">
                    <svg class="mascot-svg-lg" viewBox="0 0 24 24"><path d="M12 2a2 2 0 0 1 2 2c0 .74-.4 1.39-1 1.73V7h1a7 7 0 0 1 7 7h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h1a7 7 0 0 1 7-7h1V5.73c-.6-.34-1-.99-1-1.73a2 2 0 0 1 2-2M7.5 13A2.5 2.5 0 0 0 5 15.5A2.5 2.5 0 0 0 7.5 18a2.5 2.5 0 0 0 2.5-2.5A2.5 2.5 0 0 0 7.5 13m9 0a2.5 2.5 0 0 0-2.5 2.5a2.5 2.5 0 0 0 2.5 2.5a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-2.5-2.5"/></svg>
                </div>
                <h2>Hai, Ghani!</h2>
                <p>Siap untuk mencari tahu minat Anda?</p>
            </div>
        </div>

        <div class="input-container">
            <div class="input-box">
                <input type="text" id="user-input" class="chat-input" placeholder="Ketik pesan..." autocomplete="off">
                <button id="send-btn" class="send-btn">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <aside class="sidebar-right">
        <div class="history-header">Riwayat Percakapan</div>

        <div style="flex: 1; overflow-y: auto;">
            <div class="history-label">HARI INI</div>
            <div class="history-card active">
                <div class="h-title">Rekomendasi Jurusan</div>
                <div class="h-sub">Saya suka matematika...</div>
            </div>

            <div class="history-label">KEMARIN</div>
            <div class="history-card inactive">
                <div class="h-title">Info Beasiswa</div>
                <div class="h-sub">Cari beasiswa dalam negeri</div>
            </div>
        </div>

        <div style="padding: 20px; border-top: 1px solid #eee;">
            <button onclick="location.reload()" style="width: 100%; padding: 12px; background: var(--primary-light); color: var(--primary); border: none; border-radius: 12px; font-weight: 700; cursor: pointer; transition: all 0.2s;">
                Percakapan Baru
            </button>
        </div>
    </aside>

</div>

<script>
    const chatContainer = document.getElementById('chat-container');
    const userInput = document.getElementById('user-input');
    const sendBtn = document.getElementById('send-btn');
    const welcomeScreen = document.getElementById('welcome-screen');
    let isFirstMessage = true;

    // Fungsi Kirim Pesan (Simulasi UI)
    function handleSend() {
        const text = userInput.value.trim();
        if (!text) return;

        // Hilangkan Welcome Screen
        if (isFirstMessage) {
            welcomeScreen.style.display = 'none';
            isFirstMessage = false;
        }

        // 1. Tampilkan Pesan User
        addMessage(text, 'user');
        userInput.value = '';

        // 2. Tampilkan Loading Bot
        const loadingId = showLoading();

        // 3. Simulasi Balasan Bot (Delay 1.5 detik)
        setTimeout(() => {
            document.getElementById(loadingId).remove();
            // Balasan Dummy Statis
            addMessage("Ini adalah balasan dummy untuk preview UI. Tampilan bubble bot akan menyesuaikan panjang teks secara otomatis.", 'bot');
        }, 1500);
    }

    // Event Listeners
    sendBtn.addEventListener('click', handleSend);
    userInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') handleSend();
    });

    // Helper: Tambah Bubble ke Layar
    function addMessage(text, sender) {
        const div = document.createElement('div');
        div.className = `msg-row ${sender}`; // FIX: menggunakan backticks untuk template literal

        // Icon Bot jika pengirim adalah bot
        const botIcon = sender === 'bot' ? `
            <div class="bot-icon-small">
                <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:#3B8773"><path d="M12 2a2 2 0 0 1 2 2c0 .74-.4 1.39-1 1.73V7h1a7 7 0 0 1 7 7h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h1a7 7 0 0 1 7-7h1V5.73c-.6-.34-1-.99-1-1.73a2 2 0 0 1 2-2M7.5 13A2.5 2.5 0 0 0 5 15.5A2.5 2.5 0 0 0 7.5 18a2.5 2.5 0 0 0 2.5-2.5A2.5 2.5 0 0 0 7.5 13m9 0a2.5 2.5 0 0 0-2.5 2.5a2.5 2.5 0 0 0 2.5 2.5a2.5 2.5 0 0 0 2.5-2.5a2.5 2.5 0 0 0-2.5-2.5"/></svg>
            </div>` : '';

        div.innerHTML = `
            ${botIcon}
            <div class="msg-bubble ${sender}">
                ${text}
            </div>
        `;
        chatContainer.appendChild(div);
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Helper: Tampilkan Loading Animation
    function showLoading() {
        const id = 'loader-' + Date.now();
        const div = document.createElement('div');
        div.id = id;
        div.className = 'msg-row bot';
        div.innerHTML = `
            <div class="bot-icon-small">
                <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:#3B8773;opacity:0.5"><path d="M12 2a2 2 0 0 1 2 2c0 .74-.4 1.39-1 1.73V7h1a7 7 0 0 1 7 7h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h1a7 7 0 0 1 7-7h1V5.73c-.6-.34-1-.99-1-1.73a2 2 0 0 1 2-2"/></svg>
            </div>
            <div class="msg-bubble user" style="color:#9CA3AF; font-style:italic; border:none; background:transparent; padding:0;">
                sedang mengetik...
            </div>
        `;
        chatContainer.appendChild(div);
        chatContainer.scrollTop = chatContainer.scrollHeight;
        return id;
    }

    // Auto-focus pada input field saat halaman load
    document.addEventListener('DOMContentLoaded', function() {
        userInput.focus();
    });
</script>

</body>
</html>
