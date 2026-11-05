# Mini Digital Library - Tugas Terstruktur Pemrograman Web

Aplikasi web backend dan frontend sederhana untuk pengelolaan perpustakaan digital berbasis PHP Native dan MySQL.

## Fitur Utama
1. **Autentikasi & Authorization**: Login, Session Guarding, Cookie ("Remember Me"), dan Logout.
2. **CRUD Buku**: Create, Read, Update, Delete data buku lengkap dengan status ketersediaan otomatis berdasarkan jumlah stok.
3. **File Management**: Upload sampul buku (.jpg/.png, max 2MB) serta auto-unlink file fisik saat data diedit/dihapus.

## Cara Menggunakan
1. Ekstrak file zip ke folder `htdocs` XAMPP Anda.
2. Buat database di MySQL bernama `db_perpustakaan` dan import file `db_perpustakaan.sql`.
3. Buka browser dan akses `http://localhost/project_perpustakaan`.
4. Login menggunakan akun default:
   - **Username**: `admin`
   - **Password**: `admin123`
