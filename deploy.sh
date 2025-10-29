#!/bin/bash
set -e

echo "🚀 Starting deployment..."

echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

echo "📦 Installing Node dependencies..."
npm ci

echo "🏗️  Building assets..."
npm run build

echo "⚙️  Caching configuration..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "🗄️  Running migrations..."
php artisan migrate --force || echo "⚠️  Migration failed or already run"

echo "✨ Deployment complete!"

