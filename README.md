# Three Queens Interior - Backend Admin Dashboard

Aplikasi Backend dan Dashboard Admin untuk **Three Queens Interior**, dibangun menggunakan **Laravel 12**, **MySQL**, **Tailwind CSS**, dan **Alpine.js**. Sistem ini menyediakan REST API untuk aplikasi frontend React serta panel admin terproteksi untuk mengelola seluruh data landing page secara dinamis.

---

## 🛠️ Fitur Utama
1. **Dashboard Statistik:** Ringkasan jumlah produk, portofolio proyek, pesan masuk yang belum dibaca, dan grafik tren kategori interior.
2. **Kategori Interior:** Fitur CRUD untuk klasifikasi jenis produk (misalnya: Kitchen Set, Living Room, Bedroom, dll).
3. **Produk Interior (CRUD + Media Upload):** Mengelola produk dengan unggahan gambar produk utama, file desain blueprint 2D, serta file visualisasi 3D (`.glb` / `.gltf` / url embed).
4. **Portofolio Proyek:** Galeri proyek pekerjaan dekorasi interior custom yang sudah diselesaikan beserta info lokasi dan unggahan dokumentasi.
5. **Kontrol Konten Landing Page:** Editor teks langsung untuk mengedit Banner Beranda, Teks Profil Tentang Kami, Visi Misi, dan Galeri Foto Profil.
6. **Manajemen Kontak & Sosmed:** Mengatur nomor WhatsApp, alamat lengkap workshop, jam kerja, email, serta media sosial seperti Instagram, TikTok, dan Facebook.
7. **Pesan Masuk (Inbox):** Manajemen pesan masuk dari form kontak frontend, dilengkapi dengan notifikasi pesan baru, penandaan status baca, dan hapus pesan.
8. **Pengaturan Akun:** Ganti password administrator, ganti profil email, dan unggah foto profil (avatar).

---

## 📋 Persyaratan Sistem
- **PHP** >= 8.2
- **MySQL** >= 8.0 atau **MariaDB** >= 10.4
- **Composer** 2.x
- Extension PHP: `BCMath`, `Ctype`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PDO`, `Tokenizer`, `XML`, `GD`

---

## 🚀 Langkah Memulai / Setup

### 1. Masuk ke Folder Backend
Buka terminal/command prompt dan masuk ke folder `BE`:
```bash
cd BE
```

### 2. Instal Dependensi Composer
Instal library PHP yang dibutuhkan melalui Composer:
```bash
composer install --optimize-autoloader
```

### 3. Konfigurasi Environment (`.env`)
Salin file konfigurasi lingkungan bawaan:
```bash
cp .env.example .env
```

Generate application key unik untuk enkripsi:
```bash
php artisan key:generate
```

### 4. Konfigurasi Database & Domain di `.env`
Buka file `.env` yang baru dibuat dan sesuaikan konfigurasi koneksi database MySQL Anda:
```env
APP_NAME="Three Queen Interior Admin"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_threequeen
DB_USERNAME=root
DB_PASSWORD=
```
> ⚠️ **Catatan:** Buat database bernama `db_threequeen` di MySQL (phpMyAdmin atau DB Client) sebelum melanjutkan ke langkah berikutnya.

### 5. Jalankan Migrasi & Database Seeder
Buat struktur tabel dan isi database dengan data dummy awal (termasuk 15 produk interior berkualitas tinggi, portofolio, dan akun admin):
```bash
php artisan migrate --seed
```

### 6. Setup Symbolic Link (Penting!)
Hubungkan folder penyimpanan publik agar aset media (gambar, desain 2D/3D) yang diupload melalui panel admin bisa diakses secara publik oleh aplikasi Frontend:
```bash
php artisan storage:link
```

### 7. Jalankan Server Lokal
Nyalakan server lokal Laravel:
```bash
php artisan serve
```
Secara default, server lokal akan berjalan pada alamat **http://127.0.0.1:8000**.

---

## 🔑 Akun Login Administrator Default

| Parameter | Value |
| --- | --- |
| **URL Login** | `http://127.0.0.1:8000/login` |
| **Email** | `admin@threequeen.com` |
| **Password** | `admin123` |

> 🔒 **Penting:** Harap ganti password default Anda melalui menu **Pengaturan Akun** di dashboard admin setelah login pertama kali untuk menjaga keamanan sistem.

---

## 📂 Struktur File Upload
Aset file yang diupload melalui panel admin akan disimpan di direktori berikut:
```
BE/storage/app/public/
├── produk/
│   ├── gambar/      ← File gambar utama produk
│   ├── 2d/          ← File blueprint desain 2D (gambar/PDF)
│   └── 3d/          ← File model visualisasi 3D (.glb/.gltf)
├── portofolio/
│   └── dokumentasi/ ← Foto-foto dokumentasi proyek selesai
├── beranda/         ← Background banner landing page
├── tentang/         ← Foto profil bagian profil perusahaan
└── avatars/         ← Foto profil admin
```

---

## 🚀 Perintah Berguna Lainnya
* **Reset Database (Hapus semua data & jalankan seeder ulang):**
  ```bash
  php artisan migrate:fresh --seed
  ```
* **Membersihkan Cache Konfigurasi & Rute (Bila ada perubahan config):**
  ```bash
  php artisan optimize:clear
  ```
