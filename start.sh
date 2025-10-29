#!/bin/bash
set -e

echo "🚀 Starting Laravel application..."

# Clear caches first (in case of deployment issues)
echo "🧹 Clearing caches..."
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan cache:clear || true

# Verify APP_KEY exists
if [ -z "$APP_KEY" ]; then
    echo "⚠️  WARNING: APP_KEY is not set!"
    echo "   Run: php artisan key:generate"
fi

# Verify database connection (optional, but helpful)
echo "🗄️  Checking database connection..."
php artisan migrate:status > /dev/null 2>&1 || echo "⚠️  Database connection might not be ready"

# Create storage link if needed
php artisan storage:link || echo "ℹ️  Storage link already exists"

# Show environment info
echo "📋 Environment Info:"
echo "   APP_ENV: ${APP_ENV:-not set}"
echo "   APP_DEBUG: ${APP_DEBUG:-not set}"
echo "   APP_URL: ${APP_URL:-not set}"

# Start PHP server
echo "🌐 Starting PHP server on port ${PORT:-8000}..."
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}

