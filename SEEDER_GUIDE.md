# 📚 Panduan Lengkap: Cara Membuat dan Menjalankan Seeder di Laravel

## 📌 Apa itu Seeder?

Seeder adalah kelas yang digunakan untuk **mengisi database dengan data dummy/contoh** secara otomatis. Sangat berguna untuk:
- 🧪 Testing aplikasi
- 🚀 Development awal
- 📊 Demo aplikasi
- 🔄 Reset data dengan mudah

---

## 🚀 Cara Cepat Menjalankan Seeder

### **1️⃣ Jalankan Semua Seeder (Recommended)**
```bash
php artisan db:seed
```
✅ Ini akan menjalankan `DatabaseSeeder` yang ada di `database/seeders/DatabaseSeeder.php`

### **2️⃣ Jalankan Seeder Tertentu**
```bash
php artisan db:seed --class=BeasiswaSeeder
php artisan db:seed --class=AcademicEventSeeder
php artisan db:seed --class=TryoutSeeder
```

### **3️⃣ Reset Database + Seeder (Hapus semua data lalu isi ulang)**
```bash
php artisan migrate:fresh --seed
```
⚠️ **Hati-hati!** Command ini akan:
- 🗑️ Hapus semua tabel
- 🔄 Buat ulang tabel dari migrations
- 📥 Jalankan semua seeder

### **4️⃣ Reset Database Tanpa Seeder**
```bash
php artisan migrate:fresh
```

---

## 📝 Cara Membuat Seeder Baru

### **Method 1: Generate dengan Artisan (Recommended)**

Buat seeder otomatis dengan command:
```bash
php artisan make:seeder NamaSeeder
```

Contoh:
```bash
php artisan make:seeder UserSeeder
php artisan make:seeder ProductSeeder
php artisan make:seeder FixationSeeder
```

File akan dibuat di: `database/seeders/NamaSeeder.php`

### **Method 2: Buat File Manual**

Buat file baru di `database/seeders/` dengan nama `NamaSeeder.php`

---

## 📖 Struktur Dasar Seeder

### Template Standar:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NamaSeeder extends Seeder
{
    public function run(): void
    {
        // Kode untuk memasukkan data
        DB::table('nama_tabel')->insert([
            // Data di sini
        ]);
    }
}
```

---

## 💡 Contoh Seeder Praktis

### **Contoh 1: Seeder Sederhana dengan DB::table()**

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BeasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        DB::table('beasiswas')->insert([
            [
                'nama' => 'Beasiswa LPDP',
                'jurusan' => 'Semua Jurusan',
                'status' => 'Buka',
                'deadline' => $now->copy()->addMonths(3),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Beasiswa Bank Indonesia',
                'jurusan' => 'Ekonomi',
                'status' => 'Tutup',
                'deadline' => $now->copy()->addMonths(1),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
```

### **Contoh 2: Seeder dengan Model**

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '081234567890',
            'bio' => 'Seorang developer muda',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '081234567891',
            'bio' => 'Desainer UI/UX',
            'password' => Hash::make('password123'),
        ]);
    }
}
```

### **Contoh 3: Seeder dengan Loop (Banyak Data)**

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LargeDataSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        
        for ($i = 1; $i <= 100; $i++) {
            $data[] = [
                'nama' => "Item {$i}",
                'deskripsi' => "Deskripsi untuk item {$i}",
                'harga' => rand(10000, 1000000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('products')->insert($data);
    }
}
```

---

## 🔗 Daftar Seeder Saat Ini di Project Anda

Seeder yang sudah ada:

1. **DatabaseSeeder** (`database/seeders/DatabaseSeeder.php`)
   - User dummy: `gopi` / `rafi.kamasyamsi@gmail.com` / `123`
   - Memanggil: `BeasiswaSeeder`

2. **BeasiswaSeeder** (`database/seeders/BeasiswaSeeder.php`)
   - Mengisi data beasiswa

3. **AcademicEventSeeder** (`database/seeders/AcademicEventSeeder.php`)
   - Mengisi kalender akademik

4. **TryoutSeeder** (`database/seeders/TryoutSeeder.php`)
   - Mengisi data tryout

