#!/bin/bash

GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

clear
echo "========================================"
echo "   EDVIZO - Database Setup Utility"
echo "========================================"
echo ""

# Cek .env
if [ ! -f .env ]; then
    echo -e "${RED}[ERROR] File .env tidak ditemukan!${NC}"
    echo ""
    echo "Silakan jalankan:"
    echo "  cp .env.example .env"
    echo ""
    echo "Lalu konfigurasi database di file .env"
    exit 1
fi

echo -e "${YELLOW}[INFO] Memeriksa koneksi database...${NC}"
php artisan config:clear > /dev/null 2>&1

# Test koneksi
if ! php artisan db:show > /dev/null 2>&1; then
    echo -e "${RED}[ERROR] Tidak dapat terhubung ke database!${NC}"
    echo ""
    echo "Pastikan:"
    echo "1. MySQL sudah berjalan"
    echo "2. Database sudah dibuat"
    echo "3. Konfigurasi .env sudah benar"
    exit 1
fi

echo -e "${GREEN}[OK] Koneksi database berhasil!${NC}"
echo ""

echo -e "${YELLOW}[INFO] Memeriksa kondisi database...${NC}"

# Cek status migration
if ! php artisan migrate:status > /dev/null 2>&1; then
    echo -e "${YELLOW}[DETECT] Database kosong${NC}"
    echo ""
    echo "Akan menjalankan: migrate --seed"
    read -p "Lanjutkan? (y/n): " confirm
    if [ "$confirm" != "y" ]; then
        exit 0
    fi

    php artisan migrate:fresh --seed

    if [ $? -eq 0 ]; then
        echo ""
        echo -e "${GREEN}[SUCCESS] Database berhasil di-setup!${NC}"
    else
        echo -e "${RED}[ERROR] Setup gagal!${NC}"
        exit 1
    fi
    exit 0
fi

# Cek pending migration
if php artisan migrate:status | grep -q "Pending"; then
    echo -e "${YELLOW}[DETECT] Ada migration pending!${NC}"
    echo ""
    echo "Pilih aksi:"
    echo "1. Fresh migrate + seed (HAPUS SEMUA DATA)"
    echo "2. Migrate biasa"
    read -p "Pilihan (1-2): " choice

    if [ "$choice" == "1" ]; then
        php artisan migrate:fresh --seed
    else
        php artisan migrate
    fi

    if [ $? -eq 0 ]; then
        echo -e "${GREEN}[SUCCESS] Migration berhasil!${NC}"
    fi
else
    echo -e "${GREEN}[DETECT] Database normal${NC}"
    echo ""
    echo "Pilih aksi:"
    echo "1. Migrate biasa"
    echo "2. Fresh migrate + seed"
    echo "3. Seed saja"
    read -p "Pilihan (1-3): " choice

    case $choice in
        1)
            php artisan migrate
            ;;
        2)
            php artisan migrate:fresh --seed
            ;;
        3)
            php artisan db:seed
            ;;
        *)
            echo -e "${RED}Pilihan tidak valid${NC}"
            exit 1
            ;;
    esac
fi

echo ""
echo "========================================"
echo "   Setup Selesai"
echo "========================================"
