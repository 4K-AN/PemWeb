@echo off
cls
color 0A
echo ========================================
echo   EDVIZO - Database Setup Utility
echo ========================================
echo.

REM Cek apakah .env sudah ada
if not exist .env (
    echo [ERROR] File .env tidak ditemukan!
    echo.
    echo Silakan jalankan:
    echo   copy .env.example .env
    echo.
    echo Lalu konfigurasi database di file .env
    pause
    exit /b 1
)

echo [INFO] Memeriksa koneksi database...
php artisan config:clear >nul 2>&1

REM Test koneksi database
php artisan db:show >nul 2>&1
if errorlevel 1 (
    echo [ERROR] Tidak dapat terhubung ke database!
    echo.
    echo Pastikan:
    echo 1. MySQL/XAMPP sudah berjalan
    echo 2. Database sudah dibuat (nama: edvizo_db atau sesuai .env)
    echo 3. Konfigurasi .env sudah benar
    echo.
    pause
    exit /b 1
)

echo [OK] Koneksi database berhasil!
echo.

echo [INFO] Memeriksa kondisi database...
php artisan migrate:status >nul 2>&1

if errorlevel 1 (
    echo [DETECT] Database kosong atau belum pernah di-migrate
    echo.
    echo Akan menjalankan: migrate:fresh --seed
    echo.
    set /p confirm="Lanjutkan? (y/n): "
    if /i not "%confirm%"=="y" goto END
    goto FRESH_INSTALL
)

REM Cek apakah ada migration pending
php artisan migrate:status | findstr /C:"Pending" >nul 2>&1
if not errorlevel 1 (
    echo [DETECT] Ada migration pending atau error terdeteksi!
    echo.
    echo Pilih aksi:
    echo 1. Fresh migrate + seed (HAPUS SEMUA DATA - Recommended)
    echo 2. Migrate biasa (coba fix)
    echo 3. Keluar
    echo.
    set /p choice="Pilihan (1-3): "

    if "%choice%"=="1" goto FRESH_INSTALL
    if "%choice%"=="2" goto NORMAL_MIGRATE
    if "%choice%"=="3" goto END
    echo [ERROR] Pilihan tidak valid!
    pause
    exit /b 1
)

REM Database normal, beri pilihan
echo [DETECT] Database sudah ada dan terlihat normal
echo.
echo Pilih aksi:
echo 1. Migrate biasa (update schema saja)
echo 2. Fresh migrate + seed (HAPUS SEMUA DATA!)
echo 3. Seed ulang saja (tambah data dummy)
echo 4. Keluar
echo.
set /p choice="Pilihan (1-4): "

if "%choice%"=="1" goto NORMAL_MIGRATE
if "%choice%"=="2" goto FRESH_INSTALL
if "%choice%"=="3" goto SEED_ONLY
if "%choice%"=="4" goto END
echo [ERROR] Pilihan tidak valid!
pause
exit /b 1

:FRESH_INSTALL
echo.
echo ========================================
echo   FRESH MIGRATE + SEED
echo ========================================
echo.
echo [WARNING] Semua data akan dihapus!
echo.
set /p confirm="Lanjutkan? (y/n): "
if /i not "%confirm%"=="y" goto END

echo.
echo [1/3] Dropping all tables...
call php artisan migrate:fresh
if errorlevel 1 (
    echo [ERROR] Fresh migrate gagal!
    pause
    exit /b 1
)

echo.
echo [2/3] Running seeders...
call php artisan db:seed --class=TryoutSeeder
call php artisan db:seed --class=BeasiswaSeeder
call php artisan db:seed --class=AcademicEventSeeder
if errorlevel 1 (
    echo [ERROR] Seeder gagal!
    pause
    exit /b 1
)

echo.
echo [3/3] Clearing cache...
call php artisan config:clear >nul 2>&1
call php artisan cache:clear >nul 2>&1
call php artisan view:clear >nul 2>&1

echo.
color 0A
echo [SUCCESS] Database berhasil di-setup!
echo.
echo Data yang tersedia:
echo - Tryout: 10+ data
echo - Beasiswa: 15+ data
echo - Kalender Akademik: 30+ event
echo.
goto END

:NORMAL_MIGRATE
echo.
echo ========================================
echo   NORMAL MIGRATE
echo ========================================
echo.
echo [INFO] Menjalankan migration...
call php artisan migrate
if errorlevel 1 (
    echo [ERROR] Migration gagal!
    echo.
    echo Saran: Gunakan Fresh Migrate untuk fix error
    pause
    exit /b 1
)

echo.
echo [INFO] Clearing cache...
call php artisan config:clear >nul 2>&1
call php artisan cache:clear >nul 2>&1

echo.
color 0A
echo [SUCCESS] Migration berhasil!
goto END

:SEED_ONLY
echo.
echo ========================================
echo   SEED DATABASE
echo ========================================
echo.
echo Pilih seeder:
echo 1. Tryout Seeder
echo 2. Beasiswa Seeder
echo 3. Academic Event Seeder
echo 4. Semua Seeder
echo.
set /p seedchoice="Pilihan (1-4): "

if "%seedchoice%"=="1" (
    call php artisan db:seed --class=TryoutSeeder
) else if "%seedchoice%"=="2" (
    call php artisan db:seed --class=BeasiswaSeeder
) else if "%seedchoice%"=="3" (
    call php artisan db:seed --class=AcademicEventSeeder
) else if "%seedchoice%"=="4" (
    call php artisan db:seed --class=TryoutSeeder
    call php artisan db:seed --class=BeasiswaSeeder
    call php artisan db:seed --class=AcademicEventSeeder
) else (
    echo [ERROR] Pilihan tidak valid!
    pause
    exit /b 1
)

echo.
color 0A
echo [SUCCESS] Seeder berhasil dijalankan!
goto END

:END
echo.
echo ========================================
echo   Setup Selesai
echo ========================================
echo.
pause
