# Integrasi Payment Gateway Midtrans di PixelNest

## Fitur yang Sudah Diimplementasi

✅ Integrasi Midtrans Snap Payment Gateway
✅ Penyimpanan data transaksi ke database
✅ Halaman pembayaran yang modern dan elegan
✅ Notifikasi otomatis dari Midtrans
✅ Halaman sukses, pending, dan gagal pembayaran
✅ Update status order otomatis

## Struktur Database

### Tabel `payments`
- `id`: Primary key
- `order_id`: Foreign key ke tabel orders
- `payment_method`: Metode pembayaran
- `transaction_id`: ID transaksi dari Midtrans
- `snap_token`: Token Snap dari Midtrans
- `amount`: Jumlah pembayaran
- `status`: Status pembayaran (pending, completed, failed)
- `fraud_status`: Status fraud detection dari Midtrans
- `raw_response`: Response lengkap dari Midtrans (JSON)

### Tabel `orders`
- Sudah ada sebelumnya
- Status: pending, paid, failed, cancelled

## Konfigurasi Midtrans

### 1. Mendapatkan API Keys Midtrans

1. Daftar di https://dashboard.midtrans.com (Sandbox untuk testing)
2. Login ke dashboard
3. Masuk ke menu **Settings** > **Access Keys**
4. Copy **Server Key** dan **Client Key**

### 2. Setup Environment Variables

Buka file `.env` dan update nilai berikut:

```env
# Midtrans Payment Gateway
MIDTRANS_SERVER_KEY=SB-Mid-server-XXXXXXXXXXXXXXXX
MIDTRANS_CLIENT_KEY=SB-Mid-client-XXXXXXXXXXXXXXXX
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

**Note:**
- Untuk testing gunakan `MIDTRANS_IS_PRODUCTION=false` (Sandbox)
- Untuk production gunakan `MIDTRANS_IS_PRODUCTION=true` dan ganti dengan Production keys

### 3. Setup Notification URL di Midtrans Dashboard

1. Login ke Midtrans Dashboard
2. Masuk ke **Settings** > **Configuration**
3. Set **Payment Notification URL** ke:
   ```
   https://your-domain.com/payment/notification
   ```
   Untuk local development dengan ngrok:
   ```
   https://your-ngrok-url.ngrok.io/payment/notification
   ```

## Cara Kerja Payment Flow

1. **User checkout** → Pilih item di cart → Klik "Proceed to Payment"
2. **Create Order** → Sistem membuat order dengan status "pending"
3. **Get Snap Token** → Request ke Midtrans API untuk mendapatkan snap token
4. **Payment Page** → User diarahkan ke halaman payment dengan Snap popup
5. **User Pay** → User memilih metode pembayaran (Credit Card, GoPay, Bank Transfer, dll)
6. **Midtrans Callback** → Midtrans mengirim notifikasi ke `/payment/notification`
7. **Update Database** → Sistem update status order dan payment di database
8. **Redirect** → User diarahkan ke halaman sukses/pending/gagal

## File-file Penting

### Controllers
- `app/Http/Controllers/PaymentController.php` - Main payment controller
  - `index()` - Halaman pilihan payment
  - `process()` - Proses create order dan get snap token
  - `notification()` - Handle notification dari Midtrans
  - `success()`, `pending()`, `failed()` - Halaman callback

### Services
- `app/Services/MidtransService.php` - Service untuk integrasi Midtrans API
  - `createSnapToken()` - Request snap token
  - `handleNotification()` - Parse notification dari Midtrans
  - `getOrderStatus()` - Map transaction status ke order status
  - `getPaymentStatus()` - Map transaction status ke payment status

### Models
- `app/Models/Payment.php` - Model untuk tabel payments
- `app/Models/Order.php` - Model untuk tabel orders (updated)

### Views
- `resources/views/payment/snap.blade.php` - Halaman payment dengan Snap
- `resources/views/payment/success.blade.php` - Halaman sukses
- `resources/views/payment/pending.blade.php` - Halaman pending
- `resources/views/payment/failed.blade.php` - Halaman gagal

### Routes
```php
// Payment routes (authenticated)
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/pending', [PaymentController::class, 'pending'])->name('payment.pending');
Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');

// Notification endpoint (no auth required)
Route::post('/payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');
```

## Testing Payment

### Testing di Sandbox Mode

Untuk testing, gunakan kartu kredit test berikut:

**Successful Payment:**
- Card Number: `4811 1111 1111 1114`
- CVV: `123`
- Exp Date: `01/25`
- OTP/3DS: `112233`

**Failed Payment:**
- Card Number: `4911 1111 1111 1113`
- CVV: `123`
- Exp Date: `01/25`

**Pending Payment (Challenge by FDS):**
- Card Number: `4411 1111 1111 1118`
- CVV: `123`
- Exp Date: `01/25`

### Testing dengan Local Development

Karena Midtrans perlu mengirim notification ke server Anda, untuk local development gunakan **ngrok**:

1. Install ngrok: https://ngrok.com/download
2. Jalankan Laravel server: `php artisan serve`
3. Jalankan ngrok: `ngrok http 8000`
4. Copy URL ngrok (contoh: `https://abc123.ngrok.io`)
5. Set di Midtrans Dashboard > Settings > Configuration > Notification URL:
   ```
   https://abc123.ngrok.io/payment/notification
   ```

## Metode Pembayaran yang Tersedia

Midtrans Snap mendukung berbagai metode pembayaran:

- **Credit/Debit Card** (Visa, Mastercard, JCB, Amex)
- **E-Wallet** (GoPay, ShopeePay, DANA, LinkAja, OVO)
- **Bank Transfer** (BCA, BNI, BRI, Mandiri, Permata, CIMB Niaga)
- **Convenience Store** (Alfamart, Indomaret)
- **Cardless Credit** (Akulaku)

User dapat memilih metode pembayaran langsung di Snap popup.

## Status Pembayaran

### Order Status
- `pending` - Order dibuat, menunggu pembayaran
- `paid` - Pembayaran berhasil
- `failed` - Pembayaran gagal/dibatalkan
- `cancelled` - Order dibatalkan

### Payment Status
- `pending` - Menunggu pembayaran
- `completed` - Pembayaran selesai
- `failed` - Pembayaran gagal

## Troubleshooting

### Error: "Failed to create Snap token"
- Pastikan Server Key sudah benar di `.env`
- Pastikan sudah menjalankan `php artisan config:clear`
- Check log: `storage/logs/laravel.log`

### Notification tidak diterima
- Pastikan Notification URL sudah di-set di Midtrans Dashboard
- Untuk local dev, pastikan ngrok sudah running
- Check endpoint: `POST /payment/notification` bisa diakses tanpa auth

### Payment sukses tapi order masih pending
- Check apakah notification dari Midtrans sudah masuk
- Check log: `storage/logs/laravel.log`
- Bisa manual trigger notification dari Midtrans Dashboard

## Production Checklist

Sebelum deploy ke production:

- [ ] Ganti `MIDTRANS_IS_PRODUCTION=true`
- [ ] Ganti Server Key dan Client Key ke Production keys
- [ ] Update Notification URL ke production domain
- [ ] Test semua metode pembayaran
- [ ] Setup monitoring untuk failed payments
- [ ] Backup database secara berkala

## Support

Untuk pertanyaan lebih lanjut tentang Midtrans:
- Dokumentasi: https://docs.midtrans.com
- Support: support@midtrans.com
- Dashboard: https://dashboard.midtrans.com

---

**Created by:** Muhammad Naufal
**Date:** January 15, 2026
**Version:** 1.0
