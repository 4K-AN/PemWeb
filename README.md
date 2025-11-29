# 🎓 Edvizo - Platform Konsultasi Jurusan Berbasis AI

<div align="center">

![Edvizo Logo](public/images/Vectoredvizo.svg)

**Platform asisten pendidikan digital yang membantu siswa menemukan jurusan kuliah yang tepat menggunakan teknologi AI**

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue.svg)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC.svg)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

[Demo](#) • [Dokumentasi](#fitur-utama) • [Instalasi](#-instalasi-fresh-setup)

</div>

---

## 📋 Daftar Isi

- [Tentang Project](#-tentang-project)
- [Fitur Utama](#-fitur-utama)
- [Tech Stack](#-tech-stack)
- [Instalasi Fresh Setup](#-instalasi-fresh-setup)
- [Troubleshooting](#-troubleshooting)
- [Kontribusi](#-kontribusi)
- [Tim Pengembang](#-tim-pengembang)
- [Lisensi](#-lisensi)

---

## 🌟 Tentang Project

**Edvizo** adalah platform konsultasi jurusan kuliah berbasis AI yang dirancang untuk membantu siswa SMA/SMK dalam menentukan pilihan jurusan yang sesuai dengan minat, bakat, dan kemampuan mereka. Platform ini menggunakan teknologi **Google Gemini AI** untuk memberikan rekomendasi personal dan analisis SWOT mendalam.

### 🎯 Tujuan

- Membantu siswa membuat keputusan pendidikan yang tepat
- Memberikan analisis SWOT komprehensif untuk setiap rekomendasi jurusan
- Menyediakan informasi lengkap tentang beasiswa dan tryout
- Memudahkan siswa mengelola jadwal akademik

---

## ✨ Fitur Utama

### 1. 🤖 **Konsultasi Jurusan AI**
- Chatbot cerdas berbasis Google Gemini AI
- Rekomendasi jurusan personal berdasarkan minat dan bakat
- Analisis SWOT mendalam (Strengths, Weaknesses, Opportunities, Threats)
- Fitur reroll untuk mendapatkan alternatif rekomendasi
- Fiksasi jurusan untuk analisis lebih detail

### 2. 💼 **Simulasi Karir**
- Eksplorasi berbagai pilihan karir berdasarkan jurusan
- Informasi detail tentang prospek kerja
- Analisis gaji dan jenjang karir

### 3. 💰 **Info Beasiswa**
- Database lengkap beasiswa dalam dan luar negeri (15+ beasiswa)
- Filter berdasarkan jenis, bidang studi, dan negara
- Sorting berdasarkan deadline dan terbaru
- Detail persyaratan dan link pendaftaran

### 4. 📝 **Info Tryout**
- Informasi tryout UTBK, SNBT, Ujian Mandiri, dan Kedinasan (10+ tryout)
- Filter berdasarkan kategori, lokasi, dan waktu
- Fitur gratis, pembahasan, sertifikat, dan ranking
- Detail jadwal dan link pendaftaran

### 5. 📅 **Kalender Akademik**
- Kalender interaktif dengan event akademik (30+ event)
- Kategori: Pendaftaran, Akademik, Ujian, Liburan, Pengumuman
- Detail lengkap setiap event dengan waktu dan lokasi
- View bulanan yang mudah dinavigasi

---

## 🛠 Tech Stack

### Backend
- **Framework**: Laravel 11.x
- **Language**: PHP 8.1+
- **Database**: MySQL / SQLite
- **AI Integration**: Google Gemini API 2.5 Flash

### Frontend
- **CSS Framework**: Tailwind CSS 3.x
- **JavaScript**: Vanilla JS
- **Font**: Google Fonts (Poppins)
- **Icons**: Heroicons

### Tools & Libraries
- **Authentication**: Laravel Breeze
- **ORM**: Eloquent
- **Migration & Seeding**: Laravel Migration & Seeder
- **HTTP Client**: Laravel HTTP Client (Guzzle)

---

## 🚀 Instalasi Fresh Setup

### Prerequisites

Pastikan sistem Anda sudah terinstall:

- ✅ PHP >= 8.1
- ✅ Composer
- ✅ Node.js & npm
- ✅ MySQL atau MariaDB
- ✅ Git

### Langkah 1: Clone Repository

```bash
git clone https://github.com/username/edvizo.git
cd edvizo
```

### Langkah 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### Langkah 3: Setup Environment

```bash
# Copy file .env.example ke .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Langkah 4: Konfigurasi Database

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
DB_PASSWORD=
```

### Langkah 5: Konfigurasi Gemini API

Dapatkan API Key dari [Google AI Studio](https://makersuite.google.com/app/apikey)

Tambahkan ke file `.env`:

```env
GEMINI_API_KEY=your_gemini_api_key_here
```

### Langkah 6: Database Setup

**Opsi A: Menggunakan Script Helper** (Recommended)

```bash
# Windows
setup-database.bat

# Linux/Mac
chmod +x setup-database.sh
./setup-database.sh
```

**Opsi B: Manual Command**

```bash
# Fresh migrate dengan seeder
php artisan migrate:fresh --seed
```

Script akan otomatis:
- ✅ Drop semua tabel (jika ada)
- ✅ Jalankan semua migration
- ✅ Seed data untuk Tryout (10+ data)
- ✅ Seed data untuk Beasiswa (15+ data)
- ✅ Seed data untuk Kalender Akademik (30+ event)
- ✅ Clear cache

### Langkah 7: Build Assets

```bash
# Development mode (dengan auto-reload)
npm run dev

# Production mode (optimized & minified)
npm run build
```

### Langkah 8: Jalankan Server

```bash
php artisan serve
```

Buka browser: `http://127.0.0.1:8000`

### Langkah 9: Register & Login

1. Klik tombol **Register** di navbar
2. Isi form registrasi
3. Login dengan akun yang sudah dibuat
4. Mulai gunakan fitur Edvizo!

---

## 📦 One-Command Setup (Advanced)

Untuk setup cepat, gunakan command ini:

```bash
composer install && npm install && cp .env.example .env && php artisan key:generate && php artisan migrate:fresh --seed && npm run build
```

⚠️ **Catatan**: Pastikan database sudah dibuat dan `.env` sudah dikonfigurasi sebelum menjalankan command di atas.

---

## 🔧 Troubleshooting

### Error: "No application encryption key has been specified"

```bash
php artisan key:generate
```

### Error: "SQLSTATE[HY000] [1049] Unknown database"

Pastikan database sudah dibuat:

```sql
CREATE DATABASE edvizo_db;
```

### Error: "Column not found" saat migrate

```bash
# Fresh migrate untuk reset database
php artisan migrate:fresh --seed
```

### Error: Gemini API tidak berfungsi

1. Pastikan `GEMINI_API_KEY` sudah benar di `.env`
2. Clear config cache:

```bash
php artisan config:clear
```

3. Restart server

### Error: Vite manifest not found

```bash
npm run build
```

### Error: Port 8000 already in use

```bash
# Gunakan port lain
php artisan serve --port=8001
```

---

## 🧹 Cleanup Project

Hapus file-file yang tidak diperlukan:

```bash
# Windows
cleanup-project.bat

# Atau manual
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

---

## 🤝 Kontribusi

Kontribusi selalu welcome! Silakan:

1. Fork repository ini
2. Buat branch baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

---

## 👥 Tim Pengembang

**Kelompok 5 - Pemrograman Web**

| Nama | Role | GitHub |
|------|------|--------|
| Nama 1 | Full Stack Developer | [@username1](https://github.com/username1) |
| Nama 2 | Backend Developer | [@username2](https://github.com/username2) |
| Nama 3 | Frontend Developer | [@username3](https://github.com/username3) |
| Nama 4 | UI/UX Designer | [@username4](https://github.com/username4) |
| Nama 5 | Project Manager | [@username5](https://github.com/username5) |

---

## 📄 Lisensi

Project ini menggunakan lisensi **MIT License**. Lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.

---

## 📞 Kontak & Support

- 📧 Email: edvizo@support.com
- 💬 Discord: [Join Server](https://discord.gg/edvizo)
- 🐛 Issues: [GitHub Issues](https://github.com/username/edvizo/issues)

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - CSS Framework
- [Google Gemini AI](https://ai.google.dev) - AI Integration
- [Heroicons](https://heroicons.com) - Icon Library

---

<div align="center">

**⭐ Jika project ini bermanfaat, jangan lupa kasih star! ⭐**

Made with ❤️ by Kelompok 5

**© 2025 Edvizo. All rights reserved.**

</div>
