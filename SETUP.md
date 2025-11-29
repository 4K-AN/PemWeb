# Edvizo - Setup Guide

## Cara Setup Project di Device Baru

### 1. Clone Repository
```bash
git clone [repository-url]
cd PemWeb
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env`:
