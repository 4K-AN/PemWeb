@echo off
cls
color 0A
echo ========================================
echo   EDVIZO - Database Setup Utility
echo ========================================
echo.

REM Cek apakah .env sudah ada
if not exist .env (
    color 0C
    echo [ERROR] File .env tidak ditemukan!
    echo.
    echo Silakan jalankan:
    echo   copy .env.example .env
    echo.
    echo Lalu konfigurasi database di file .env
    echo.
    pause
    exit /b 1
)

echo [INFO] File .env ditemukan
echo [INFO] Memeriksa koneksi database...
call php artisan config:clear >nul 2>&1

REM Test koneksi database
call php artisan db:show >nul 2>&1
if errorlevel 1 (
    color 0C
    echo [ERROR] Tidak dapat terhubung ke database!
    echo.
    echo Pastikan:
    echo 1. MySQL/XAMPP sudah berjalan
    echo 2. Database sudah dibuat (nama: edvizo_db atau sesuai .env)
    echo 3. Konfigurasi .env sudah benar
    echo.
    echo Tekan tombol apa saja untuk keluar...
    pause >nul
    exit /b 1
)

color 0A
echo [OK] Koneksi database berhasil!
echo.

echo [INFO] Memeriksa kondisi database...
call php artisan migrate:status >nul 2>&1

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
call php artisan migrate:status | findstr /C:"Pending" >nul 2>&1
if not errorlevel 1 (
    color 0E
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
    goto END
)

REM Database normal, beri pilihan
color 0A
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
goto END

:FRESH_INSTALL
echo.
echo ========================================
echo   FRESH MIGRATE + SEED
echo ========================================
echo.
color 0C
echo [WARNING] Semua data akan dihapus!
echo.
set /p confirm="Lanjutkan? (y/n): "
if /i not "%confirm%"=="y" goto END

color 0E
echo.
echo [1/5] Dropping all tables...
call php artisan migrate:fresh
if errorlevel 1 (
    color 0C
    echo [ERROR] Fresh migrate gagal!
    echo.
    pause
    goto END
)

echo.
echo [2/5] Running Tryout Seeder...
call php artisan db:seed --class=TryoutSeeder
if errorlevel 1 (
    color 0E
    echo [WARNING] Tryout seeder gagal, melanjutkan...
)

echo.
echo [3/5] Running Beasiswa Seeder...
call php artisan db:seed --class=BeasiswaSeeder
if errorlevel 1 (
    color 0E
    echo [WARNING] Beasiswa seeder gagal, melanjutkan...
)

echo.
echo [4/5] Running Academic Event Seeder...
call php artisan db:seed --class=AcademicEventSeeder
if errorlevel 1 (
    color 0E
    echo [WARNING] Academic Event seeder gagal, melanjutkan...
)

echo.
echo [5/5] Clearing cache...
call php artisan config:clear >nul 2>&1
call php artisan cache:clear >nul 2>&1
call php artisan view:clear >nul 2>&1
call php artisan route:clear >nul 2>&1

echo.
color 0A
echo ========================================
echo   DATABASE SETUP BERHASIL!
echo ========================================
echo.
echo Data yang tersedia:
echo - Tryout        : 10+ data tryout (UTBK, SNBT, dll)
echo - Beasiswa      : 15+ data beasiswa (dalam ^& luar negeri)
echo - Kalender      : 30+ event akademik (Maret-Mei 2025)
echo.
echo Database siap digunakan!
echo.
pause
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
    color 0C
    echo [ERROR] Migration gagal!
    echo.
    echo Saran: Gunakan Fresh Migrate untuk fix error
    echo.
    pause
    goto END
)

echo.
echo [INFO] Clearing cache...
call php artisan config:clear >nul 2>&1
call php artisan cache:clear >nul 2>&1

echo.
color 0A
echo [SUCCESS] Migration berhasil!
echo.
pause
goto END

:SEED_ONLY
echo.
echo ========================================
echo   SEED DATABASE
echo ========================================
echo.
echo Pilih seeder:
echo 1. Tryout Seeder (10+ data tryout)
echo 2. Beasiswa Seeder (15+ data beasiswa)
echo 3. Academic Event Seeder (30+ event)
echo 4. Semua Seeder
echo.
set /p seedchoice="Pilihan (1-4): "

if "%seedchoice%"=="1" (
    echo.
    echo [INFO] Running Tryout Seeder...
    call php artisan db:seed --class=TryoutSeeder
    if errorlevel 1 (
        color 0C
        echo [ERROR] Seeder gagal!
        pause
        goto END
    )
    color 0A
    echo [SUCCESS] Tryout Seeder berhasil! (10+ data ditambahkan)
) else if "%seedchoice%"=="2" (
    echo.
    echo [INFO] Running Beasiswa Seeder...
    call php artisan db:seed --class=BeasiswaSeeder
    if errorlevel 1 (
        color 0C
        echo [ERROR] Seeder gagal!
        pause
        goto END
    )
    color 0A
    echo [SUCCESS] Beasiswa Seeder berhasil! (15+ data ditambahkan)
) else if "%seedchoice%"=="3" (
    echo.
    echo [INFO] Running Academic Event Seeder...
    call php artisan db:seed --class=AcademicEventSeeder
    if errorlevel 1 (
        color 0C
        echo [ERROR] Seeder gagal!
        pause
        goto END
    )
    color 0A
    echo [SUCCESS] Academic Event Seeder berhasil! (30+ data ditambahkan)
) else if "%seedchoice%"=="4" (
    echo.
    echo [INFO] Running All Seeders...
    call php artisan db:seed --class=TryoutSeeder
    call php artisan db:seed --class=BeasiswaSeeder
    call php artisan db:seed --class=AcademicEventSeeder
    if errorlevel 1 (
        color 0C
        echo [ERROR] Seeder gagal!
        pause
        goto END
    )
    echo.
    color 0A
    echo [SUCCESS] Semua Seeder berhasil!
    echo - Tryout: 10+ data
    echo - Beasiswa: 15+ data
    echo - Kalender: 30+ event
) else (
    color 0C
    echo [ERROR] Pilihan tidak valid!
    pause
    goto END
)

echo.
pause
goto END

:END
echo.
echo ========================================
echo   Setup Selesai
echo ========================================
echo.
echo Terima kasih telah menggunakan Edvizo Database Setup!
echo.
echo Tekan tombol apa saja untuk keluar...
pause >nul
exit /b 0
