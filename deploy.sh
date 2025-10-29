#!/bin/bash
set -e

echo "🚀 Starting deployment..."

# Check Node.js version
echo "📦 Checking Node.js version..."
node --version
npm --version

echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

echo "📦 Installing Node dependencies..."
npm ci --prefer-offline --no-audit

echo " automated Building assets with Vite..."
# Set production mode for Vite
export NODE_ENV=production
npm run build

# Verify build output
if [ ! -d "public/build" ]; then
    echo "⚠️  ERROR: public/build directory not found after build!"
    echo "📋 Build logs:"
    ls -la public/ || true
    exit 1
fi

echo "✅ Assets built successfully!"
echo "📋 Build output:"
ls -lh public/build/ || true

echo "🔗 Creating storage link..."
php artisan storage:link || echo "⚠️  Storage link already exists"

echo "⚙️  Optimizing application..."
# Clear first to avoid conflicts
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Then cache for production
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "🗄️  Running migrations..."
php artisan migrate --force || echo "⚠️  Migration failed or already run"

echo "✨ Deployment complete!"
