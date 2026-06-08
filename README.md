<div align="center">

<br>

<img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
<img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
<img src="https://img.shields.io/badge/TailwindCSS-4.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
<img src="https://img.shields.io/badge/Vite-7.x-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
<img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="MIT License">

<br><br>

# 🏔️ VisitBatu

### *Platform Panduan Wisata Premium — Kota Batu, Jawa Timur*

**VisitBatu** adalah aplikasi web full-stack yang berfungsi sebagai portal kurasi wisata terpercaya untuk membantu wisatawan menemukan dan menjelajahi keindahan Kota Batu. Dari destinasi alam yang memukau hingga taman hiburan berstandar internasional — semua tersedia dalam satu platform.

[🌐 Demo Live](#) · [🐛 Laporkan Bug](../../issues) · [✨ Request Fitur](../../issues)

</div>

---

## 📋 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Tech Stack](#-tech-stack)
- [Arsitektur & Struktur Proyek](#-arsitektur--struktur-proyek)
- [Instalasi & Setup](#-instalasi--setup)
- [Konfigurasi Environment](#-konfigurasi-environment)
- [Database & Seeding](#-database--seeding)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Panduan Pengguna](#-panduan-pengguna)
- [Panduan Admin](#-panduan-admin)
- [Sistem Autentikasi](#-sistem-autentikasi)
- [Pengiriman Email](#-pengiriman-email)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)

---

## 🏔️ Tentang Proyek

**VisitBatu** lahir dari semangat untuk mempromosikan pariwisata Kota Batu yang kaya dan beragam. Platform ini tidak hanya menjadi direktori destinasi wisata, tetapi juga sebuah komunitas di mana para wisatawan dapat berbagi pengalaman melalui ulasan dan blog perjalanan.

### Mengapa VisitBatu?

- 🗺️ **Kurasi Terstruktur** — Destinasi dikategorikan (Taman Hiburan, Museum, Alam & Kebun, Kebun Binatang, Ruang Publik) untuk memudahkan pencarian.
- 🌟 **Komunitas Wisatawan** — Pengguna dapat menulis dan berbagi cerita perjalanan yang dimoderasi oleh admin.
- 🔒 **Keamanan Berlapis** — Dilengkapi OTP via email dan opsi login Google OAuth untuk pengalaman yang aman dan mudah.
- 🌙 **Dark Mode** — Antarmuka responsif dengan dukungan mode gelap menggunakan palet warna *blue-charcoal* yang didesain khusus.
- 📍 **Peta Interaktif** — Setiap destinasi dilengkapi dengan embed Google Maps untuk navigasi mudah.

---

## ✨ Fitur Utama

### 🌍 Untuk Pengunjung Umum
| Fitur | Deskripsi |
|---|---|
| **Beranda Dinamis** | Hero section sinematik dengan daftar destinasi *top pick* dan cerita wisatawan terbaru. |
| **Daftar Destinasi** | Halaman pencarian & filter destinasi berdasarkan nama, kategori, harga maksimal, dan sorting (termurah, termahal, terbaru, rekomendasi). |
| **Detail Destinasi** | Halaman lengkap tiap wisata: foto, harga tiket, jam operasional, lokasi, deskripsi mendalam, embed peta Google Maps, serta tombol kontak WhatsApp. |
| **Sistem Ulasan & Rating** | Pengguna terautentikasi dapat memberikan ulasan dan rating bintang pada setiap destinasi. Rating rata-rata ditampilkan secara dinamis. |
| **Blog / Traveler's Stories** | Halaman blog menampilkan cerita perjalanan dari komunitas, dengan *featured post* dan paginasi. |
| **Detail Artikel Blog** | Halaman artikel lengkap dengan konten postingan, info penulis, serta rekomendasi bacaan lainnya di sidebar. |
| **Halaman Kontak** | Formulir kontak yang terhubung langsung ke email admin via layanan Brevo. |
| **Halaman About** | Halaman profil platform VisitBatu. |

### 👤 Untuk Pengguna Terdaftar
| Fitur | Deskripsi |
|---|---|
| **Dashboard Pengguna** | Ringkasan aktivitas, daftar postingan pribadi, dan status moderasi. |
| **Manajemen Postingan (Blog)** | Buat, edit, dan hapus postingan blog pribadi. Postingan memerlukan persetujuan admin sebelum tayang. |
| **Manajemen Profil** | Ubah nama, foto profil, dan password akun. |
| **Notifikasi** | Sistem notifikasi real-time (misalnya, saat postingan disetujui/ditolak) dengan fitur tandai sudah dibaca. |

### 🛡️ Untuk Admin
| Fitur | Deskripsi |
|---|---|
| **Dashboard Admin** | Statistik ringkasan: total trips, total pengguna, postingan pending, dan ulasan terbaru. |
| **Manajemen Destinasi (CRUD)** | Tambah, edit, dan hapus destinasi wisata, termasuk upload thumbnail, koordinat GPS, embed peta, dan nomor WhatsApp. Slug otomatis di-generate dari judul. |
| **Manajemen Kategori (CRUD)** | Kelola kategori destinasi wisata. |
| **Moderasi Postingan** | Setujui atau tolak postingan blog yang dikirimkan oleh pengguna. |
| **Manajemen Profil Admin** | Perbarui data dan password akun admin. |

---

## 🛠️ Tech Stack

### Backend
- **[Laravel 12](https://laravel.com/)** — PHP Framework (MVC)
- **PHP 8.2+**
- **[Laravel Socialite](https://laravel.com/docs/socialite)** — Integrasi OAuth (Google)
- **[Symfony Brevo Mailer](https://github.com/symfony/brevo-mailer)** — Driver pengiriman email via Brevo API

### Frontend
- **Blade Templates** — Templating engine Laravel
- **[Tailwind CSS v4](https://tailwindcss.com/)** — Utility-first CSS framework
- **[Vite 7](https://vite.dev/)** — Build tool & dev server frontend cepat
- **Vanilla JavaScript** — Interaktivitas UI (toggle dark mode, navbar efek scroll, dll.)

### Database & Storage
- **SQLite** (default development) — Database ringan untuk lokal
- **Laravel File Storage** — Manajemen upload file (gambar thumbnail trip, avatar pengguna)

### Development Tools
- **[Laravel Pail](https://github.com/laravel/pail)** — Log viewer real-time di terminal
- **[Laravel Pint](https://github.com/laravel/pint)** — PHP code style fixer
- **[Laravel Sail](https://laravel.com/docs/sail)** — Docker development environment
- **[PHPUnit 11](https://phpunit.de/)** — Unit testing

---

## 📁 Arsitektur & Struktur Proyek

Proyek ini mengikuti arsitektur standar **Laravel MVC (Model-View-Controller)** dengan pemisahan yang jelas antara logika admin dan pengguna biasa.

```
VisitBatu/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Controller khusus Admin (Trip, Category, Post, Profile, Dashboard)
│   │   │   ├── Auth/           # Controller Google OAuth
│   │   │   ├── User/           # Controller khusus User (Dashboard, Post, Profile)
│   │   │   ├── AuthController.php      # Login, Register, OTP, Forgot Password
│   │   │   ├── HomeController.php      # Halaman publik (Beranda, Destinasi, Blog, Kontak)
│   │   │   └── ReviewController.php    # Sistem ulasan & rating
│   │   └── Middleware/
│   │       └── IsAdmin.php     # Middleware proteksi rute admin
│   ├── Mail/
│   │   └── ContactMail.php     # Mailable untuk form kontak
│   ├── Models/
│   │   ├── User.php            # Model User (OTP, OAuth, Role)
│   │   ├── Trip.php            # Model Destinasi Wisata
│   │   ├── Category.php        # Model Kategori Wisata
│   │   ├── Post.php            # Model Artikel Blog
│   │   └── Review.php          # Model Ulasan & Rating
│   ├── Notifications/
│   │   └── OtpNotification.php # Notifikasi pengiriman kode OTP
│   └── Providers/
│       └── AppServiceProvider.php  # Registrasi Brevo Mail Transport
│
├── database/
│   ├── migrations/             # 15 file migrasi (skema database lengkap)
│   └── seeders/
│       ├── DatabaseSeeder.php  # Entry point seeder utama
│       ├── CategorySeeder.php  # Seed 5 kategori wisata
│       └── TripSeeder.php      # Seed 12 destinasi wisata Kota Batu (dengan data nyata)
│
├── resources/
│   ├── css/
│   │   └── app.css             # Stylesheet utama dengan palet dark mode kustom
│   ├── js/
│   │   └── app.js              # JavaScript utama
│   └── views/
│       ├── admin/              # Views panel admin
│       ├── auth/               # Views halaman autentikasi
│       ├── blog/               # Views halaman blog publik
│       ├── emails/             # Template email (OTP, Kontak)
│       ├── layouts/            # Layout utama (app.blade.php)
│       ├── partials/           # Komponen reusable (navbar, footer)
│       ├── trips/              # Views halaman destinasi wisata publik
│       ├── user/               # Views panel pengguna
│       ├── welcome_page.blade.php
│       ├── about_page.blade.php
│       └── contact_page.blade.php
│
└── routes/
    └── web.php                 # Definisi seluruh route aplikasi
```

### Skema Database

```
users ──────────┬──< posts >── trips ──< reviews
                │                │
                └──< reviews     └──< categories
```

| Tabel | Kolom Kunci |
|---|---|
| `users` | `name`, `email`, `password`, `role (admin/user)`, `google_id`, `avatar`, `otp_code`, `otp_expires_at` |
| `trips` | `title`, `slug`, `category_id`, `location`, `price`, `duration`, `thumbnail`, `whatsapp_number`, `map_iframe`, `latitude`, `longitude` |
| `categories` | `name`, `slug` |
| `posts` | `title`, `slug`, `content`, `image`, `status (pending/approved/rejected)`, `user_id`, `trip_id` |
| `reviews` | `rating`, `comment`, `user_id`, `trip_id` |
| `notifications` | Notifikasi bawaan Laravel (polymorphic) |

---

## 🚀 Instalasi & Setup

### Prasyarat

Pastikan lingkungan pengembangan Anda memiliki:

- **PHP** `>= 8.2` dengan ekstensi: `pdo`, `pdo_sqlite`, `mbstring`, `openssl`, `fileinfo`, `gd`
- **Composer** `>= 2.x`
- **Node.js** `>= 18.x` & **npm**
- **Git**

### Langkah 1: Clone Repositori

```bash
git clone https://github.com/NaovalOcta/VisitBatu.git
cd VisitBatu
```

### Langkah 2: Setup Otomatis (Direkomendasikan)

Proyek ini dilengkapi dengan script `setup` yang menjalankan semua langkah instalasi sekaligus:

```bash
composer run setup
```

> Script ini secara otomatis menjalankan: `composer install`, menyalin `.env`, generate `APP_KEY`, menjalankan migrasi, `npm install`, dan `npm run build`.

### Langkah 3: Setup Manual (Alternatif)

Jika Anda ingin melakukan setup secara manual, ikuti langkah-langkah berikut:

```bash
# 1. Install dependensi PHP
composer install

# 2. Salin file environment
cp .env.example .env

# 3. Generate application key
php artisan key:generate

# 4. Buat file database SQLite
touch database/database.sqlite

# 5. Jalankan migrasi database
php artisan migrate

# 6. Install dependensi Node.js
npm install

# 7. Build aset frontend
npm run build
```

### Langkah 4: Buat Symlink Storage

```bash
php artisan storage:link
```

---

## ⚙️ Konfigurasi Environment

Buka file `.env` dan sesuaikan konfigurasi berikut:

### Konfigurasi Aplikasi

```env
APP_NAME="VisitBatu"
APP_ENV=local
APP_URL=http://localhost:8000
APP_LOCALE=id
```

### Konfigurasi Database

Defaultnya menggunakan SQLite (cocok untuk development):
```env
DB_CONNECTION=sqlite
```

Untuk MySQL/PostgreSQL di production, ubah menjadi:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=visitbatu
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Konfigurasi Email (Brevo)

Proyek ini menggunakan **[Brevo](https://www.brevo.com/)** (sebelumnya Sendinblue) sebagai layanan pengiriman email.

1. Daftar akun di [brevo.com](https://www.brevo.com/) (gratis hingga 300 email/hari)
2. Pergi ke **SMTP & API** → **API Keys** → buat API key baru
3. Isi konfigurasi di `.env`:

```env
MAIL_MAILER=brevo
BREVO_API_KEY=your-brevo-api-key-here
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="VisitBatu"
```

### Konfigurasi Google OAuth

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru → aktifkan **Google+ API** / **Google Identity**
3. Buat **OAuth 2.0 Client ID** (tipe: Web Application)
4. Tambahkan URI redirect: `http://localhost:8000/auth/google/callback`
5. Isi di `.env`:

```env
GOOGLE_CLIENT_ID=your-google-client-id.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

---

## 🗃️ Database & Seeding

### Menjalankan Migrasi

```bash
php artisan migrate
```

### Mengisi Data Awal (Seed)

Proyek ini dilengkapi dengan data seed yang kaya, mencakup:
- **5 Kategori** wisata (Taman Hiburan, Museum, Alam & Kebun, Kebun Binatang, Ruang Publik)
- **12 Destinasi Wisata** Kota Batu dengan data lengkap dan nyata, termasuk:
  - Museum Angkut, Jatim Park 1/2/3, Batu Secret Zoo
  - Eco Green Park, Predator Fun Park, BNS (Batu Night Spectacular)
  - Taman Rekreasi Selecta, Alun-Alun Kota Batu, Air Terjun Tumpak Sewu, dll.
- **1 Akun Admin** default

```bash
php artisan db:seed
```

Atau reset penuh dan seed ulang:

```bash
php artisan migrate:fresh --seed
```

### Kredensial Admin Default

Setelah menjalankan seeder, gunakan akun berikut untuk masuk sebagai admin:

> ⚠️ **Penting:** Segera ganti password admin di panel setelah pertama kali login.

| Field | Value |
|---|---|
| Email | `admin@visitbatu.com` |
| Password | `password` |
| Role | `admin` |

---

## ▶️ Menjalankan Aplikasi

### Mode Development (Semua Layanan Sekaligus)

```bash
composer run dev
```

Perintah ini menjalankan 4 layanan secara paralel:
- 🟢 `php artisan serve` — Web server PHP di `http://localhost:8000`
- 🟣 `php artisan queue:listen` — Queue worker untuk proses email asinkron
- 🔴 `php artisan pail` — Log viewer real-time
- 🟠 `npm run dev` — Vite HMR (Hot Module Replacement)

### Menjalankan Secara Terpisah

```bash
# Terminal 1: Server PHP
php artisan serve

# Terminal 2: Queue Worker (wajib untuk pengiriman email OTP)
php artisan queue:listen --tries=1

# Terminal 3: Vite Dev Server
npm run dev
```

### Build untuk Production

```bash
npm run build
php artisan optimize
```

---

## 📖 Panduan Pengguna

### Mendaftar Akun
1. Klik tombol **"Daftar"** di navbar.
2. Isi formulir dengan nama lengkap, email, dan password (min. 8 karakter).
3. Sebuah **kode OTP 6 digit** akan dikirimkan ke email Anda.
4. Masukkan kode OTP untuk menyelesaikan pendaftaran dan langsung masuk.

### Login
1. Klik **"Masuk"** di navbar.
2. Masukkan email dan password.
3. Masukkan **kode OTP** yang dikirim ke email Anda. OTP berlaku selama **5 menit**.
4. Alternatif: gunakan tombol **"Login dengan Google"** untuk login instan tanpa OTP.

### Lupa Password
1. Di halaman login, klik **"Lupa password?"**
2. Masukkan email terdaftar Anda.
3. Ikuti link reset password yang dikirim ke email.

### Menulis Artikel Blog
1. Login ke akun Anda.
2. Buka **Dashboard** → **Postingan Saya** → **Buat Postingan Baru**.
3. Isi judul, konten, dan upload gambar.
4. Postingan akan masuk status **"Pending"** dan menunggu persetujuan admin.
5. Anda akan mendapat notifikasi saat postingan disetujui atau ditolak.

### Memberikan Ulasan
1. Buka halaman detail destinasi wisata yang ingin Anda ulas.
2. Gulir ke bawah ke bagian **"Beri Ulasan"**.
3. Pilih rating bintang dan tulis komentar.
4. Klik **"Kirim Ulasan"** (perlu login terlebih dahulu).

---

## 🛡️ Panduan Admin

### Akses Panel Admin
URL: `http://localhost:8000/admin/dashboard`

Semua halaman di bawah prefix `/admin/` dilindungi oleh middleware `auth` dan `IsAdmin`. Pengguna biasa yang mencoba mengakses rute admin akan diarahkan ke halaman utama.

### Mengelola Destinasi Wisata
**Tambah Destinasi Baru:**
1. Buka **Admin** → **Destinasi Wisata** → **Tambah Baru**.
2. Isi semua kolom yang diperlukan: judul, kategori, lokasi, harga, jam operasional, deskripsi.
3. Upload thumbnail gambar (format: JPG, PNG, WebP; maks. 2MB).
4. (Opsional) Tambahkan kode embed Google Maps dan koordinat GPS.
5. (Opsional) Tambahkan nomor WhatsApp untuk kontak langsung.
6. Klik **"Simpan"** — slug URL akan dibuat otomatis dari judul.

### Moderasi Postingan Blog
1. Buka **Admin** → **Manajemen Postingan**.
2. Lihat daftar postingan dengan status `pending`.
3. Klik **"Setujui"** untuk mempublikasikan, atau **"Tolak"** untuk menolak.
4. Pengguna akan menerima notifikasi secara otomatis.

---

## 🔐 Sistem Autentikasi

Sistem autentikasi VisitBatu dirancang dengan keamanan berlapis:

```
Login Form
    │
    ▼
Validasi Kredensial (Email + Password)
    │
    ├── ✗ Gagal → Tampilkan Error
    │
    ├── ✓ Berhasil → Generate OTP (6 digit, exp. 5 menit)
    │                     │
    │                     ▼
    │               Kirim OTP via Email (Brevo)
    │                     │
    │                     ▼
    │               Pengguna Input OTP
    │                     │
    │               ├── ✗ Salah/Expired → Error
    │               │
    │               └── ✓ Valid → Login + Clear OTP
    │
    └── (Alternatif) Google OAuth → Login Langsung
```

**Fitur Keamanan:**
- **Rate Limiting** pada rute login, register, dan resend OTP (6 percobaan per menit).
- **OTP expire** otomatis setelah 5 menit.
- **CSRF Protection** pada semua form.
- **Password Hashing** menggunakan Bcrypt (rounds: 12).
- **Role-based Access Control (RBAC)** dengan peran `user` dan `admin`.

---

## 📧 Pengiriman Email

Aplikasi mengirimkan email untuk:

| Event | Penerima | Konten |
|---|---|---|
| **Registrasi Baru** | User baru | Kode OTP untuk verifikasi |
| **Login** | User yang login | Kode OTP untuk autentikasi dua faktor |
| **Lupa Password** | User | Link reset password |
| **Form Kontak** | Admin | Pesan dari pengunjung website |

Semua email dikirim secara **asinkron melalui queue** (`QUEUE_CONNECTION=database`) untuk menjaga responsivitas aplikasi. Pastikan `php artisan queue:listen` berjalan saat development.

---

## 🧪 Testing

```bash
# Jalankan semua test
composer run test

# Atau langsung dengan PHPUnit
php artisan test

# Dengan detail verbose
php artisan test --verbose
```

---

## 🤝 Kontribusi

Kontribusi sangat disambut! Ikuti langkah berikut:

1. **Fork** repositori ini
2. Buat branch fitur baru: `git checkout -b feat/nama-fitur-baru`
3. Commit perubahan Anda: `git commit -m 'feat: tambah fitur baru'`
4. Push ke branch: `git push origin feat/nama-fitur-baru`
5. Buat **Pull Request**

### Konvensi Commit Message

Proyek ini mengikuti format [Conventional Commits](https://www.conventionalcommits.org/):

```
feat:     Fitur baru
fix:      Perbaikan bug
docs:     Perubahan dokumentasi
style:    Perubahan formatting (tanpa mengubah logika)
refactor: Refactor kode
test:     Menambah atau memperbaiki test
chore:    Maintenance (update deps, config, dll.)
```

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **MIT License**. Lihat file [LICENSE](LICENSE) untuk detail lengkap.

---

<div align="center">

Dibuat dengan ❤️ untuk mempromosikan pariwisata **Kota Batu, Jawa Timur** 🏔️

**VisitBatu** — *Experience the Magic of Batu*

</div>
