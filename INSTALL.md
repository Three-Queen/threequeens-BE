# Three Queen Interior - Admin Dashboard
## Panduan Instalasi Lengkap

---

## PERSYARATAN SERVER
- PHP >= 8.2
- MySQL 8.0+ / MariaDB 10.4+
- Composer 2.x
- Node.js 18+ (opsional, untuk kompilasi asset)
- Extension PHP: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, GD

---

## LANGKAH INSTALASI

### 1. Clone / Download Project
```bash
# Ekstrak project ke folder server (htdocs/public_html/dll)
# Arahkan document root ke folder: public/
```

### 2. Install Dependencies
```bash
composer install --optimize-autoloader --no-dev
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env`:
```env
APP_NAME="Three Queen Interior Admin"
APP_URL=http://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_threequeen
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### 4. Buat Database
```sql
CREATE DATABASE db_threequeen CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Jalankan Migrasi & Seeder
```bash
php artisan migrate --seed
```

### 6. Setup Storage
```bash
php artisan storage:link
```

### 7. Set Permissions (Linux/Server)
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
chown -R www-data:www-data storage/
chown -R www-data:www-data bootstrap/cache/
```

### 8. Optimasi untuk Production
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## LOGIN DEFAULT

| Field    | Value                     |
|----------|---------------------------|
| Email    | admin@threequeen.com      |
| Password | admin123                  |

> ⚠️ **SEGERA GANTI PASSWORD** setelah login pertama kali!

---

## STRUKTUR FILE UPLOAD

File yang diupload tersimpan di:
```
storage/app/public/
├── produk/
│   ├── gambar/      ← Gambar produk
│   ├── 2d/          ← File desain 2D
│   └── 3d/          ← File desain 3D
├── portofolio/
│   └── dokumentasi/ ← Foto portofolio
├── beranda/         ← Background beranda
├── tentang/         ← Gambar tentang
└── avatars/         ← Avatar user
```

---

## FITUR DASHBOARD

| Menu               | Fitur                                          |
|--------------------|------------------------------------------------|
| Dashboard          | Statistik, Chart, Pesan terbaru, Produk baru  |
| Kategori Interior  | CRUD kategori                                  |
| Produk Interior    | CRUD + Upload gambar, 2D, 3D                   |
| Portofolio Proyek  | CRUD + Upload dokumentasi                      |
| Manajemen Beranda  | Edit judul, deskripsi, background              |
| Manajemen Tentang  | Edit konten + upload 2 gambar                  |
| Manajemen Kontak   | Edit semua info kontak & sosmed                |
| Pesan Masuk        | Lihat, tandai baca, hapus + notifikasi         |
| Pengaturan Akun    | Update profil, ganti password, ganti avatar    |

---

## TEKNOLOGI YANG DIGUNAKAN

- **Backend**: Laravel 12, PHP 8.2+
- **Frontend**: Tailwind CSS (CDN), Alpine.js (CDN)
- **Charts**: Chart.js (CDN)
- **Icons**: Font Awesome 6 (CDN)
- **Alerts**: SweetAlert2 (CDN)
- **Auth**: Laravel built-in Auth
- **Storage**: Laravel Storage (public disk)
- **Database**: MySQL via Eloquent ORM

---

## TROUBLESHOOTING

### Error: Storage not found
```bash
php artisan storage:link
```

### Error: Key not set
```bash
php artisan key:generate
```

### Error: Permission denied
```bash
chmod -R 775 storage/ bootstrap/cache/
```

### Reset Database
```bash
php artisan migrate:fresh --seed
```

---

## KONTAK SUPPORT
Three Queen Interior - Admin Dashboard
Dibuat dengan Laravel 12 + Tailwind CSS + Alpine.js
