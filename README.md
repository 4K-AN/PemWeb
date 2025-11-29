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

### 6. 👤 Manajemen Profil
Fitur manajemen akun pengguna:
- View dan edit profil (nama, email, nomor telepon)
- Update minat & bakat untuk rekomendasi AI yang lebih akurat
- Ubah password dengan validasi keamanan
- **Hapus akun** dengan konfirmasi password (termasuk cascade delete semua data terkait)

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

## 📊 Database Schema

### SQL Schema (Complete)

```sql
-- 1. Tabel Users
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NULL,
    interests_talents TEXT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Tabel Fixations
CREATE TABLE fixations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    jurusan VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    alasan_cocok TEXT NOT NULL,
    swot JSON NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Tabel Beasiswas
CREATE TABLE beasiswas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT NULL,
    universitas VARCHAR(255) NOT NULL,
    jenis_beasiswa VARCHAR(100) NULL,
    jenjang VARCHAR(50) NULL,
    kategori VARCHAR(255) NULL,
    negara VARCHAR(255) NOT NULL,
    status VARCHAR(50) NULL,
    deadline DATE NULL,
    jurusan VARCHAR(255) NULL,
    link_pendaftaran VARCHAR(255) NULL,
    gambar VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Tabel Tryouts
CREATE TABLE tryouts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_tryout VARCHAR(255) NOT NULL,
    deskripsi TEXT NULL,
    penyelenggara VARCHAR(255) NOT NULL,
    kategori VARCHAR(255) NOT NULL,
    tanggal_pelaksanaan DATE NOT NULL,
    waktu_mulai TIME NULL,
    waktu_selesai TIME NULL,
    lokasi VARCHAR(255) NOT NULL,
    biaya DECIMAL(10,2) DEFAULT 0,
    link_pendaftaran VARCHAR(255) NULL,
    deadline_pendaftaran DATE NULL,
    dengan_pembahasan TINYINT(1) DEFAULT 0,
    dengan_sertifikat TINYINT(1) DEFAULT 0,
    dengan_ranking TINYINT(1) DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Tabel Academic Events
CREATE TABLE academic_events (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    event_date DATE NOT NULL,
    start_time TIME NULL,
    end_time TIME NULL,
    location VARCHAR(255) NULL,
    category VARCHAR(255) NOT NULL,
    icon VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Tabel Password Reset Tokens
CREATE TABLE password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Tabel Sessions
CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX sessions_user_id_index (user_id),
    INDEX sessions_last_activity_index (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. Tabel Cache
CREATE TABLE cache (
    `key` VARCHAR(255) PRIMARY KEY,
    value MEDIUMTEXT NOT NULL,
    expiration INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE cache_locks (
    `key` VARCHAR(255) PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

### 1. **users** - Tabel User
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | BIGINT (PK) | ID unik user |
| `name` | VARCHAR(255) | Nama lengkap user |
| `email` | VARCHAR(255) UNIQUE | Email user (untuk login) |
| `email_verified_at` | TIMESTAMP NULL | Waktu verifikasi email |
| `password` | VARCHAR(255) | Password terenkripsi (bcrypt) |
| `phone` | VARCHAR(20) NULL | Nomor telepon user |
| `interests_talents` | TEXT NULL | Deskripsi minat & bakat untuk AI |
| `remember_token` | VARCHAR(100) NULL | Token untuk "Remember Me" |
| `created_at` | TIMESTAMP | Waktu pembuatan akun |
| `updated_at` | TIMESTAMP | Waktu update terakhir |

**Relasi:**
- `hasMany` → fixations (ON DELETE CASCADE)

---

### 2. **fixations** - Tabel Fiksasi Jurusan
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | BIGINT (PK) | ID unik fiksasi |
| `user_id` | BIGINT (FK) | ID user (dari tabel users) |
| `jurusan` | VARCHAR(255) | Nama jurusan yang difiksasi |
| `deskripsi` | TEXT | Deskripsi lengkap jurusan |
| `alasan_cocok` | TEXT | Alasan mengapa jurusan cocok |
| `swot` | JSON NULL | Analisis SWOT (Strengths, Weaknesses, Opportunities, Threats) |
| `created_at` | TIMESTAMP | Waktu fiksasi dibuat |
| `updated_at` | TIMESTAMP | Waktu update terakhir |

**Relasi:**
- `belongsTo` → users (ON DELETE CASCADE)

**Catatan:**
- Saat user dihapus, semua fiksasinya akan otomatis terhapus (cascade delete)
- Kolom `swot` menyimpan data JSON untuk analisis SWOT dari AI

---

### 3. **beasiswas** - Tabel Informasi Beasiswa
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | BIGINT (PK) | ID unik beasiswa |
| `nama` | VARCHAR(255) | Nama beasiswa |
| `deskripsi` | TEXT NULL | Deskripsi lengkap beasiswa |
| `universitas` | VARCHAR(255) | Nama universitas/institusi |
| `jenis_beasiswa` | VARCHAR(100) NULL | Jenis (Penuh/Parsial/Prestasi/KIP) |
| `jenjang` | VARCHAR(50) NULL | Jenjang pendidikan (S1/S2/S3) |
| `kategori` | VARCHAR(255) NULL | Bidang studi/kategori |
| `negara` | VARCHAR(255) | Negara penyelenggara |
| `status` | VARCHAR(50) NULL | Status beasiswa (Dibuka/Ditutup) |
| `deadline` | DATE NULL | Tanggal deadline pendaftaran |
| `jurusan` | VARCHAR(255) NULL | Jurusan yang tersedia |
| `link_pendaftaran` | VARCHAR(255) NULL | URL pendaftaran |
| `gambar` | VARCHAR(255) NULL | Path gambar/logo beasiswa |
| `created_at` | TIMESTAMP | Waktu data dibuat |
| `updated_at` | TIMESTAMP | Waktu update terakhir |

**Index/Filter:**
- Filter: `jenis_beasiswa`, `kategori`, `negara`
- Sorting: `deadline`, `nama`

---

### 4. **tryouts** - Tabel Informasi Tryout
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | BIGINT (PK) | ID unik tryout |
| `nama_tryout` | VARCHAR(255) | Nama tryout |
| `deskripsi` | TEXT NULL | Deskripsi tryout |
| `penyelenggara` | VARCHAR(255) | Nama penyelenggara |
| `kategori` | VARCHAR(255) | Kategori (UTBK/SNBT/Mandiri/Kedinasan) |
| `tanggal_pelaksanaan` | DATE | Tanggal pelaksanaan |
| `waktu_mulai` | TIME NULL | Waktu mulai |
| `waktu_selesai` | TIME NULL | Waktu selesai |
| `lokasi` | VARCHAR(255) | Lokasi (Online/Offline/Kota) |
| `biaya` | DECIMAL(10,2) | Biaya pendaftaran (0 = gratis) |
| `link_pendaftaran` | VARCHAR(255) NULL | URL pendaftaran |
| `deadline_pendaftaran` | DATE NULL | Deadline pendaftaran |
| `dengan_pembahasan` | BOOLEAN | Ada pembahasan atau tidak |
| `dengan_sertifikat` | BOOLEAN | Ada sertifikat atau tidak |
| `dengan_ranking` | BOOLEAN | Ada ranking nasional atau tidak |
| `is_active` | BOOLEAN | Status aktif (default: true) |
| `created_at` | TIMESTAMP | Waktu data dibuat |
| `updated_at` | TIMESTAMP | Waktu update terakhir |

**Index/Filter:**
- Filter: `kategori`, `lokasi`, `biaya`, fitur boolean
- Sorting: `tanggal_pelaksanaan`, `nama_tryout`

---

### 5. **academic_events** - Tabel Kalender Akademik
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | BIGINT (PK) | ID unik event |
| `title` | VARCHAR(255) | Judul event |
| `description` | TEXT NULL | Deskripsi event |
| `event_date` | DATE | Tanggal event |
| `start_time` | TIME NULL | Waktu mulai |
| `end_time` | TIME NULL | Waktu selesai |
| `location` | VARCHAR(255) NULL | Lokasi event |
| `category` | VARCHAR(255) | Kategori (Pendaftaran/Akademik/Ujian/Liburan/Pengumuman) |
| `icon` | VARCHAR(255) NULL | Icon emoji untuk UI |
| `created_at` | TIMESTAMP | Waktu data dibuat |
| `updated_at` | TIMESTAMP | Waktu update terakhir |

**Index/Filter:**
- Filter: `event_date` (year, month)
- Sorting: `event_date`, `start_time`

---

### 6. **password_reset_tokens** - Tabel Reset Password
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `email` | VARCHAR(255) PK | Email user |
| `token` | VARCHAR(255) | Token reset password |
| `created_at` | TIMESTAMP NULL | Waktu token dibuat |

**Catatan:**
- Token expires setelah 60 menit
- Digunakan untuk fitur lupa password

---

### 7. **sessions** - Tabel Session Laravel
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | VARCHAR(255) PK | Session ID |
| `user_id` | BIGINT NULL (FK) | ID user yang sedang login |
| `ip_address` | VARCHAR(45) NULL | IP address user |
| `user_agent` | TEXT NULL | Browser/device info |
| `payload` | LONGTEXT | Data session terenkripsi |
| `last_activity` | INTEGER | Timestamp aktivitas terakhir |

**Index:**
- `user_id`, `last_activity`

---

### 8. **cache** & **cache_locks** - Tabel Cache Laravel
Digunakan untuk menyimpan cache data (misalnya response AI) untuk meningkatkan performa.

---

### ERD (Entity Relationship Diagram)

```
┌─────────────┐
│    users    │
├─────────────┤
│ id (PK)     │───┐
│ name        │   │
│ email       │   │
│ password    │   │
│ phone       │   │
│ interests   │   │
└─────────────┘   │
                  │ 1:N (ON DELETE CASCADE)
                  │
                  ▼
            ┌─────────────┐
            │  fixations  │
            ├─────────────┤
            │ id (PK)     │
            │ user_id(FK) │
            │ jurusan     │
            │ deskripsi   │
            │ alasan      │
            │ swot (JSON) │
            └─────────────┘

┌──────────────┐    ┌──────────────┐    ┌──────────────────┐
│  beasiswas   │    │   tryouts    │    │ academic_events  │
├──────────────┤    ├──────────────┤    ├──────────────────┤
│ id (PK)      │    │ id (PK)      │    │ id (PK)          │
│ nama         │    │ nama_tryout  │    │ title            │
│ universitas  │    │ kategori     │    │ event_date       │
│ jenis        │    │ lokasi       │    │ category         │
│ negara       │    │ biaya        │    │ location         │
│ deadline     │    │ tanggal      │    │ start_time       │
└──────────────┘    └──────────────┘    └──────────────────┘
    (Standalone)       (Standalone)           (Standalone)
```

---

## 📞 Support
Jika mengalami masalah saat setup, silakan hubungi tim pengembang atau buat issue di repository.

---

**© 2025 Edvizo - Kelompok 5 Pemrograman Web**
