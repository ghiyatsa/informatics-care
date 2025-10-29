# Informatics Care

Platform pelaporan masalah sarana dan prasarana untuk Prodi Teknik Informatika Universitas Malikussaleh.

## Fitur Utama

✅ **Landing Page** - Halaman depan yang informatif  
✅ **Autentikasi Google OAuth** - Login dengan Google atau email mahasiswa  
✅ **Manajemen Laporan** - Buat, lihat, dan lacak status laporan  
✅ **Dashboard Admin** - Kelola pengguna, kategori, dan laporan  
✅ **Multi-level User** - Role admin dan user  
✅ **Dark Mode** - Dukungan dark mode otomatis

## Teknologi

-   **Laravel 12** - Framework PHP
-   **Livewire + Volt** - Reactive components
-   **Livewire Flux** - UI Components
-   **Laravel Fortify** - Authentication
-   **Laravel Socialite** - OAuth integration
-   **TailwindCSS** - Styling

## 🚀 Deployment dengan Railway.app

Aplikasi ini di-deploy menggunakan **Railway.app** - platform yang mudah digunakan dan mendukung Laravel secara native.

### 📚 Panduan Deployment

- **[RAILWAY_SETUP.md](RAILWAY_SETUP.md)** - Panduan lengkap step-by-step (direkomendasikan untuk pemula)
- **[QUICK_DEPLOY.md](QUICK_DEPLOY.md)** - Quick reference guide
- **[RAILWAY_ENV_VARIABLES.txt](RAILWAY_ENV_VARIABLES.txt)** - Template environment variables untuk copy-paste

**Quick Steps:**

1. Sign up di [railway.app](https://railway.app) dengan GitHub
2. New Project → Deploy from GitHub repo
3. Tambahkan PostgreSQL database
4. Set environment variables (lihat `RAILWAY_ENV_VARIABLES.txt`)
5. Deploy! 🎉

## Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
cd informatics-care
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Environment

Copy file `.env.example` ke `.env`:

```bash
cp .env.example .env
```

Edit file `.env` dan tambahkan konfigurasi berikut:

```env
APP_NAME="Informatics Care"
APP_URL=http://localhost

DB_CONNECTION=sqlite
# Atau gunakan MySQL/PostgreSQL
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=informatics_care
# DB_USERNAME=root
# DB_PASSWORD=

# Google OAuth Configuration
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT=http://localhost/auth/google/callback
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Buat Database SQLite (jika menggunakan SQLite)

```bash
touch database/database.sqlite
```

### 6. Run Migrations dan Seeders

```bash
php artisan migrate
php artisan db:seed
```

### 7. Build Assets

```bash
npm run build
```

Atau untuk development:

```bash
npm run dev
```

### 8. Start Server

```bash
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

## Akun Default

Setelah menjalankan seeder, akun berikut tersedia:

### Admin

-   Email: `admin@informatics-care.local`
-   Password: `password`

### User

-   Email: `mahasiswa@informatics-care.local`
-   Password: `password`

## Setup Google OAuth (Opsional)

**Catatan:** Jika domain Anda terbatas oleh organisasi dan Google Auth tidak berfungsi, gunakan login dengan email dan password biasa.

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat proyek baru atau pilih proyek yang ada
3. Aktifkan **Google+ API** atau **Google Identity API**
4. Buat OAuth 2.0 credentials dengan tipe **Web Application**
5. Tambahkan authorized redirect URI: `http://localhost/auth/google/callback`
6. Copy Client ID dan Client Secret ke file `.env`

**Troubleshooting Google OAuth:**

-   **Error "Access blocked":** Domain Anda mungkin dibatasi oleh organisasi
-   **Solusi:** Gunakan login dengan email dan password biasa
-   Pastikan credentials di `.env` sudah benar
-   Pastikan redirect URI sesuai dengan yang ada di Google Console

## Struktur Aplikasi

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/        # Admin controllers
│   │   ├── Reports/      # Report controllers
│   │   └── Auth/         # Auth controllers
│   └── Middleware/
│       └── EnsureUserIsAdmin.php
├── Models/
│   ├── User.php          # User model
│   ├── Report.php        # Report model
│   └── Category.php      # Category model
└── Providers/

database/
├── migrations/           # Database migrations
├── seeders/             # Database seeders
└── factories/           # Model factories

resources/
├── views/
│   ├── landing.blade.php        # Landing page
│   ├── dashboard.blade.php     # User dashboard
│   ├── reports/                 # Report views
│   ├── admin/                   # Admin views
│   └── livewire/                # Livewire components
└── css/
    └── app.css          # Global styles

routes/
└── web.php             # Application routes
```

## Penggunaan

### Sebagai User

1. **Login/Register**

    - Akses halaman login atau register
    - Gunakan Google OAuth atau email/password
    - Pastikan menggunakan email mahasiswa (jika ada validasi)

2. **Buat Laporan**

    - Klik "Buat Laporan" di dashboard
    - Pilih kategori
    - Isi judul, lokasi, dan deskripsi
    - Submit laporan

3. **Lihat Laporan Saya**
    - Akses "Laporan Saya" di dashboard
    - Lihat status dan respons admin

### Sebagai Admin

1. **Login sebagai Admin**

    - Login dengan akun admin
    - Klik "Admin Panel" di dashboard

2. **Manajemen Laporan**

    - Lihat semua laporan
    - Update status (Pending, Proses, Selesai, Ditolak)
    - Tambahkan respons/admin notes

3. **Manajemen Kategori**

    - Tambah/edit/hapus kategori
    - Lihat jumlah laporan per kategori

4. **Manajemen User**
    - Lihat daftar semua user
    - Edit informasi user
    - Ubah role (user/admin)

## Routes

### Public Routes

-   `/` - Landing page
-   `/login` - Login page
-   `/register` - Register page

### User Routes

-   `/dashboard` - User dashboard
-   `/reports/create` - Create report
-   `/reports/my-reports` - My reports

### Admin Routes

-   `/admin/reports` - Manage reports
-   `/admin/categories` - Manage categories
-   `/admin/users` - Manage users

## Database Schema

### Users Table

-   `id`, `name`, `email`, `password`
-   `role` (user/admin)
-   `student_id`
-   `timestamps`

### Categories Table

-   `id`, `name`, `description`
-   `timestamps`

### Reports Table

-   `id`, `user_id`, `category_id`
-   `title`, `description`, `location`
-   `status` (pending/in_progress/completed/rejected)
-   `admin_response`
-   `timestamps`

## Contributing

1. Fork repository
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## License

Proyek ini dikembangkan untuk Prodi Teknik Informatika Universitas Malikussaleh.

## Support

Untuk pertanyaan atau bantuan, silakan hubungi:

-   Email: support@informatics-care.local
-   Website: Informatics Care - Prodi Teknik Informatika UMSA

---

Dikembangkan dengan ❤️ untuk Prodi Teknik Informatika Universitas Malikussaleh
