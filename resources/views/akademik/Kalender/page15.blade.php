<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail 15 Maret 2025 - Edvizor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f4f5;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Abstract background shapes */
        .bg-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }
        
        .shape {
            position: absolute;
            background: linear-gradient(135deg, #64748b, #4b5563);
            opacity: 0.15;
        }
        
        .shape1 {
            width: 400px;
            height: 400px;
            top: -100px;
            left: -100px;
            transform: rotate(45deg);
        }
        
        .shape2 {
            width: 300px;
            height: 300px;
            top: 100px;
            right: -80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10b981, #064e3b);
        }
        
        .shape3 {
            width: 250px;
            height: 250px;
            bottom: 50px;
            left: 10%;
            transform: rotate(25deg);
            background: linear-gradient(135deg, #a7f3d0, #6ee7b7);
        }
        
        /* Navbar */
        .navbar {
            background: #f4f4f5;
            border: 2px solid #166534;
            border-radius: 32px;
            padding: 12px 24px;
            margin: 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 9px 20px rgba(0,0,0,0.32);
            position: relative;
            z-index: 100;
        }
        
        .logo-section {
            background: linear-gradient(180deg, #166534 0%, #64748b 100%);
            border-radius: 32px;
            padding: 8px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .logo-text {
            color: #f4f4f5;
            font-size: 24px;
            font-weight: bold;
        }
        
        .nav-menu {
            display: flex;
            gap: 32px;
            align-items: center;
        }
        
        .nav-item {
            color: #166534;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: opacity 0.3s;
            text-decoration: none;
        }
        
        .nav-item:hover {
            opacity: 0.7;
        }
        
        .user-profile {
            background: #f4f4f5;
            border: 2px solid #166534;
            border-radius: 32px;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: #d4d4d8;
            border-radius: 50%;
        }
        
        .user-name {
            color: #166534;
            font-size: 14px;
            font-weight: bold;
        }
        
        /* Main Content */
        .main-content {
            display: flex;
            gap: 32px;
            padding: 0 48px 48px;
            max-width: 1440px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        /* Left Calendar Section */
        .calendar-section {
            flex: 1;
            background: linear-gradient(90deg, #d6d3d1, #d1f4e0);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            min-height: 600px;
            position: relative;
        }
        
        .calendar-header-mini {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 32px;
        }
        
        .month-badge {
            background: linear-gradient(135deg, #166534, #0d9488);
            color: white;
            padding: 12px 24px;
            border-radius: 16px;
            font-weight: 600;
            font-size: 20px;
        }
        
        .year-text {
            font-size: 32px;
            font-weight: 600;
            color: #064e3b;
            margin-top: 8px;
        }
        
        .preview-label {
            text-align: right;
            font-size: 12px;
            color: #64748b;
            margin-bottom: 4px;
        }
        
        .preview-title {
            font-weight: 600;
            color: #1e293b;
        }
        
        /* Mini Calendar Grid */
        .mini-calendar {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 16px;
            margin-top: 40px;
        }
        
        .mini-day {
            width: 48px;
            height: 48px;
            background: #171717;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 500;
            font-size: 16px;
            transition: transform 0.2s;
        }
        
        .mini-day:hover {
            transform: scale(1.1);
        }
        
        .mini-day.inactive {
            opacity: 0.3;
        }
        
        .mini-day.highlighted {
            background: #0d9488;
        }
        
        .back-arrow {
            position: absolute;
            top: 40px;
            left: -20px;
            font-size: 24px;
            color: #1e293b;
        }
        
        /* Right Detail Section */
        .detail-section {
            width: 420px;
            background: white;
            border-radius: 24px;
            border: 2px solid #166534;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            position: relative;
        }
        
        .detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .detail-month {
            color: #94a3b8;
            font-weight: 600;
            font-size: 20px;
        }
        
        .detail-year {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
        }
        
        .date-label {
            font-size: 14px;
            color: #64748b;
            font-weight: 600;
        }
        
        .big-date {
            font-size: 180px;
            font-weight: 700;
            color: #1e293b;
            text-align: center;
            line-height: 1;
            margin: 24px 0;
            text-shadow: 2px 2px 0 rgba(0,0,0,0.05);
        }
        
        /* Event Cards */
        .event-card {
            background: linear-gradient(180deg, #166534 0%, #64748b 100%);
            border: 2px solid #64748b;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .event-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }
        
        .event-number {
            width: 36px;
            height: 36px;
            background: #d4d4d8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: black;
            font-size: 14px;
            flex-shrink: 0;
        }
        
        .event-info {
            flex: 1;
        }
        
        .event-title {
            color: #f4f4f5;
            font-size: 12px;
            font-weight: 500;
            line-height: 1.4;
        }
        
        /* Action Button */
        .btn-reminder {
            width: 100%;
            background: linear-gradient(180deg, #166534 0%, #64748b 100%);
            border: 2px solid #64748b;
            border-radius: 24px;
            padding: 16px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            margin-top: 24px;
            transition: transform 0.3s, box-shadow 0.3s;
            display: block;
            text-decoration: none;
        }
        
        .btn-reminder:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(22, 101, 52, 0.4);
        }
        
        /* Copyright */
        .copyright {
            text-align: center;
            color: #166534;
            font-weight: bold;
            font-size: 14px;
            padding: 24px;
            position: relative;
            z-index: 1;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .main-content {
                flex-direction: column;
            }
            
            .detail-section {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="bg-shapes">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
    </div>
    
    <nav class="navbar">
        <div class="logo-section">
            <div class="logo-text">Edvizo.</div>
        </div>
        <div class="nav-menu">
            <a href="#" class="nav-item">Konsultasi</a>
            <a href="#" class="nav-item">Layanan Informasi</a>
            <div class="nav-item">Kelompok 5</div>
        </div>
    </nav>
    
    <div class="user-profile" style="position: absolute; top: 48px; right: 48px; z-index: 101;">
        <div class="user-avatar"></div>
        <div class="user-name">Ghani Baskara Syah</div>
    </div>
    
    <div class="main-content">
        <div class="calendar-section">
            <span class="back-arrow">◀</span>
            
            <div class="calendar-header-mini">
                <div>
                    <div class="month-badge">March</div>
                    <div class="year-text">2025</div>
                </div>
                <div style="text-align: right;">
                    <div class="preview-label">Preview</div>
                    <div class="preview-title">Kalender Akademik</div>
                </div>
            </div>
            
            <div class="mini-calendar">
                <div class="mini-day inactive">27</div>
                <div class="mini-day inactive">28</div>
                <div class="mini-day">1</div>
                <div class="mini-day">2</div>
                <div class="mini-day">3</div>
                <div class="mini-day">4</div>
                
                <div class="mini-day">5</div>
                <div class="mini-day">6</div>
                <div class="mini-day">7</div>
                <div class="mini-day">8</div>
                <div class="mini-day">9</div>
                <div class="mini-day">10</div>
                
                <div class="mini-day">11</div>
                <div class="mini-day">12</div>
                <div class="mini-day">13</div>
                <div class="mini-day">14</div>
                <div class="mini-day highlighted">15</div>
                <div class="mini-day">16</div>
                
                <div class="mini-day">17</div>
                <div class="mini-day">18</div>
                <div class="mini-day">19</div>
                <div class="mini-day">20</div>
                <div class="mini-day">21</div>
                <div class="mini-day">22</div>
                
                <div class="mini-day">23</div>
                <div class="mini-day">24</div>
                <div class="mini-day">25</div>
                <div class="mini-day">26</div>
                <div class="mini-day">27</div>
                <div class="mini-day">28</div>
                
                <div class="mini-day">29</div>
                <div class="mini-day">30</div>
                <div class="mini-day">31</div>
                <div class="mini-day inactive">1</div>
                <div class="mini-day inactive">2</div>
                <div class="mini-day inactive">3</div>
            </div>
        </div>
        
        <div class="detail-section">
            <div class="detail-header">
                <div>
                    <div class="detail-month">March</div>
                    <div class="detail-year">2025</div>
                </div>
                <div class="date-label">Tanggal</div>
            </div>
            
            <div class="big-date">15</div>
            
            <div class="event-card">
                <div class="event-number">1</div>
                <div class="event-info">
                    <div class="event-title">Hari Perempuan Internasional</div>
                </div>
            </div>
            
            <div class="event-card">
                <div class="event-number">2</div>
                <div class="event-info">
                    <div class="event-title">Beasiswa Bakti Madiun Selatan</div>
                </div>
            </div>
            
            <a href="#" class="btn-reminder">Set Reminder</a>
        </div>
    </div>
    
    <div class="copyright">© · Copyright by Edvizo.</div>
</body>
</html>