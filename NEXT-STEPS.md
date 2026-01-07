# 🎉 Setup Berhasil!

## ✅ Yang Sudah Selesai:

1. ✅ Composer dependencies terinstall
2. ✅ Midtrans package terinstall
3. ✅ Application key sudah di-generate
4. ✅ Storage link sudah dibuat (.env file sudah ready)

---

## 📋 Langkah Selanjutnya:

### 1️⃣ Buat Database MySQL

Buka **phpMyAdmin** atau **MySQL Workbench**, lalu jalankan:

```sql
CREATE DATABASE pixelnest;
```

Atau via Laragon:
- Klik kanan Laragon tray icon
- MySQL > Quick Add > Database
- Nama: `pixelnest`

### 2️⃣ Update File .env

Buka file `.env` di root project dan pastikan:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pixelnest
DB_USERNAME=root
DB_PASSWORD=               # kosongkan jika tidak ada password
```

**Untuk Midtrans (opsional untuk testing):**
```env
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxx
MIDTRANS_IS_PRODUCTION=false
```

> **Catatan:** Bisa skip Midtrans dulu, nanti tambahkan kalau mau test payment

### 3️⃣ Jalankan Database Migration

**Double-click file:** `setup-database.bat`

Atau via terminal:
```bash
php artisan migrate:fresh --seed
```

File ini akan:
- Membuat semua tabel database
- Memasukkan data awal (admin & categories)

### 4️⃣ Start Development Server

**Option A - Via Terminal:**
```bash
php artisan serve
```

**Option B - Via Laragon:**
- Klik "Start All" di Laragon
- Akses via: `http://pixelnest.test`

### 5️⃣ Buka Website

**URL:** http://localhost:8000

**Login Admin:**
- Email: `admin@pixelnest.com`
- Password: `password`

---

## 🚀 Testing Fitur:

### A. Test sebagai User:
1. Klik "Sign Up" → Daftar akun baru
2. Upload artwork via "Dashboard" → "Upload New"
3. Tunggu admin approve
4. Browse artworks di homepage
5. Add to cart & checkout

### B. Test sebagai Admin:
1. Login dengan admin@pixelnest.com
2. Akses Admin Panel
3. Approve/reject artwork user
4. Lihat orders & statistics
5. Manage categories

---

## 🔧 Troubleshooting

### ❌ Error: "Access denied for user..."
- Cek username/password database di .env
- Pastikan MySQL running (cek Laragon)

### ❌ Error: "Unknown database 'pixelnest'"
- Buat database dulu: `CREATE DATABASE pixelnest;`

### ❌ Port 8000 sudah digunakan
```bash
php artisan serve --port=8080
```

### ❌ Payment tidak berfungsi
- Midtrans keys belum di-set (normal, bisa skip dulu)
- Website tetap bisa jalan tanpa payment gateway

---

## 📁 File Penting:

- `setup-database.bat` - Setup database
- `QUICKSTART.md` - Panduan lengkap (Bahasa Indonesia)
- `README.md` - Dokumentasi teknis lengkap
- `.env` - Konfigurasi aplikasi

---

## ✨ Selamat! Website Anda Siap Digunakan!

Jika ada masalah, baca file:
- `QUICKSTART.md` untuk panduan detail
- `README.md` untuk troubleshooting

**Happy Coding! 🎨**
