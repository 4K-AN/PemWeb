<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Akademik - Edvizor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ... (tetapkan semua CSS yang sama seperti file asli) ... */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #d6d3d1 0%, #a7f3d0 100%); min-height: 100vh; overflow-x: hidden; }
        .navbar { background: #f4f4f5; border: 2px solid #166534; border-radius: 32px; padding: 12px 24px; margin: 48px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 9px 20px rgba(0,0,0,0.32); }
        .logo-section { background: linear-gradient(180deg, #166534 0%, #64748b 100%); border-radius: 32px; padding: 8px 24px; display: flex; align-items: center; gap: 16px; }
        .logo-text { color: #f4f4f5; font-size: 24px; font-weight: bold; }
        .nav-menu { display: flex; gap: 32px; align-items: center; }
        .nav-item { color: #166534; font-size: 18px; font-weight: bold; cursor: pointer; transition: opacity 0.3s; }
        .nav-item:hover { opacity: 0.7; }
        .main-content { display: flex; padding: 0 48px; gap: 48px; align-items: center; }
        .calendar-container { background: #171717; border-radius: 12px; padding: 24px; width: 520px; box-shadow: 0 6px 6px rgba(0,0,0,0.25); border: 1.5px solid rgba(161, 161, 170, 0.4); }
        .calendar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
        .calendar-title { color: white; font-size: 36px; font-weight: 500; }
        .calendar-nav { display: flex; gap: 12px; }
        .nav-btn { background: transparent; border: 1.5px solid white; color: white; width: 24px; height: 24px; border-radius: 4px; cursor: pointer; font-size: 16px; display: flex; align-items: center; justify-content: center; }
        .calendar-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 24px 48px; }
        .calendar-day { width: 40px; height: 40px; border-radius: 45px; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; font-weight: 500; cursor: pointer; transition: transform 0.2s; text-decoration: none; }
        .calendar-day:hover { transform: scale(1.1); }
        .calendar-day.default { background: #171717; }
        .calendar-day.highlighted { background: #0d9488; }
        .calendar-day.today { background: #000000; }
        .calendar-day.inactive { opacity: 0.2; pointer-events: none; }
        .info-section { flex: 1; padding: 48px; }
        .info-title { color: black; font-size: 60px; font-weight: 400; line-height: 1.2; margin-bottom: 32px; }
        .info-description { color: black; font-size: 20px; text-align: justify; line-height: 1.6; }
        .footer { background: #fafafa; padding: 28px 160px; margin-top: 120px; }
        .footer-links { display: flex; gap: 32px; margin-bottom: 24px; opacity: 0.75; }
        .footer-link { color: #1f2937; font-size: 16px; font-weight: 500; cursor: pointer; }
        .footer-divider { height: 1px; background: rgba(0,0,0,0.1); margin: 24px 0; }
        .footer-contact { display: flex; justify-content: space-between; }
        .contact-item { display: flex; gap: 12px; align-items: center; font-size: 16px; font-weight: 500; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo-section">
            <div class="logo-text">Edvizo.</div>
        </div>
        <div class="nav-menu">
            <div class="nav-item">Konsultasi</div>
            <div class="nav-item">Layanan Informasi</div>
            <div class="nav-item">Kelompok 5</div>
        </div>
    </nav>
    
    <div class="main-content">
        <div class="calendar-container">
            <div class="calendar-header">
                <div>
                    <div style="color: white; font-size: 24px; font-weight: 500;">March</div>
                    <div class="calendar-title">2025</div>
                </div>
                <div class="calendar-nav">
                    <button class="nav-btn">◀</button>
                    <button class="nav-btn">▶</button>
                </div>
            </div>

            <div class="calendar-grid">
                <!-- Week 1 -->
                <div class="calendar-day inactive">27</div>
                <div class="calendar-day inactive">28</div>

                <!-- clickable highlighted dates become <a href="..."> -->
                <a href="{{ route('akademik.detail', ['day' => 1]) }}" class="calendar-day highlighted" style="color:inherit;">1</a>
                <a href="{{ route('akademik.detail', ['day' => 2]) }}" class="calendar-day highlighted" style="color:inherit;">2</a>
                <div class="calendar-day default">3</div>
                <div class="calendar-day default">4</div>
                
                <!-- Week 2 -->
                <div class="calendar-day default">5</div>
                <div class="calendar-day default">6</div>
                <div class="calendar-day default">7</div>
                <div class="calendar-day default">8</div>
                <div class="calendar-day default">9</div>
                <div class="calendar-day default">10</div>
                
                <!-- Week 3 -->
                <div class="calendar-day default">11</div>
                <div class="calendar-day default">12</div>
                <div class="calendar-day default">13</div>
                <div class="calendar-day default">14</div>

                <!-- clickable -->
                <a href="{{ route('akademik.detail', ['day' => 15]) }}" class="calendar-day highlighted" style="color:inherit;">15</a>

                <a href="{{ route('akademik.detail', ['day' => 16]) }}" class="calendar-day default" style="color:inherit;">16</a>
                
                <!-- Week 4 -->
                <a href="{{ route('akademik.detail', ['day' => 17]) }}" class="calendar-day today" style="color:inherit;">17</a>
                <div class="calendar-day default">18</div>
                <div class="calendar-day default">19</div>

                <a href="{{ route('akademik.detail', ['day' => 20]) }}" class="calendar-day highlighted" style="color:inherit;">20</a>

                <div class="calendar-day default">21</div>
                <div class="calendar-day default">22</div>
                
                <!-- Week 5 -->
                <div class="calendar-day default">23</div>
                <div class="calendar-day default">24</div>
                <div class="calendar-day default">25</div>
                <div class="calendar-day default">26</div>
                <div class="calendar-day default">27</div>

                <a href="{{ route('akademik.detail', ['day' => 28]) }}" class="calendar-day highlighted" style="color:inherit;">28</a>
                
                <!-- Week 6 -->
                <div class="calendar-day default">29</div>

                <a href="{{ route('akademik.detail', ['day' => 30]) }}" class="calendar-day highlighted" style="color:inherit;">30</a>

                <div class="calendar-day default">31</div>
                <div class="calendar-day inactive">1</div>
                <div class="calendar-day inactive">2</div>
                <div class="calendar-day inactive">3</div>
            </div>
        </div>
        
        <div class="info-section">
            <div class="info-title">
                Kalender<br>Akademik
            </div>
            <div class="info-description">
                Kalender akademik adalah jadwal resmi kegiatan pendidikan dalam satu tahun ajaran, yang mencakup waktu perkuliahan, ujian, libur, dan kegiatan akademik lainnya.
            </div>
        </div>
    </div>
    
    <footer class="footer">
        <div class="footer-links">
            <div class="footer-link">Courses</div>
            <div class="footer-link">Experts</div>
            <div class="footer-link">About us</div>
            <div class="footer-link">About us</div>
            <div class="footer-link">About us</div>
        </div>
        <div class="footer-divider"></div>
        <div class="footer-contact">
            <div class="contact-item">
                <span>💬</span>
                <span style="color: white;">Let's chat</span>
            </div>
            <div class="contact-item">
                <span>📧</span>
                <span>info@logoipsum.com</span>
            </div>
        </div>
    </footer>
</body>
</html>