---

## 📋 Cara Memanggil Seeder Lain dari DatabaseSeeder

Edit `database/seeders/DatabaseSeeder.php`:

```php
public function run(): void
{
    // Buat user test
    User::firstOrCreate([
        'name' => 'gopi',
        'email' => 'rafi.kamasyamsi@gmail.com',
        'password' => bcrypt('123'),
    ]);

    // Panggil seeder lain
    $this->call([
        BeasiswaSeeder::class,
        AcademicEventSeeder::class,
        TryoutSeeder::class,
        // Tambah seeder baru di sini
    ]);
}
```

---

## ✅ Langkah-Langkah Praktis

### **Membuat Seeder Baru & Menjalankannya**

**Step 1: Generate seeder baru**
```bash
php artisan make:seeder FixationSeeder
```

**Step 2: Edit seeder (database/seeders/FixationSeeder.php)**
```php
<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FixationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fixations')->insert([
            [
                'user_id' => 1,
                'compatibility_score' => 85,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
```

**Step 3: Daftarkan di DatabaseSeeder**
```php
$this->call([
    BeasiswaSeeder::class,
    AcademicEventSeeder::class,
    TryoutSeeder::class,
    FixationSeeder::class,  // ← Tambah di sini
]);
```

**Step 4: Jalankan**
```bash
php artisan db:seed
```

---

## 🎯 Contoh Lengkap: Membuat UserSeeder untuk Profile

Saya akan membuat seeder untuk testing profile yang baru dibuat:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileTestSeeder extends Seeder
{
    public function run(): void
    {
        // User Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@edvizo.com',
            'phone' => '081234567890',
            'bio' => 'Administrator sistem Edvizo',
            'password' => Hash::make('admin123'),
        ]);

        // User Test 1
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '082345678901',
            'bio' => 'Siswa SMA jurusan IPA, tertarik bidang teknik',
            'password' => Hash::make('password123'),
        ]);

        // User Test 2
        User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@example.com',
            'phone' => '083456789012',
            'bio' => 'Calon mahasiswa, minat pada bidang bisnis dan ekonomi',
            'password' => Hash::make('password123'),
        ]);
    }
}
```

**Cara menggunakan:**
```bash
# Generate seeder
php artisan make:seeder ProfileTestSeeder

# Copy code di atas ke file tersebut

# Daftarkan di DatabaseSeeder:
$this->call([
    ProfileTestSeeder::class,
    // ... seeder lainnya
]);

# Jalankan
php artisan db:seed
```

---

## ⚡ Command Penting Seeder

| Command | Fungsi |
|---------|--------|
| `php artisan make:seeder NamaSeeder` | Buat seeder baru |
| `php artisan db:seed` | Jalankan DatabaseSeeder |
| `php artisan db:seed --class=NamaSeeder` | Jalankan seeder tertentu |
| `php artisan migrate:fresh --seed` | Reset DB + jalankan seeder |
| `php artisan migrate:refresh --seed` | Refresh migration + seeder |

---

## 🐛 Troubleshooting

### Error: "Class not found"
**Solusi:**
- Pastikan namespace benar: `namespace Database\Seeders;`
- Pastikan nama class sesuai nama file
- Jalankan `composer dump-autoload`

### Error: "Table doesn't exist"
**Solusi:**
- Pastikan migration sudah di-run: `php artisan migrate`
- Jalankan migration terlebih dahulu sebelum seeder

### Data tidak ter-insert
**Solusi:**
- Cek nama tabel benar
- Cek kolom data sesuai dengan tabel
- Cek validasi model (fillable array)

---

## 💡 Tips & Best Practices

✅ **DO:**
- Gunakan `Carbon::now()` untuk timestamp
- Validasi data sebelum insert
- Gunakan model ketika perlu relasi
- Dokumentasikan seeder dengan comments

❌ **DON'T:**
- Jangan hardcode banyak data, gunakan loop
- Jangan seed data production ke testing
- Jangan lupa migrate sebelum seed
- Jangan jalankan seeder tanpa backup

---

**Butuh bantuan dengan seeder tertentu? Tanya aja!**
