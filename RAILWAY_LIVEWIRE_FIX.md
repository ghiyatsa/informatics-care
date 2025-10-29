# 🔧 Fix Server Error - Livewire Assets Not Loading

Jika Anda mendapatkan **Server Error** setelah deploy, kemungkinan besar masalahnya adalah **assets Livewire/Vite tidak ter-build dengan benar**.

## ✅ Solusi Step-by-Step:

### 1. Verifikasi Build Process di Railway

1. Buka Railway dashboard → Project → **Deployments** tab
2. Klik deployment terakhir
3. Scroll ke bagian build logs
4. Cari log yang berkaitan dengan:
    - `npm ci`
    - `npm run build`
    - `Building assets with Vite`

**Pastikan tidak ada error** di bagian tersebut.

### 2. Check Environment Variables

Tambahkan variable berikut di Railway **Variables** tab:

```
VITE_APP_NAME=Informatics Care
VITE_APP_URL=https://your-app.railway.app
```

**PENTING:** Set `VITE_APP_URL` dengan URL Railway Anda (sama dengan `APP_URL`).

### 3. Verifikasi Build Output

Setelah deploy, check apakah `public/build` folder ada:

1. Di Railway dashboard, buka **Deployments**
2. Klik deployment terakhir
3. Scroll ke logs, cari baris:
    ```
    ✅ Assets built successfully!
    📋 Build output:
    ```
4. Pastikan ada file-file di dalamnya (seperti `manifest.json`, `.js`, `.css`)

Jika **TIDAK ADA**, berarti build gagal.

### 4. Force Rebuild

Jika build gagal:

1. Di Railway dashboard → Project → **Settings**
2. Scroll ke **"Deployments"** section
3. Klik **"Clear Build Cache"** (jika ada)
4. Atau buat deployment baru:
    - Tab **"Deployments"**
    - Klik **"Redeploy"** → **"Deploy now"**

### 5. Check Build Logs untuk Error

Cari error seperti:

```
⚠️  ERROR: public/build directory not found after build!
```

Atau:

```
npm ERR! ...
```

**Common issues:**

#### a. Node.js version tidak compatible

-   Railway biasanya auto-detect, tapi bisa force dengan `nixpacks.toml`

#### b. npm install gagal

-   Check `package.json` dependencies
-   Pastikan tidak ada dependency yang broken

#### c. Vite build error

-   Check `vite.config.js`
-   Pastikan Laravel Vite plugin terinstall

### 6. Manual Fix: Deploy dengan Build Command Explicit

Jika masih error, coba override build command di Railway:

1. Tab **Settings** → Scroll ke **"Build"** Luaan
2. Set`:\*\*
    - **Build Command:**
        ```bash
        composer install --no-dev --optimize-autoloader && npm ci && npm run build && php artisan storage:link && php artisan config:cache && php artisan route:cache && php artisan view:cache
        ```

### 7. Alternative: Build Assets Lokal

Jika Railway build terus gagal:

```bash
# 1. Build assets lokal
npm run build

# 2. Commit public/build folder (temporarily untuk testing)
git add public/build
git commit -m "Add built assets"
git push

# 3. Deploy ke Railway
# 4. Setelah berhasil, revert commit ini dan setup build yang benar
```

**⚠️ Catatan MENING:** Ini hanya untuk testing. Jangan commit `public/build` ke production secara permanen!

---

## 🔍 Debugging Checklist

Gunakan checklist ini untuk debug:

-   [ ] Build logs menunjukkan `npm run build` berhasil
-   [ ] Logs menunjukkan `✅ Assets built successfully!`
-   [ ] `public/build` folder ada di build output
-   [ ] `public/build/manifest.json` ada
-   [ ] `VITE_APP_URL` environment variable di-set dengan benar
-   [ ] `APP_URL` sama dengan `VITE_APP_URL`
-   [ ] Browser console tidak menunjukkan 404 untuk asset files
-   [ ] Network tab menunjukkan asset files loading (200 OK)

---

## 🐛 Common Errors & Solutions

### Error: "Vite manifest not found"

**Solution:**

```bash
# Pastikan build berjalan dengan benar
npm run build
# Verify public/build/manifest.json exists
```

### Error: "Failed to load resource: 404"

**Solution:**

-   Pastikan `VITE_APP_URL` di-set dengan benar
-   Pastikan `public/build` folder ter-build
-   Clear browser cache
-   Check Railway logs untuk asset paths

### Error: "npm: command not found"

**Solution:**

-   Railway seharusnya auto-install Node.js
-   Check Railway build logs untuk Node.js installation
-   Jika tidak ada, mungkin perlu setup `nixpacks.toml`

### Error: "Storage link failed"

**Solution:**

-   Ini tidak critical untuk assets, tapi bisa ditambahkan:

```bash
php artisan storage:link
```

---

## 📝 Update Environment Variables

production:

1. Go to Railway → Variables tab
2. Add/Update:
    ```
    VITE_APP_NAME=Informatics Care
    VITE_APP_URL=https://your-app.railway.app
    ```

Pastikan `VITE_APP_URL` sama dengan `APP_URL`!

---

## 🎯 Quick Fix Steps

Jika masih error setelah semua langkah di atas:

1. **Clear build cache** (Railway Settings)
2. **Redeploy** dengan build command manual
3. **Check logs** untuk specific error
4. **Verify** `public/build` folder exists
5. **Test** di browser dengan hard refresh (Ctrl+Shift+R)

---

## 💡 Tips

-   Railway biasanya auto-detect Laravel dan install Node.js
-   Build process seharusnya otomatis dengan `deploy.sh`
-   Jika build gagal, check logs di Railway dashboard
-   Pastikan `.gitignore` TIDAK meng-ignore `public/build` (tapi ini normal untuk commit)

---

**Masih error?** Share Railway build logs dan saya bisa bantu debug lebih lanjut!
