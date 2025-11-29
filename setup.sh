#!/bin/bash

echo "🚀 Setting up Edvizo..."

# Install dependencies
echo "📦 Installing PHP dependencies..."
composer install

echo "📦 Installing Node dependencies..."
npm install

# Setup environment
echo "⚙️  Setting up environment..."
cp .env.example .env
php artisan key:generate

# Database setup
echo "💾 Setting up database..."
php artisan migrate --seed

# Link storage
echo "🔗 Linking storage..."
php artisan storage:link

# Build assets
echo "🎨 Building assets..."
npm run build

echo "✅ Setup complete! Run 'php artisan serve' to start the server."
