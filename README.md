# 🎓 Edvizo - Platform Konsultasi Jurusan Berbasis AI

**Platform asisten pendidikan digital yang membantu siswa menemukan jurusan kuliah yang tepat menggunakan teknologi AI**

---

## 📖 Tentang Project

**Edvizo** adalah platform web berbasis Laravel yang dirancang untuk membantu siswa SMA/SMK dalam menentukan pilihan jurusan kuliah. Platform ini menggunakan **Google Gemini AI 2.5 Flash** untuk memberikan rekomendasi jurusan yang personal berdasarkan minat, bakat, dan kemampuan siswa.

### Masalah yang Diselesaikan
Banyak siswa yang bingung memilih jurusan kuliah karena:
- Kurangnya informasi tentang jurusan yang tersedia
- Tidak tahu jurusan mana yang cocok dengan minat dan bakat mereka
- Kesulitan mengakses informasi beasiswa dan tryout
- Tidak ada platform yang menyediakan analisis mendalam tentang kecocokan jurusan

### Solusi Edvizo
Platform ini menyediakan:
- Konsultasi AI untuk rekomendasi jurusan
- Analisis SWOT komprehensif untuk setiap rekomendasi
- Database beasiswa dan tryout yang lengkap
- Kalender akademik untuk perencanaan yang lebih baik
- Simulasi karir berdasarkan jurusan pilihan

---

## ✨ Fitur Utama

### 1. 🤖 Konsultasi Jurusan AI
Chatbot cerdas berbasis Google Gemini AI yang dapat:
- Memberikan rekomendasi jurusan berdasarkan percakapan dengan user
- Menganalisis minat dan bakat dari profil user
- Menyediakan analisis SWOT (Strengths, Weaknesses, Opportunities, Threats)
- Fitur **reroll** untuk mendapatkan rekomendasi alternatif
- Fitur **fiksasi** untuk menyimpan hasil analisis ke database

### 2. 💰 Info Beasiswa
Sistem informasi beasiswa dengan fitur:
- Database 15+ beasiswa dalam dan luar negeri
- Filter berdasarkan jenis, bidang studi, dan negara
- Sorting berdasarkan deadline terdekat atau terbaru
- Detail lengkap persyaratan dan link pendaftaran

### 3. 📝 Info Tryout
Informasi tryout dan ujian masuk PTN:
- Database 10+ tryout (UTBK, SNBT, Ujian Mandiri, Kedinasan)
- Filter berdasarkan kategori, lokasi, waktu
- Informasi gratis/berbayar, pembahasan, sertifikat, ranking
- Detail penyelenggara dan link pendaftaran

### 4. 📅 Kalender Akademik
Kalender interaktif dengan:
- 30+ event akademik (Maret-Mei 2025)
- Kategori: Pendaftaran, Akademik, Ujian, Liburan, Pengumuman
- View bulanan dengan highlight tanggal yang memiliki event
- Detail waktu, lokasi, dan deskripsi setiap event

### 5. 💼 Simulasi Karir
Eksplorasi karir berdasarkan jurusan yang sudah difiksasi dengan informasi tentang prospek kerja dan jenjang karir.

---

---

## 🚀 Setup Project

### Prerequisites
Pastikan sistem Anda sudah terinstall:
- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL >= 8.0
- Git

### 1. Clone Repository
```bash
git clone https://github.com/username/PemWeb.git
cd PemWeb
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
# Windows
copy .env.example .env

# Linux/Mac
cp .env.example .env

# Generate key
php artisan key:generate
```

### 4. Konfigurasi Database
Buat database baru di MySQL:
```sql
CREATE DATABASE edvizo_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=edvizo_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Konfigurasi Gemini API
Dapatkan API Key dari [Google AI Studio](https://makersuite.google.com/app/apikey)

Tambahkan ke `.env`:
```env
GEMINI_API_KEY=your_api_key_here
```

### 6. Setup Database
**Menggunakan Script Helper (Recommended):**
```bash
# Windows
setup-database.bat

# Linux/Mac
chmod +x setup-database.sh
./setup-database.sh
```

**Atau Manual:**
```bash
php artisan migrate:fresh --seed
```

Script akan:
- Membuat semua tabel yang diperlukan
- Mengisi data dummy untuk Beasiswa (15+ data untuk mahasiswa baru)
- Mengisi data dummy untuk Tryout (10+ data)
- Mengisi data dummy untuk Kalender Akademik (30+ event)

### 7. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 8. Jalankan Server
```bash
php artisan serve
```

Buka browser: `http://127.0.0.1:8000`

### 9. Login
Klik **Register** untuk membuat akun baru, lalu login untuk mengakses semua fitur.

---

## 🛠️ Tech Stack
- **Backend**: Laravel 11.x, PHP 8.1+
- **Database**: MySQL 8.0+
- **Frontend**: Tailwind CSS 3.x, Vanilla JavaScript
- **AI Integration**: Google Gemini AI 2.5 Flash
- **Authentication**: Laravel Breeze

---

## 📞 Support
Jika mengalami masalah saat setup, silakan hubungi tim pengembang atau buat issue di repository.

---

**© 2025 Edvizo - Kelompok 5 Pemrograman Web**
