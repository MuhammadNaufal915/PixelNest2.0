# 🚀 Quick Start Guide - PixelNest

## Cara Cepat Memulai

### Option 1: Menggunakan Script Otomatis (Recommended)

1. **Siapkan Database**
   - Buka phpMyAdmin atau MySQL
   - Buat database baru bernama `pixelnest`

2. **Jalankan Setup Script**
   ```bash
   cd c:\laragon\www\PixelNest
   setup.bat
   ```

3. **Update Konfigurasi**
   Edit file `.env`:
   ```env
   DB_DATABASE=pixelnest
   DB_USERNAME=root
   DB_PASSWORD=

   # Untuk testing, gunakan Midtrans Sandbox
   MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxx
   MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxx
   ```

4. **Jalankan Server**
   ```bash
   php artisan serve
   ```

5. **Buka Browser**
   - URL: `http://localhost:8000`
   - Login Admin: admin@pixelnest.com / password

---

### Option 2: Manual Setup

```bash
# 1. Install dependencies
composer install
composer require midtrans/midtrans-php

# 2. Setup environment
copy .env.example .env
php artisan key:generate

# 3. Update .env file (database & Midtrans keys)

# 4. Run migrations
php artisan migrate:fresh --seed

# 5. Create storage link
php artisan storage:link

# 6. Start server
php artisan serve
```

---

## Mendapatkan Midtrans API Keys

### Untuk Testing (Sandbox):

1. Kunjungi: https://dashboard.sandbox.midtrans.com/register
2. Buat akun baru
3. Login ke dashboard
4. Pergi ke **Settings** → **Access Keys**
5. Copy:
   - **Server Key** → Masukkan ke `MIDTRANS_SERVER_KEY`
   - **Client Key** → Masukkan ke `MIDTRANS_CLIENT_KEY`

### Untuk Production:

1. Kunjungi: https://dashboard.midtrans.com
2. Lengkapi verifikasi bisnis
3. Dapatkan production keys dari dashboard
4. Update `.env`:
   ```env
   MIDTRANS_IS_PRODUCTION=true
   MIDTRANS_SERVER_KEY=Mid-server-xxxxx
   MIDTRANS_CLIENT_KEY=Mid-client-xxxxx
   ```

---

## Testing Payment (Sandbox)

Gunakan credit card testing berikut:

**Success Transaction:**
- Card Number: `4811 1111 1111 1114`
- CVV: `123`
- Exp Date: `01/25`

**Failed Transaction:**
- Card Number: `4911 1111 1111 1113`

More test cards: https://docs.midtrans.com/en/technical-reference/sandbox-test

---

## Akun Default

### Admin:
- **Email:** admin@pixelnest.com
- **Password:** password
- **Akses:** Full admin panel

### User Baru:
- Daftar di halaman register
- Otomatis mendapat role "user"

---

## Struktur Website

### Untuk User Biasa:
1. **Browse** → Lihat semua karya di homepage
2. **Detail** → Klik karya untuk melihat detail
3. **Cart** → Tambahkan ke keranjang
4. **Checkout** → Bayar dengan Midtrans
5. **Download** → Download file setelah pembayaran sukses

### Upload Karya:
1. **Login** → Masuk sebagai user
2. **Dashboard** → Klik "Upload New"
3. **Fill Form** → Isi detail karya
4. **Submit** → Tunggu approval admin

### Untuk Admin:
1. **Login** → admin@pixelnest.com
2. **Dashboard** → Lihat statistik
3. **Manage Artworks** → Approve/reject karya
4. **Manage Orders** → Lihat semua transaksi
5. **Manage Categories** → Kelola kategori

---

## Troubleshooting

### ❌ Error: "No application encryption key has been specified"
```bash
php artisan key:generate
```

### ❌ Error: "SQLSTATE[HY000] [1049] Unknown database"
- Buat database `pixelnest` di MySQL
- Cek kredensial di file `.env`

### ❌ Error: "The stream or file could not be opened"
```bash
# Berikan permission ke folder storage
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### ❌ Storage link tidak bekerja
```bash
php artisan storage:link
```

### ❌ Payment tidak muncul
- Pastikan Midtrans keys sudah benar
- Clear cache: `php artisan config:clear`
- Cek browser console untuk error JavaScript

---

## Port Sudah Digunakan?

Jika port 8000 sudah digunakan:
```bash
php artisan serve --port=8080
```

Atau gunakan Laragon virtual host:
- Buat domain: pixelnest.test
- Akses via: http://pixelnest.test

---

## Tips Penggunaan

### Upload File:
- **Image Preview:** PNG, JPG, max 5MB
- **Download File:** Bisa ZIP, PSD, AI, PDF, max 50MB
- Upload file yang berkualitas tinggi

### Pricing:
- Gunakan kelipatan 1000 (contoh: Rp 50.000, Rp 100.000)
- Pertimbangkan kompleksitas karya

### Categories:
- Pilih category yang sesuai
- Memudahkan buyer mencari karya

---

## Video Demo (Coming Soon)

Screenshots tersedia di folder `/docs/screenshots`

---

## Need Help?

- 📖 Baca [README.md](README.md) untuk dokumentasi lengkap
- 📝 Lihat [walkthrough.md](../walkthrough.md) untuk penjelasan teknis
- 🔧 Check Laravel logs: `storage/logs/laravel.log`

---

**Selamat Mencoba! 🎨**
