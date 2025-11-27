<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teknologi Informasi - Edvizor</title>
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
            overflow-x: hidden;
        }
        
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
        }
        
        .nav-item:hover {
            opacity: 0.7;
        }
        
        .hero-section {
            background: #64748b;
            height: 384px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 20px 14px 26px rgba(0,0,0,0.25);
        }
        
        .hero-title {
            text-align: center;
            font-size: 96px;
            font-weight: bold;
            line-height: 1.2;
        }
        
        .hero-title .white {
            color: white;
        }
        
        .hero-title .gray {
            color: #4b5563;
        }
        
        .scroll-indicator {
            text-align: center;
            padding: 40px 0;
            color: #64748b;
            font-size: 10px;
        }
        
        .section-bg {
            background: #64748b;
            padding: 80px 0;
            position: relative;
        }
        
        .section-title {
            text-align: center;
            font-size: 60px;
            font-weight: bold;
            color: #f4f4f5;
            margin-bottom: 60px;
        }
        
        .cards-container {
            display: flex;
            justify-content: center;
            gap: 32px;
            flex-wrap: wrap;
            padding: 0 48px;
            max-width: 1440px;
            margin: 0 auto;
        }
        
        .card {
            background: #f4f4f5;
            border-radius: 34px;
            padding: 96px 28px;
            width: 192px;
            min-height: 256px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            box-shadow: 15px 14px 12px rgba(0,0,0,0.25);
            transition: transform 0.3s;
        }
        
        .card:hover {
            transform: translateY(-8px);
        }
        
        .card-text {
            color: #64748b;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.4;
        }
        
        .gradient-section {
            background: linear-gradient(180deg, #64748b 0%, rgba(55, 65, 81, 0) 100%);
            padding: 80px 0;
        }
        
        .career-section {
            padding: 80px 48px;
        }
        
        .skills-section {
            padding: 80px 48px;
            background: #f4f4f5;
        }
        
        .skill-cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
            max-width: 1000px;
            margin: 60px auto 0;
        }
        
        .skill-card {
            background: #f4f4f5;
            border: 1px solid #4b5563;
            padding: 24px;
            min-height: 192px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        
        .skill-title {
            color: #4b5563;
            font-size: 16px;
            font-weight: 400;
        }
        
        .skill-description {
            color: #27272a;
            font-size: 12px;
            text-align: justify;
            line-height: 1.6;
        }
        
        .rating {
            display: flex;
            gap: 8px;
            margin-top: auto;
        }
        
        .star {
            width: 12px;
            height: 14px;
            background: #4b5563;
        }
        
        .star.empty {
            background: white;
            border: 1px solid #4b5563;
        }
        
        .conclusion-section {
            padding: 80px 128px;
            background: #f4f4f5;
        }
        
        .conclusion-title {
            text-align: center;
            font-size: 60px;
            font-weight: bold;
            color: #64748b;
            margin-bottom: 40px;
        }
        
        .conclusion-text {
            text-align: justify;
            font-size: 20px;
            color: black;
            line-height: 1.8;
        }
        
        .conclusion-text strong {
            font-weight: 600;
        }
        
        .footer {
            background: #fafafa;
            padding: 28px 160px;
        }
        
        .footer-links {
            display: flex;
            gap: 32px;
            margin-bottom: 24px;
            opacity: 0.75;
        }
        
        .footer-link {
            color: #1f2937;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
        }
        
        .footer-divider {
            height: 1px;
            background: rgba(0,0,0,0.1);
            margin: 24px 0;
        }
        
        .footer-contact {
            display: flex;
            justify-content: space-between;
        }
        
        .contact-item {
            display: flex;
            gap: 12px;
            align-items: center;
            font-size: 16px;
            font-weight: 500;
        }
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
    
    <div class="hero-section">
        <h1 class="hero-title">
            <div class="white">Teknologi</div>
            <div class="gray">INFORMASI</div>
        </h1>
    </div>
    
    <div class="scroll-indicator">
        ▼<br>Scroll with services
    </div>
    
    <section class="section-bg">
        <h2 class="section-title">Profesi</h2>
        <div class="cards-container">
            <div class="card">
                <div class="card-text">Software Engineer / Developer</div>
            </div>
            <div class="card">
                <div class="card-text">Data Scientist / Data Analyst</div>
            </div>
            <div class="card">
                <div class="card-text">Cloud Engineer / DevOps Engineer</div>
            </div>
            <div class="card">
                <div class="card-text">Cybersecurity Specialist</div>
            </div>
        </div>
        
        <div class="cards-container" style="margin-top: 32px;">
            <div class="card">
                <div class="card-text">AI Engineer / Machine Learning Engineer</div>
            </div>
            <div class="card">
                <div class="card-text">UI/UX Designer (Tech-Oriented)</div>
            </div>
            <div class="card">
                <div class="card-text">Product Manager (Tech Product)</div>
            </div>
            <div class="card">
                <div class="card-text">Software Engineer / Developer</div>
            </div>
        </div>
    </section>
    
    <section class="gradient-section">
        <h2 class="section-title">Jenjang Karir</h2>
        <div class="cards-container">
            <div class="card">
                <div class="card-text">🧩<br><br>Entry Level (Junior)</div>
            </div>
            <div class="card">
                <div class="card-text">🚀<br><br>Mid Level (Intermediate/Professional)</div>
            </div>
            <div class="card">
                <div class="card-text">🏆<br><br>Senior Level (Lead/Expert/Managerial)</div>
            </div>
        </div>
    </section>
    
    <section class="skills-section">
        <h2 class="section-title" style="color: #64748b;">Kebutuhan Skill</h2>
        
        <div class="skill-cards">
            <div class="skill-card">
                <div class="skill-title">Problem Solving & Computational Thinking</div>
                <div class="skill-description">
                    Kemampuan memecahkan masalah secara logis, sistematis, dan efisien adalah pondasi utama. 
                    Kamu harus terbiasa menganalisis masalah memecah jadi bagian kecil → merancang solusi algoritmik.
                </div>
                <div class="rating">
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                </div>
            </div>
            
            <div class="skill-card">
                <div class="skill-title">Programming & Software Engineering</div>
                <div class="skill-description">
                    Kemampuan menerjemahkan ide ke dalam kode yang rapi, efisien, dan bisa dikembangkan. 
                    Tidak hanya bisa "ngoding", tapi juga mengerti struktur proyek, arsitektur software, dan kolaborasi versi (Git).
                </div>
                <div class="rating">
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star empty"></div>
                </div>
            </div>
            
            <div class="skill-card">
                <div class="skill-title">Cloud, Deployment, dan DevOps Mindset</div>
                <div class="skill-description">
                    Dunia kerja sekarang butuh engineer yang paham bagaimana aplikasi dijalankan di dunia nyata. 
                    Mulai dari membuat server, menyimpan data, hingga menjalankan aplikasi dalam skala besar.
                </div>
                <div class="rating">
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star empty"></div>
                    <div class="star empty"></div>
                </div>
            </div>
            
            <div class="skill-card">
                <div class="skill-title">Soft Skills & Adaptability</div>
                <div class="skill-description">
                    Kemampuan teknis itu penting, tapi kemampuan beradaptasi dan bekerja dalam tim juga krusial. 
                    Industri teknologi berubah cepat — kamu harus cepat belajar, terbuka, dan komunikatif.
                </div>
                <div class="rating">
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="conclusion-section">
        <h2 class="conclusion-title">Kesimpulan</h2>
        <p class="conclusion-text">
            Berdasarkan hasil analisis, jurusan <strong>Teknologi Informasi</strong> paling sesuai dengan minat dan potensi kamu. 
            Bidang ini membuka peluang karier luas di dunia digital — mulai dari pengembangan aplikasi, analisis data, hingga keamanan siber. 
            Kuasai skill dasar seperti pemrograman, cloud, dan analisis data, serta asah kemampuan berpikir kritis dan komunikasi, 
            agar siap bersaing di masa depan.
        </p>
    </section>
    
    <footer class="footer">
        <div class="footer-links">
            <div class="footer-link">Home</div>
            <div class="footer-link">Layanan Konsultasi</div>
            <div class="footer-link">Layanan Informasi</div>
            <div class="footer-link">Profile</div>
        </div>
        <div class="footer-divider"></div>
        <div class="footer-contact">
            <div class="contact-item">
                <span>💬</span>
                <span style="color: white;">Let's chat</span>
            </div>
            <div class="contact-item">
                <span>📧</span>
                <span>Edvizo.@gmail.com</span>
            </div>
        </div>
    </footer>
</body>
</html>