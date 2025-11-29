# 🚀 Panduan Praktis: Cara Menjalankan Seeder

## ⚡ Quick Start (3 Langkah)

### **Langkah 1: Buka Terminal**
- Tekan `Ctrl + Backtick` di VS Code (atau buka command prompt)
- Pastikan sudah di folder project: `e:\GIT\PemWeb`

### **Langkah 2: Jalankan Migration (Jika Belum)**
```bash
php artisan migrate
```
Tunggu sampai selesai...

### **Langkah 3: Jalankan Seeder**
```bash
php artisan db:seed
```

**Selesai!** ✅ Database Anda sudah terisi data dummy.

---

## 📋 Data yang Ter-insert

Setelah menjalankan seeder, database akan berisi:

### **Users (dari ProfileTestSeeder)**
```
1. gopi (rafi.kamasyamsi@gmail.com) - Password: 123
2. Admin Edvizo (admin@edvizo.com) - Password: admin123
3. Budi Santoso (budi@example.com) - Password: password123
4. Siti Nurhaliza (siti@example.com) - Password: password123
5. Raka Wijaya (raka@example.com) - Password: password123
6. Tester Developer (tester@edvizo.com) - Password: password123
```

### **Beasiswa** (dari BeasiswaSeeder)
- LPDP Reguler
- Bank Indonesia
- Global Korea Scholarship (GKS)
- Djarum Beasiswa Plus
- Dan lainnya...

### **Academic Events** (dari AcademicEventSeeder)
- Pendaftaran Siswa Baru
- Orientasi Siswa Baru
- Ujian Tengah Semester
- Ujian Akhir Semester
- Dan lainnya...

### **Tryouts** (dari TryoutSeeder)
- Tryout UTBK
- Tryout Mandiri
- Dan lainnya...

---

## 🧪 Test Profile Page

Setelah seeder dijalankan, test profile page dengan login:

### **Test Login 1**
```
Email: budi@example.com
Password: password123
```
✓ Lihat data profil Budi
✓ Edit profil
✓ Ubah password

### **Test Login 2**
```
Email: admin@edvizo.com
Password: admin123
```

### **Original Test Account**
```
Email: rafi.kamasyamsi@gmail.com
Password: 123
```

---

## 🔧 Command Lanjutan

### **1. Jalankan Seeder Tertentu Saja**

```bash
# Hanya ProfileTestSeeder
php artisan db:seed --class=ProfileTestSeeder

# Hanya BeasiswaSeeder
php artisan db:seed --class=BeasiswaSeeder

# Hanya AcademicEventSeeder
php artisan db:seed --class=AcademicEventSeeder
```

### **2. Reset Database + Jalankan Seeder**
```bash
php artisan migrate:fresh --seed
```
⚠️ **Hati-hati!** Command ini akan:
- Hapus semua data lama
- Buat ulang tabel
- Isi data baru dari seeder

### **3. Jalankan Migration + Seeder Ulang**
```bash
php artisan migrate:refresh --seed
```

### **4. Hanya Drop Tabel (Tanpa Seeder)**
```bash
php artisan migrate:fresh
```

---

## 📊 Status Seeder yang Ada

File seeder di project Anda:

| File | Status | Fungsi |
|------|--------|--------|
| `DatabaseSeeder.php` | ✅ Main | Seeder utama yang menjalankan semua seeder |
| `ProfileTestSeeder.php` | ✅ Baru | Test users untuk profile page |
| `BeasiswaSeeder.php` | ✅ Ada | Data beasiswa |
| `AcademicEventSeeder.php` | ✅ Ada | Kalender akademik |
| `TryoutSeeder.php` | ✅ Ada | Data tryout |

---

## 🎯 Workflow Lengkap: Development ke Testing

### **Setup Awal**
```bash
# 1. Run migration
php artisan migrate

# 2. Run seeder
php artisan db:seed

# 3. Start server
php artisan serve
```

### **Testing Profile Page**
```bash
# Buka: http://localhost:8000
# Login dengan salah satu user dari seeder
# Test fitur edit profil, ubah password, dll
```

### **Reset Database Untuk Testing Ulang**
```bash
# Reset database + seeder
php artisan migrate:fresh --seed

# Atau jalankan ulang hanya seeder
php artisan db:seed --class=ProfileTestSeeder
```

---

## 🐛 Troubleshooting

### ❌ Error: "SQLSTATE[42S02]: Table 'pemweb.users' doesn't exist"

**Solusi:**
```bash
# Run migration dulu sebelum seeder
php artisan migrate
php artisan db:seed
```

### ❌ Error: "Class ProfileTestSeeder not found"

**Solusi:**
```bash
# Update composer autoload
composer dump-autoload

# Jalankan lagi
php artisan db:seed
```

### ❌ Data tidak ter-insert

**Solusi:**
1. Cek migration sudah dijalankan
2. Cek kolom di tabel sesuai dengan seeder
3. Cek file seeder tidak ada syntax error
4. Jalankan: `php artisan cache:clear`

### ❌ Duplicate Entry Error

**Solusi:**
- Gunakan `firstOrCreate()` (sudah di-set di ProfileTestSeeder)
- Atau jalankan `php artisan migrate:fresh --seed` untuk reset

---

## 💡 Tips

✅ **Best Practice:**
- Selalu migrate dulu sebelum seed
- Gunakan `firstOrCreate()` untuk menghindari duplicate
- Test seeder sebelum push ke repository
- Dokumentasikan apa yang seeder insert

❌ **Jangan:**
- Jangan jalankan seeder production ke database real
- Jangan seed tanpa backup data penting
- Jangan lupa migration sebelum seed
- Jangan hardcode banyak data tanpa loop

---

## 📌 Cheat Sheet

```bash
# Quick commands
php artisan make:seeder NamaSeeder        # Buat seeder baru
php artisan migrate                       # Run migration
php artisan db:seed                       # Run seeder
php artisan db:seed --class=NameSeeder    # Run specific seeder
php artisan migrate:fresh --seed          # Reset + seed (DANGEROUS!)
php artisan migrate:refresh --seed        # Refresh migration + seed
php artisan tinker                        # PHP REPL untuk manual testing
```

---

## 🔗 File Referensi

- 📄 `database/seeders/DatabaseSeeder.php` - Main seeder
- 📄 `database/seeders/ProfileTestSeeder.php` - Profile test users (BARU)
- 📄 `database/seeders/BeasiswaSeeder.php` - Beasiswa data
- 📄 `database/seeders/AcademicEventSeeder.php` - Academic events
- 📄 `database/seeders/TryoutSeeder.php` - Tryout data
- 📄 `SEEDER_GUIDE.md` - Dokumentasi lengkap seeder

---

**Sudah siap? Mari test profile page Anda! 🚀**

Langkah:
1. `php artisan migrate` (jika belum)
2. `php artisan db:seed`
3. `php artisan serve`
4. Login dan test profile page
