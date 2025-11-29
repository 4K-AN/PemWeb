# 🚀 Edvizo - Setup Guide

Panduan lengkap untuk setup project Edvizo di berbagai kondisi.

---

## 📋 Table of Contents

1. [Setup untuk User Baru (First Time)](#setup-untuk-user-baru-first-time)
2. [Setup untuk User yang Sudah Pernah Pull (Update)](#setup-untuk-user-yang-sudah-pernah-pull-update)
3. [Troubleshooting](#troubleshooting)
4. [FAQ](#faq)

---

## 🆕 Setup untuk User Baru (First Time)

Untuk Anda yang **pertama kali** clone/pull project ini:

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL/MariaDB
- Git

### Step 1: Clone Repository
```bash
git clone [repository-url]
cd PemWeb
```

### Step 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### Step 3: Setup Environment
```bash
# Copy file .env.example ke .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Konfigurasi Database

Buat database baru di MySQL/phpMyAdmin:
```sql
CREATE DATABASE edvizo_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=edvizo_db
DB_USERNAME=root
DB_PASSWORD=
```

### Step 5: Konfigurasi API Keys

Tambahkan API key untuk Gemini AI di file `.env`:
```env
GEMINI_API_KEY=your_gemini_api_key_here
```

> 💡 **Cara mendapatkan Gemini API Key:**
> 1. Kunjungi https://makersuite.google.com/app/apikey
> 2. Login dengan Google Account
> 3. Create API Key
> 4. Copy dan paste ke `.env`

### Step 6: Jalankan Migration & Seeder
```bash
# Jalankan migration dan seeder sekaligus
php artisan migrate --seed
```

> ⚠️ **Jika ada error migration:**
> ```bash
> # Gunakan fresh migrate (akan hapus semua data)
> php artisan migrate:fresh --seed
> ```

### Step 7: Link Storage (Opsional)
```bash
php artisan storage:link
```

### Step 8: Compile Assets
```bash
# Development mode (auto-reload)
npm run dev

# Production mode (minified)
npm run build
```

### Step 9: Jalankan Server
```bash
php artisan serve
```

Buka browser: `http://127.0.0.1:8000`

### Step 10: Login/Register

1. Klik tombol **Register** di navbar
2. Isi form registrasi:
   - Name: `Nama Anda`
   - Email: `email@example.com`
   - Password: `password123`
3. Login dengan akun yang sudah dibuat

✅ **Setup selesai!** Project sudah siap digunakan.

---

## 🔄 Setup untuk User yang Sudah Pernah Pull (Update)

Untuk Anda yang **sudah pernah** setup project ini tapi tertinggal update:

### Scenario A: Update Kode Saja (Tanpa Perubahan Database)

Jika hanya ada perubahan di **code/view** tanpa perubahan database:

```bash
# 1. Pull latest code
git pull origin main

# 2. Update dependencies (jika ada perubahan)
composer install
npm install

# 3. Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# 4. Rebuild assets (jika ada perubahan UI)
npm run build

# 5. Restart server
php artisan serve
```

### Scenario B: Update dengan Perubahan Database Baru

Jika ada **migration baru** atau **perubahan schema**:

```bash
# 1. Pull latest code
git pull origin main

# 2. Update dependencies
composer install
npm install

# 3. Backup database (PENTING!)
# Via phpMyAdmin: Export database edvizo_db
# Atau via command:
mysqldump -u root -p edvizo_db > backup_edvizo_$(date +%Y%m%d).sql

# 4. Jalankan migration baru
php artisan migrate

# 5. Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# 6. Rebuild assets
npm run build

# 7. Restart server
php artisan serve
```

### Scenario C: Update dengan Perubahan Data/Seeder

Jika ada **seeder baru** atau perubahan data:

```bash
# 1. Pull latest code
git pull origin main

# 2. Update dependencies
composer install
npm install

# 3. Backup database
mysqldump -u root -p edvizo_db > backup_edvizo_$(date +%Y%m%d).sql

# 4. Jalankan seeder baru saja (tanpa reset database)
php artisan db:seed --class=TryoutSeeder
php artisan db:seed --class=BeasiswaSeeder
php artisan db:seed --class=AcademicEventSeeder

# 5. Clear cache
php artisan optimize:clear

# 6. Restart server
php artisan serve
```

### Scenario D: Reset Total (Jika Banyak Konflik)

Jika ada **terlalu banyak error** atau **konflik migration**:

```bash
# 1. Pull latest code
git pull origin main

# 2. Update dependencies
composer install
npm install

# 3. BACKUP DATABASE DULU!
mysqldump -u root -p edvizo_db > backup_edvizo_$(date +%Y%m%d).sql

# 4. Fresh migrate (HATI-HATI: Hapus semua data!)
php artisan migrate:fresh --seed

# 5. Clear semua cache
php artisan optimize:clear

# 6. Rebuild assets
npm run build

# 7. Restart server
php artisan serve
```

> ⚠️ **PERINGATAN:** `migrate:fresh` akan **menghapus semua data** di database!

---

## 🚨 Troubleshooting

### Error: "No application encryption key has been specified"
```bash
php artisan key:generate
```

### Error: "SQLSTATE[HY000] [1049] Unknown database"
```bash
# Buat database baru di MySQL
CREATE DATABASE edvizo_db;

# Lalu jalankan migration lagi
php artisan migrate
```

### Error: "Class 'XXX' not found"
```bash
composer dump-autoload
php artisan config:clear
```

### Error: Migration "Table already exists"
```bash
# Opsi 1: Skip migration yang error (manual)
# Edit migration file dan tambahkan check:
Schema::hasTable('nama_tabel')

# Opsi 2: Fresh migrate (hapus semua data)
php artisan migrate:fresh --seed
```

### Error: "npm: command not found"
```bash
# Install Node.js terlebih dahulu
# Download dari: https://nodejs.org/
```

### Error: Port 8000 already in use
```bash
# Gunakan port lain
php artisan serve --port=8001
```

### Error: Vite manifest not found
```bash
npm run build
```

### Error: Storage link already exists
```bash
# Hapus link lama
rm public/storage

# Buat link baru
php artisan storage:link
```

### Error: "Column 'gambar' doesn't have a default value"
```bash
# Jalankan di terminal MySQL atau tinker:
php artisan tinker

# Lalu ketik:
DB::statement('ALTER TABLE `beasiswas` MODIFY `gambar` VARCHAR(255) NULL');
exit
```

### Error: "Table 'tryouts' doesn't exist" saat migrate
```bash
# Ini terjadi karena ada migration lama yang konflik

# Solusi:
# 1. Hapus migration yang error (manual):
#    database/migrations/*_add_fitur_to_tryouts_table.php

# 2. Atau skip migration otomatis:
php artisan tinker

# Lalu ketik:
DB::table('migrations')->where('migration', 'like', '%add_fitur_to_tryouts_table%')->delete();
exit

# 3. Jalankan migrate lagi:
php artisan migrate:fresh --seed
```

### Error: Migration konflik setelah pull dari device lain
```bash
# Scenario: Pull dari teman yang punya migration lama

# Langkah 1: Cek migration yang error
php artisan migrate:status

# Langkah 2: Hapus migration yang konflik (manual)
# Cari file di folder database/migrations/ yang error
# Biasanya file lama seperti:
# - *_add_fitur_to_tryouts_table.php
# - *_add_filter_columns_to_beasiswas_table.php (yang lama)
# - *_create_tryouts_table.php (yang lama, bukan _final)

# Langkah 3: Fresh migrate
php artisan migrate:fresh --seed
```

---

## ❓ FAQ

### Q: Apakah harus fresh migrate setiap kali pull?
**A:** Tidak. Fresh migrate hanya untuk **first time setup** atau jika ada **konflik migration**. Untuk update biasa, cukup `php artisan migrate`.

### Q: Data saya hilang setelah migrate:fresh. Bagaimana?
**A:** `migrate:fresh` **menghapus semua data**. Selalu backup database sebelum menjalankannya. Restore dari backup jika perlu.

### Q: Bagaimana cara backup database?
**A:** 
```bash
# Via command line
mysqldump -u root -p edvizo_db > backup.sql

# Via phpMyAdmin
# Database > Export > Go
```

### Q: Bagaimana cara restore database?
**A:**
```bash
# Via command line
mysql -u root -p edvizo_db < backup.sql

# Via phpMyAdmin
# Database > Import > Choose file > Go
```

### Q: API Key Gemini saya tidak berfungsi
**A:** 
1. Pastikan API Key sudah benar di `.env`
2. Jalankan `php artisan config:clear`
3. Restart server
4. Cek quota API di Google AI Studio

### Q: Setelah pull, UI chatbot tidak berubah
**A:**
```bash
php artisan view:clear
npm run build
# Refresh browser dengan Ctrl+F5
```

### Q: Bagaimana cara menambahkan data dummy sendiri?
**A:**
```bash
# Edit file seeder:
# database/seeders/TryoutSeeder.php
# database/seeders/BeasiswaSeeder.php

# Lalu jalankan:
php artisan db:seed --class=NamaSeeder
```

---

## 📦 File Structure Project
