# 🚀 Quick Deploy Guide - Railway.app (Paling Mudah)

📖 **Untuk panduan detail step-by-step dengan screenshots, lihat:** [`RAILWAY_SETUP.md`](RAILWAY_SETUP.md)

📋 **Untuk copy-paste environment variables, lihat:** [`RAILWAY_ENV_VARIABLES.txt`](RAILWAY_ENV_VARIABLES.txt)

---

## Metode 1: Via Railway Dashboard (Tidak Perlu CLI)

### Langkah-langkah:

1. **Buat Akun Railway**

    - Kunjungi [railway.app](https://railway.app)
    - Sign up dengan GitHub account

2. **Deploy dari GitHub**

    - Klik "New Project"
    - Pilih "Deploy from GitHub repo"
    - Pilih repository `informatics-care`
    - Railway akan otomatis detect Laravel

3. **Tambahkan Database**

    - Di dashboard project, klik "New"
    - Pilih "Database" → "Add PostgreSQL"
    - Railway akan otomatis set environment variables

4. **Setup Environment Variables**

    - Klik project → Settings → Variables
    - Tambahkan variables berikut:

    ```
    APP_NAME=Informatics Care
    APP_ENV=production
    APP_DEBUG=false
    APP_URL=https://your-app.railway.app

    DB_CONNECTION=pgsql
    DB_HOST=${{Postgres.PGHOST}}
    DB_PORT=${{Postgres.PGPORT}}
    DB_DATABASE=${{Postgres.PGDATABASE}}
    DB_USERNAME=${{Postgres.PGUSER}}
    DB_PASSWORD=${{Postgres.PGPASSWORD}}

    GOOGLE_CLIENT_ID=your_google_client_id
    GOOGLE_CLIENT_SECRET=your_google_client_secret
    GOOGLE_REDIRECT=https://your-app.railway.app/auth/google/callback
    ```

5. **Generate APP_KEY**

    - Di terminal lokal, jalankan:
        ```bash
        php artisan key:generate --show
        ```
    - Copy hasilnya ke Railway variables sebagai `APP_KEY`

6. **Deploy**

    - Railway akan otomatis deploy setiap kali push ke GitHub
    - Atau klik "Deploy" di dashboard

7. **Update Google OAuth**
    - Di [Google Cloud Console](https://console.cloud.google.com)
    - Update redirect URI menjadi: `https://your-app.railway.app/auth/google/callback`

---

## Metode 2: Via Railway CLI

```bash
# 1. Install Railway CLI
npm i -g @railway/cli

# 2. Login
railway login

# 3. Init project
railway init

# 4. Add PostgreSQL database
railway add postgresql

# 5. Set variables (akan membuka editor)
railway variables

# 6. Deploy
railway up
```

---

## ✅ Checklist Setelah Deploy

-   [ ] Aplikasi bisa diakses via URL Railway
-   [ ] Database migrations sudah jalan
-   [ ] Google OAuth redirect URI sudah diupdate
-   [ ] Environment variables sudah lengkap
-   [ ] Assets (CSS/JS) loading dengan benar

---

## 🔧 Troubleshooting

**Error: "APP_KEY not set"**

```bash
# Di local
php artisan key:generate --show
# Copy ke Railway variables
```

**Error: "Database connection failed"**

-   Pastikan PostgreSQL service sudah ditambahkan
-   Check environment variables DB\_\* sudah benar
-   Restart service

**Assets tidak loading**

-   Pastikan `npm run build` dijalankan
-   Check `public/build` folder sudah ada
-   Clear cache: `php artisan cache:clear`

---

## 🎉 Selesai!

Aplikasi sudah online di Railway! 🚀
