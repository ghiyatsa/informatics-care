# 🚂 Panduan Setup Railway.app - Step by Step

## 📋 Checklist Pra-Deployment

Sebelum mulai, pastikan:
- [x] Repository sudah di-push ke GitHub
- [ ] Akun Railway sudah dibuat
- [ ] Google OAuth credentials sudah siap
- [ ] Database PostgreSQL akan dibuat otomatis oleh Railway

---

## 🎯 Step 1: Buat Akun Railway

1. Buka [railway.app](https://railway.app)
2. Klik **"Start a New Project"** atau **"Login"**
3. Pilih **"Login with GitHub"**
4. Authorize Railway untuk akses ke GitHub repositories
5. Akun Railway Anda sudah siap! ✅

---

## 🎯 Step 2: Deploy dari GitHub

1. Di dashboard Railway, klik **"New Project"**
2. Pilih **"Deploy from GitHub repo"**
3. Jika pertama kali, klik **"Configure GitHub App"** dan berikan permission
4. Pilih repository: **`informatics-care`** (atau nama repo Anda)
5. Railway akan otomatis:
   - Detect bahwa ini adalah Laravel project
   - Mulai build process
   - Tapi **JANGAN DEPLOY DULU**, kita perlu setup database dulu!

---

## 🎯 Step 3: Tambahkan PostgreSQL Database

1. Di dashboard project Railway, klik **"+ New"**
2. Pilih **"Database"** → **"Add PostgreSQL"**
3. Tunggu beberapa detik sampai database selesai dibuat
4. Railway akan **otomatis** menambahkan environment variables:
   - `PGHOST`
   - `PGPORT`
   - `PGDATABASE`
   - `PGUSER`
   - `PGPASSWORD`

**✅ Database sudah siap!**

---

## 🎯 Step 4: Generate APP_KEY

Buka terminal lokal dan jalankan:

```bash
紙php artisan key:generate --show
```

**Copy output-nya** (format: `base64:xxxxxxxxxxxxx`)

Anda akan membutuhkannya di step berikutnya.

---

## 🎯 Step 5: Setup Environment Variables

1. Di dashboard Railway project, klik tab **"Variables"**
2. Klik **"+ New Variable"** dan tambahkan satu per satu:

### Variables Wajib:

```
APP_NAME=Informatics Care
```

```
APP_ENV=production
```

```
APP_DEBUG=false
```

```
APP_KEY=paste_hasil_dari_step_4_di_sini
```
*Contoh: `APP_KEY=base64 gL5kPj8mN2qR7sT9uV1wX3yZ5bC8dE0fG2hI4jK6lM9nO1pQ3rS5tU7vW9xY1zA3`

```
APP_URL=https://your-app-name.railway.app
```
*Ganti `your-app-name` dengan nama project Anda (akan muncul setelah deploy pertama)*

### Database Variables (Otomatis oleh Railway):

Variables ini sudah otomatis dibuat saat menambah PostgreSQL. Tapi pastikan formatnya seperti ini:

```
DB_CONNECTION=pgsql
DB_HOST=${{Postgres.PGHOST}}
DB_PORT=${{Postgres.PGPORT}}
DB_DATABASE=${{Postgres.PGDATABASE}}
DB_USERNAME=${{Postgres.PGUSER}}
DB_PASSWORD=${{Postgres.PGPASSWORD}}
```

**Catatan:** Format `${{Postgres.XXX}}` adalah Railway syntax untuk reference ke database service.

### Google OAuth Variables:

```
GOOGLE_CLIENT_ID=your_google_client_id_dari_google_cloud_console
```

```
GOOGLE_CLIENT_SECRET=your_google_client_secret_dari_google_cloud_console
```

```
GOOGLE_REDIRECT=https://your-app-name.railway.app/auth/google/callback
```
*Update setelah dapat URL final*

### Variables Tambahan (Opsional tapi Direkomendasikan):

```
SESSION_DRIVER=database
```

```
CACHE_DRIVER=database
```

```
QUEUE_CONNECTION=database
```

```
LOG_LEVEL=error
```

---

## 🎯 Step 6: Deploy Pertama Kali

1. Setelah semua variables di-set, Railway akan **otomatis** redeploy
2. Atau klik **"Deploy"** manual jika perlu
3. Tunggu build process selesai (biasanya 2-5 menit)
4. Build logs bisa dilihat di tab **"Deployments"**

**✅ Build akan menjalankan:**
- `composer install --no-dev`
- `npm ci`
- `npm run build`
- `php artisan migrate --force`
- Dll (sesuai `deploy.sh`)

---

## 🎯 Step 7: Dapatkan URL Aplikasi

1. Setelah deploy selesai, klik tab **"Settings"**
2. Scroll ke bagian **"Domains"**
3. Railway sudah auto-generate URL seperti: `informatics-care-production.up.railway.app`
4. **Copy URL ini**

---

## 🎯 Step 8: Update APP_URL dan GOOGLE_REDIRECT

1. Kembali ke tab **"Variables"**
2. Update `APP_URL` dengan URL yang baru didapat:
   ```
   APP_URL=https://informatics-care-production.up.railway.app
   ```

3. Update `GOOGLE_REDIRECT`:
   ```
   GOOGLE_REDIRECT=https://informatics-care-production.up.railway.app/auth/google/callback
   ```

4. Railway akan otomatis redeploy setelah variable di-update

---

## 🎯 Step 9: Update Google OAuth Redirect URI

1. Buka [Google Cloud Console](https://console.cloud.google.com)
2. Pilih project Anda
3. Navigate ke **APIs & Services** → **Credentials**
4. Klik OAuth 2.0 Client ID Anda
5. Di bagian **Authorized redirect URIs**, tambahkan:
   ```
   https://informatics-care-production.up.railway.app/auth/google/callback
   ```
6. Klik **Save**

---

## 🎯 Step 10: Test Aplikasi

1. Buka URL aplikasi di browser
2. Test fitur-fitur:
   - [ ] Landing page bisa diakses
   - [ ] Login/Register bekerja
   - [ ] Google OAuth berfungsi (jika di-setup)
   - [ ] Database connection bekerja
   - [ ] Assets (CSS/JS) loading dengan benar

---

## 🔧 Troubleshooting

### Error: "APP_KEY not set"
- Pastikan sudah generate dan set `APP_KEY` di Variables
- Format harus: `base64:xxxxxxxxxxxxx`

### Error: "Database connection failed"
- Pastikan PostgreSQL database sudah dibuat
- Check variables DB_* sudah benar
- Pastikan menggunakan format `${{Postgres.XXX}}`
- Restart service di Railway

### Error: "Assets not loading"
- Check build logs apakah `npm run build` berhasil
- Pastikan `public/build` folder ada
- Clear browser cache

### Build Fails: "composer install failed"
- Check build logs untuk error detail
- Pastikan `composer.json` valid
- Pastikan PHP version compatible (8.2+)

### Migration Error
- Check database connection dulu
- Pastikan variables DB_* sudah benar
- Lihat logs di Railway untuk detail error

---

## 📝 Verifikasi Deployment

Setelah semua setup, pastikan:

- [ ] Aplikasi bisa diakses via URL Railway
- [ ] Landing page loading dengan benar
- [ ] Login/Register form muncul
- [ ] Database migrations sudah jalan (check via Railway logs)
- [ ] Assets (CSS/JS) loading
- [ ] Tidak ada error di Railway logs
- [ ] Google OAuth redirect URI sudah diupdate

---

## 🎉 Selamat!

Aplikasi Anda sudah online di Railway! 🚀

**URL Aplikasi:** `https://your-app.railway.app`

Setiap kali push ke GitHub, Railway akan otomatis deploy ulang (jika auto-deploy enabled).

---

## 📚 Referensi

- [Railway Documentation](https://docs.railway.app)
- [Railway Discord](https://discord.gg/railway)
- [Laravel Deployment Guide](https://laravel.com/docs/deployment)

---

**Perlu Bantuan?** Check Railway logs atau Railway Discord community!

