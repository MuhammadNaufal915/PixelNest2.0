# Quick Start - Midtrans Payment Gateway

## Setup Cepat (5 Menit)

### 1. Install Dependencies (Sudah Selesai ✅)
```bash
composer require midtrans/midtrans-php
```

### 2. Jalankan Migrasi (Sudah Selesai ✅)
```bash
php artisan migrate
```

### 3. Konfigurasi Midtrans

#### Sandbox/Testing (Recommended untuk mulai):
```env
MIDTRANS_SERVER_KEY=SB-Mid-server-XXXXXXXXXXXXXXXX
MIDTRANS_CLIENT_KEY=SB-Mid-client-XXXXXXXXXXXXXXXX
MIDTRANS_IS_PRODUCTION=false
```

**Cara Mendapatkan Keys:**
1. Daftar di: https://dashboard.sandbox.midtrans.com
2. Verifikasi email
3. Login → Settings → Access Keys
4. Copy Server Key dan Client Key

### 4. Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
```

### 5. Test Payment Flow

1. **Tambah item ke cart**
   - Browse artworks di homepage
   - Klik "Add to Cart"

2. **Checkout**
   - Buka cart: `/cart`
   - Klik "Proceed to Checkout"

3. **Payment**
   - Klik "Proceed to Payment"
   - Klik "Pay Now"
   - Pilih metode pembayaran

4. **Test dengan Kartu Kredit:**
   - Card: `4811 1111 1111 1114`
   - CVV: `123`
   - Exp: `01/25`
   - OTP: `112233`

### 6. Testing Notification (Optional)

Untuk testing notification callback dari Midtrans ke local:

1. **Install ngrok**
   ```bash
   # Download dari https://ngrok.com/download
   # Atau via chocolatey:
   choco install ngrok
   ```

2. **Jalankan ngrok**
   ```bash
   # Terminal 1: Laravel Server
   php artisan serve
   
   # Terminal 2: ngrok
   ngrok http 8000
   ```

3. **Set Notification URL**
   - Copy URL ngrok (contoh: `https://abc123.ngrok.io`)
   - Login ke Midtrans Dashboard
   - Settings → Configuration
   - Set: `https://abc123.ngrok.io/payment/notification`

## Routes yang Tersedia

| Method | URL | Deskripsi |
|--------|-----|-----------|
| GET | `/payment` | Halaman payment |
| POST | `/payment/process` | Proses pembayaran |
| POST | `/payment/notification` | Webhook Midtrans |
| GET | `/payment/success` | Halaman sukses |
| GET | `/payment/pending` | Halaman pending |
| GET | `/payment/failed` | Halaman gagal |

## File-file yang Dibuat/Dimodifikasi

### ✅ Dibuat Baru
- `app/Services/MidtransService.php`
- `app/Models/Payment.php`
- `resources/views/payment/snap.blade.php`
- `resources/views/payment/success.blade.php`
- `resources/views/payment/pending.blade.php`
- `resources/views/payment/failed.blade.php`
- `database/migrations/2026_01_15_103251_update_payments_table_for_midtrans.php`

### ✅ Dimodifikasi
- `app/Http/Controllers/PaymentController.php`
- `app/Models/Order.php`
- `config/services.php`
- `routes/web.php`

## Troubleshooting

### Error: "Class 'Midtrans\Config' not found"
```bash
composer dump-autoload
php artisan config:clear
```

### Payment berhasil tapi order masih pending
- Check apakah notification URL sudah diset
- Check log: storage/logs/laravel.log
- Untuk testing tanpa ngrok, order akan pending sampai notification diterima

### Snap popup tidak muncul
- Check browser console untuk error
- Pastikan Client Key sudah benar
- Clear browser cache

## Production Deployment

1. Ganti ke Production Mode:
```env
MIDTRANS_IS_PRODUCTION=true
MIDTRANS_SERVER_KEY=Mid-server-XXXXXXXXXXXXXXXX
MIDTRANS_CLIENT_KEY=Mid-client-XXXXXXXXXXXXXXXX
```

2. Update notification URL di Midtrans Dashboard:
```
https://pixelnest.com/payment/notification
```

3. Edit `resources/views/payment/snap.blade.php`:
```blade
{{-- Change from sandbox to production script --}}
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
```

## Next Steps

📖 Baca dokumentasi lengkap: `MIDTRANS_PAYMENT_GUIDE.md`
🧪 Test semua metode pembayaran
🔧 Customize halaman payment sesuai brand
📊 Monitor transaksi di Midtrans Dashboard

---

**Happy Coding! 🚀**
