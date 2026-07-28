# User Management System (Core Framework)

Aplikasi **User Management System** adalah sebuah sistem fondasi (*core framework*) yang dibangun menggunakan Laravel. Sistem ini dirancang untuk mengelola autentikasi, manajemen pengguna, hak akses menu yang sepenuhnya dinamis, serta sistem *logging* otomatis untuk aktivitas pengguna dan *error* aplikasi.

Sistem ini sangat ideal digunakan sebagai basis (*starter kit*) untuk pengembangan aplikasi tingkat perusahaan (ERP, HRIS, Inventory, dll) karena arsitekturnya yang kokoh dan modular.

---

## 🚀 Fitur Utama

1. **Autentikasi & Profil (Breeze)**
   - Login, Logout (dengan modal dinamis), dan Session Teramankan.
   - Halaman Profil untuk mengubah data, mengganti *password*, dan mengunggah foto profil.
   - *Password Hashing* dan proteksi rute secara ketat.

2. **Manajemen Pengguna (*User Management*)**
   - *CRUD* data pengguna secara komprehensif.
   - Mekanisme *Soft Delete* kustom menggunakan kolom `delete_mark`.
   - Mengubah status pengguna (*Aktif / Nonaktif*).
   - Pengelolaan foto profil multi-tabel.

3. **Menu Dinamis & Hak Akses (*Role-Based Access Control / RBAC*)**
   - Manajemen hierarki menu (mendukung *Parent-Child*, ikon, dan level menu).
   - Penentuan hak akses spesifik per pengguna melalui tabel `MENU_USER` (bukan sekadar berbasis peran/Role).
   - *Middleware* `CheckMenuAccess` yang secara otomatis memvalidasi setiap URL berdasarkan hak akses yang dimiliki pengguna. Menu di *sidebar* juga dirender secara dinamis.

4. **User Activity Log**
   - Pencatatan aktivitas esensial secara otomatis (Login, Logout, Tambah Data, Edit Data, Hapus Data, Buka Menu).
   - Membantu audit keamanan (mengetahui siapa melakukan apa dan kapan).

5. **Error Monitoring Log**
   - Menangkap segala bentuk *Exception/Error* aplikasi secara otomatis.
   - Mencatat detail krusial: *User, Modul, Controller, Function, Error Line, Pesan Error, Parameter,* dan waktu kejadian ke dalam *database*.

6. **Premium UI/UX**
   - Desain antarmuka modern, korporat, minimalis menggunakan **Tailwind CSS**.
   - Efek interaktif dan transisi halus dibantu oleh **Alpine.js**.

---

## 🛠️ Teknologi yang Digunakan

- **Framework:** Laravel (v11/12)
- **Authentication:** Laravel Breeze
- **Frontend / Styling:** Blade Templating, Tailwind CSS, Alpine.js
- **Database:** MySQL
- **Icons:** Bootstrap Icons, Lucide Icons

---

## 📋 Prasyarat Sistem

Pastikan sistem Anda telah terpasang:
- **PHP** >= 8.2
- **Composer**
- **Node.js** & **NPM**
- **MySQL** / MariaDB (via Laragon, XAMPP, dll)

---

## ⚙️ Panduan Instalasi

1. **Clone repositori**
   ```bash
   git clone <url-repositori-anda> user-management-system
   cd user-management-system
   ```

2. **Install dependensi PHP dan Node.js**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin file konfigurasi bawaan dan hasilkan *Application Key*:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Buka file `.env`, lalu atur konfigurasi *database* Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Jalankan Migrasi Database dan Seeder**
   Sistem ini telah dilengkapi dengan data awal (*dummy data*) dan struktur menu.
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Kompilasi Aset Frontend dan Jalankan Server**
   Gunakan dua terminal berbeda untuk menjalankan perintah ini secara bersamaan:
   ```bash
   # Terminal 1 (Untuk kompilasi Tailwind/CSS)
   npm run dev

   # Terminal 2 (Untuk menjalankan server PHP)
   php artisan serve
   ```

6. **Akses Aplikasi**
   Buka *browser* Anda dan akses: `http://localhost:8000`

---

## 🔑 Akun Default (Seeder)

Setelah menjalankan *seeder*, Anda dapat mencoba *login* menggunakan kredensial berikut:

| Peran | Username | Password |
|-------|----------|----------|
| **Super Admin** | `superadmin` | `Admin@1234` |
| **Manager** | `budi.mgr` | `Manager@1234` |

*(Super Admin secara otomatis kebal dari pembatasan hak akses berkat ID `USR001`).*

---

## 🗄️ Struktur Database Core

1. `users`: Tabel utama pengguna.
2. `user_foto`: Tabel pengelolaan riwayat/koleksi foto pengguna.
3. `jenis_user`: Level hierarki (*Admin, Manager, User*).
4. `menu` & `menu_level`: Mengelola daftar menu aplikasi.
5. `menu_user`: Tabel *Pivot* akses menu bagi tiap pengguna (RBAC Inti).
6. `user_activity`: Tabel catatan jejak (*Activity Log*).
7. `l_error_application`: Tabel penangkapan *Exception (Error Log)*.

**Catatan Khusus:** Sistem ini menggunakan konsep *Soft Delete* independen (tidak menggunakan bawaan Laravel `deleted_at`). Sistem mengandalkan kolom kustom bertipe *String* yaitu `delete_mark` ('0' = Aktif, '1' = Terhapus).

---
