# 🔴 Fix 500 Server Error - Quick Guide

500 Server Error biasanya berarti **Laravel application crash** saat handle request. Ikuti langkah ini:

## ⚡ Quick Fix Steps

### Step 1: Enable Debug Mode

Di Railway Dashboard → **Variables** tab, tambahkan:

```
APP_DEBUG=true
```

**Ini akan menampilkan detail error di browser.** Setelah fix, kembalikan ke `false`.

---

### Step 2: Check Railway Logs

1. Railway Dashboard → **Deployments** tab
2. Klik deployment terakhir
3. Scroll ke **"Logs"** (Runtime logs, bukan Build logs)
4. Cari error messages terakhir

---

### Step 3: Common Causes & Fixes

#### 🔑 Issue 1: APP_KEY Not Set

**Error di logs:** `No application encryption key has been specified`

**Fix:**
```bash
# Di local terminal
php artisan key:generate --show
```

Copy output, paste ke Railway Variables sebagai:
```
APP_KEY=base64:xxxxxxxxxxxxx
```

---

#### 🗄️ Issue 2: Database Connection Failed

**Error di logs:** `SQLSTATE[HY000]` atau `Connection refused`

**Fix:**
1. Pastikan PostgreSQL service sudah dibuat
2. Check Variables DB_* menggunakan format:
   ```
   DB_CONNECTION=pgsql
   DB_HOST=${{Postgres.PGHOST}}
   DB_PORT=${{Postgres.PGPORT}}
   DB_DATABASE=${{Postgres.PGDATABASE}}
   DB_USERNAME=${{Postgres.PGUSER}}
   DB_PASSWORD=${{Postgres.PGPASSWORD}}
   ```
3. Restart service di Railway

---

#### 📁 Issue 3: Storage Permission

**Error:** `The stream or file ... could not be opened`

**Fix:**
Railway biasanya handle ini, tapi jika masih error, pastikan storage writable:
```bash
chmod -R 775 storage bootstrap/cache
```

---

#### 🔧 Issue 4: Cache Corrupted

**Error:** Route atau config tidak ditemukan

**Fix:**
Add di Railway Variables (temporary):
```
CLEAR_CACHE=true
```

Atau manual clear via Railway CLI:
```bash
railway run php artisan config:clear
railway run php artisan route:clear
railway run php artisan view:clear
railway run php artisan cache:clear
```

---

#### 📦 Issue 5: Missing Dependencies

**Error:** `Class not found` atau `Unable to locate class`

**Fix:**
Check build logs, pastikan `composer install` berhasil tanpa error.

---

### Step 4: Test Minimal Request

Test health endpoint:
```
https://your-app.railway.app/up
```

Jika ini juga error, berarti masalah di Laravel bootstrap, bukan route specific.

---

### Step 5: Check Error Details

Setelah set `APP_DEBUG=true`, refresh browser. Anda akan lihat:
- **Error message**
- **File dan line number**
- **Stack trace**

Copy error message ini untuk debugging lebih lanjut.

---

## 🔍 Debugging Checklist

Gunakan checklist ini:

- [ ] **APP_KEY** sudah di-set di Variables
- [ ]安全检查**Database** variables sudah benar (format `${{Postgres.XXX}}`)
- [ ] **APP_DEBUG=true** untuk lihat error detail
- [ ] Check **Railway Logs** untuk error messages
- [ ] Test **/up endpoint** untuk quick check
- [ ] **Storage permissions** OK (biasanya auto-handled)
- [ ] **Environment variables** semua sudah di-set

---

## 🆘 Still Getting 500?

Jika setelah semua langkah masih 500:

1. **Copy full error message** dari browser (dengan APP_DEBUG=true)
2. **Copy logs** dari Railway
3. **Check** apakah error sama seperti di local atau berbeda
4. **Share** error details untuk debugging

**Most Common 500 Errors:**
- Missing APP_KEY
- Database connection failed  
- Route cache corrupted
- Missing .env variables
- Class not found (autoload issue)

---

## 💡 Quick Test

Coba akses endpoint ini untuk isolate masalah:

1. **Health Check:** `/up` → Should return `{"status":"ok"}`
2. **Home:** `/` → Landing page
3. **If health OK but home 500** → Route/View issue
4. **If health also 500** → Laravel bootstrap issue

---

## 🔧 Alternative: Temporary Workaround

Jika urgent, bisa bypass cache:

1. Railway Variables → Tambahkan:
   ```
   APP_DEBUG=true
   CACHE_DRIVER=array
   SESSION_DRIVER=array
   ```
2. Redeploy
3. Test lagi

**Setelah fix, kembalikan ke production settings.**

---

**Bantu saya debug:** Set `APP_DEBUG=true`, refresh browser, dan share error message yang muncul!

