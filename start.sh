#!/bin/bash
set -e

echo "🚀 Starting Laravel application..."

# Verify APP_KEY exists FIRST (critical)
if [ -z "$APP_KEY" ]; then
    echo "❌ ERROR: APP_KEY is not set!"
    echo "   This will cause 500 errors!"
    echo "   Generate with: php artisan key:generate --show"
    echo "   Set in Railway Variables as APP_KEY"
    exit 1
fi

echo "✅ APP_KEY is set"

# Clear caches first (in case of deployment issues)
echo "🧹 Clearing caches..."
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan cache:clear || true

# Verify database connection (optional, but helpful)
echo "🗄️  Checking database connection..."
if php artisan migrate:status > /dev/null 2>&1; then
    echo "✅ Database connection OK"
else
    echo "⚠️  Database connection might not be ready (non-critical)"
    echo "   If you see database errors, check DB_* environment variables"
fi

# Create storage link if needed (suppress error if already exists)
php artisan storage:link 2>&1 | grep -v "already exists" || echo "ℹ️  Storage link ready"

# Show environment info
echo "📋 Environment Info:"
echo "   APP_ENV: ${APP_ENV:-not set}"
echo "   APP_DEBUG: ${APP_DEBUG:-not set}"
echo "   APP_URL: ${APP_URL:-not set}"

# Start PHP server
echo "🌐 Starting PHP server on port ${PORT:-8000}..."
echo "✅ Laravel is ready! Server starting..."
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000} --no-reload

