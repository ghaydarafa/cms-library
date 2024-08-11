# Digital Perpustakaan Berbasis Website

Proyek ini adalah sebuah Sistem Manajemen Konten (CMS) untuk pengelolaan perpustakaan digital. Proyek ini dibangun menggunakan Laravel 11 dan Laravel Breeze sebagai sistem autentikasi.

## Fitur Utama
- **Login dan Register** untuk Admin dan User.
- **Daftar Buku** dengan filter berdasarkan kategori buku.
- **CRUD Buku**: Tambah, baca, perbarui, dan hapus data buku, termasuk mengunggah file buku (PDF) dan cover (jpeg/jpg/png).
- **Daftar Kategori Buku**: Tampilkan dan kelola kategori buku.
- **CRUD Kategori Buku**: Tambah, baca, perbarui, dan hapus kategori buku.
- **Hak Akses**: Pembatasan akses hanya untuk data yang dibuat oleh user tersebut, kecuali admin.
- **Ekspor Data** ke Excel/PDF dari daftar buku.

## Requirements
Pastikan Anda telah menginstall:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

## Instalasi

1. **Clone repositori:**
   ```bash
   git clone https://github.com/ghaydarafa/cms-library.git
   cd cms-library
2. **Install dependensi menggunakan Composer:**
   ```bash
   composer install
3. **Copy file .env**
   ```bash
   cp .env.example .env
   ```
   Ubah DB_DATABASE, DB_USERNAME, dan DB_PASSWORD sesuai dengan konfigurasi MySQL lokal Anda.
4. **Migrasi database:**
   ```bash
   php artisan migrate
5. **Install dependensi frontend dan build assets:**
   ```bash
   npm install
6. **Jalankan server:**
   ```bash
   php artisan serve
7. **Dalam terminal terpisah, jalankan:**
   ```bash
   npm run dev
8. **Akses aplikasi:**
   Buka browser dan akses http://127.0.0.1:8000.

# Notes
Pastikan Anda menjalankan dua terminal secara bersamaan untuk ```php artisan serve``` dan ```npm run dev```.
