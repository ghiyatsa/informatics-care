# 🔍 Debug Server Error di Railway

Jika Anda masih mendapatkan **Server Error** setelah deploy, ikuti langkah-langkah debugging ini:

## 🚨 Langkah 1: Check Railway Logs

1. Buka Railway Dashboard → Project → Tab **"Deployments"**
2. Klik deployment terakhir
3. Scroll ke bagian **"Logs"** (bukan Build logs, tapi Runtime logs)
4. Cari error messages seperti:
   - `SQLSTATE[HY000]` (Database error)
   - `APP_KEY not set`
   - `Class not found`
   - `500 Internal Server Error`
   - `Permission denied`

## 🔍 Langkah 2: Common Issues & Fixes

### Issue 1: "APP_KEY not set"

**Gejala:** Server error, Laravel tidak bisa decrypt data

**Fix:**
```bash
# Di local terminal
php artisan key:generate --show
# Copy output, paste ke Railway Variables sebagai APP_KEY
```

### Issue 2: Database Connection Failed

**Gejala:** `SQLSTATE[HY000] [2002] Connection refused` atau similar

**Fix:**
1. Pastikan PostgreSQL service sudah dibuat di Railway
2. Check variables DB_* menggunakan format `${{Postgres.XXX}}`
3. Restart service di Railway

### Issue 3: Storage Permissions

**Gejala:** `Permission denied` atau `Storage link failed`

**Fix:**
Script `start.sh` sudah handle ini, tapi jika masih error:
```bash
# Pastikan storage folder writable
chmod -R 775 storage bootstrap/cache
```

### Issue 4: Cache Conflicts

**Gejala:** Route or config errors yang tidak masuk akal

**Fix:**
Script `start.sh` sudah clear cache saat start, tapi jika perlu manual:
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

### Issue 5: Missing Environment Variables

**Gejala:** Undefined index atau null values

**Checklist Variables:**
- [ ] `APP_KEY` - **WAJIB!**
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL` - harus set dengan URL Railway
- [ ] Database variables (`DB_*`)
- [ ] `VITE_APP_URL` - sama dengan `APP_URL`

## 🛠️ Langkah 3: Enable Debug Mode (Temporary)

Untuk melihat error details, set di Railway Variables:

```
APP_DEBUG=true
```

**⚠️ PENTING:** Hanya untuk debugging! Set kembali ke `false` setelah fix.

## 📋 Langkah 4: Test Health Check Endpoint

Railway otomatis setup health check di `/up`. Test di browser:

```
https://your-app.railway.app/up
```

Jika return `{"status":"ok"}`, berarti Laravel berjalan. Jika error, berarti ada masalah di Laravel bootstrap.

## 🔧 Langkah 5: Manual Debug dengan Railway CLI

Install Railway CLI dan cek logs:

```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Link to project
railway link

# View logs real-time
railway logs

# Run command on Railway
railway run php artisan config:clear
railway run php artisan route:clear
```

## 📝 Checklist Debug

Gunakan checklist ini untuk systematic debugging:

- [ ] **Build Success:** Build logs tidak ada error
- [ ] **Assets Built:** `public/build` folder exists
- [ ] **APP_KEY Set:** Variable APP_KEY ada dan valid
- [ ] **Database Connected:** Can connect to PostgreSQL
- [ ] **Storage Writable:** Storage folder permissions OK
- [ ] **Cache Cleared:** Config/Route/View cache cleared
- [ ] **Environment Variables:** Semua variables required sudah set
- [ ] **Start Command:** `start.sh` executed successfully
- [ ] **Port Binding:** Server listening on correct port
- [ ] **Health Check:** `/up` endpoint returns OK

## 🎯 Quick Fix: Redeploy dengan Clear Cache

1. Di Railway Dashboard → **Settings**
2. **Variables** tab → Tambahkan sementara:
   ```
   FORCE_REDEPLOY=true
   ```
3. **Deployments** tab → **Redeploy**
4. Setelah deploy, hapus variable `FORCE_REDEPLOY`

## 🔍 Advanced: Check Laravel Logs

Jika ada file `storage/logs/laravel.log` di Railway:

1. Railway Dashboard → **Deployments**
2. Klik deployment → **"View Logs"**
3. Cari stack trace atau error messages

Atau via Railway CLI:
```bash
railway run cat storage/logs/laravel.log
```

## 💡 Tips

1. **Jangan langsung set APP_DEBUG=true** di production permanent
2. **Check logs** sebelum panik - sering error message sudah jelas
3. **Test health endpoint** `/up` untuk quick check
4. **Compare** dengan local environment - jika local OK, biasanya config issue

## 🆘 Masih Error?

Jika setelah semua langkah di atas masih error:

1. **Copy full error message** dari Railway logs
2. **Screenshot** error page (jika ada)
3. **Check** apakah error sama dengan di local atau berbeda
4. **Share** error details untuk debugging lebih lanjut

Common patterns:
- `500 Internal Server Error` → Check Laravel logs
- `502 Bad Gateway` → Server tidak start, check start command
- `403 Forbidden` → Permission issue
- `404 Not Found` → Route issue (tapi ini biasanya bukan server error)

---

## 📚 Related Files

- [`start.sh`](start.sh) - Start script dengan error handling
- [`deploy.sh`](deploy.sh) - Build script
- [`RAILWAY_LIVEWIRE_FIX.md`](RAILWAY_LIVEWIRE_FIX.md) - Fix khusus Livewire assets

