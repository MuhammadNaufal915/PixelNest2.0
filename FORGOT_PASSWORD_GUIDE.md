# Forgot Password Feature - PixelNest

## ✅ Fitur yang Sudah Diimplementasi

- ✅ Halaman Forgot Password dengan form email
- ✅ Pengiriman email reset password
- ✅ Halaman Reset Password dengan form password baru
- ✅ Validasi token dan expired check (60 menit)
- ✅ Update password di database
- ✅ Redirect ke login dengan success message
- ✅ Modern UI design yang konsisten dengan aplikasi

## 📂 Files yang Dibuat

### Backend
1. **`app/Http/Controllers/Auth/ForgotPasswordController.php`**
   - `showLinkRequestForm()` - Tampilkan form forgot password
   - `sendResetLinkEmail()` - Kirim email reset link
   - `showResetForm()` - Tampilkan form reset password
   - `reset()` - Proses reset password dan update database

### Views
2. **`resources/views/auth/forgot-password.blade.php`**
   - Form untuk input email
   - Validasi dan error handling
   - Success message setelah email terkirim

3. **`resources/views/auth/reset-password.blade.php`**
   - Form untuk input password baru
   - Password confirmation
   - Token validation

4. **`resources/views/emails/reset-password.blade.php`**
   - Email template dengan design modern
   - Reset link dengan token
   - Informasi expiry (60 menit)

### Routes (Updated)
5. **`routes/web.php`**
   - `GET /forgot-password` - Tampilkan form forgot password
   - `POST /forgot-password` - Kirim reset link
   - `GET /password/reset/{token}` - Tampilkan form reset
   - `POST /password/reset` - Proses reset password

6. **`resources/views/auth/login.blade.php`** (Updated)
   - Link "Forgot Password?" sudah berfungsi
   - Success message setelah reset berhasil

## 🔄 Cara Kerja

### 1. User Forgot Password
```
User klik "Forgot password?" di login page
↓
Masuk ke /forgot-password
↓
Input email dan klik "Send Reset Link"
↓
System check email di database
↓
Generate random token (64 karakter)
↓
Simpan token ke tabel password_reset_tokens (hashed)
↓
Kirim email dengan reset link
↓
User menerima email
```

### 2. User Reset Password
```
User klik link di email
↓
Masuk ke /password/reset/{token}?email=xxx
↓
Input password baru dan konfirmasi
↓
System validasi token (check expired & validity)
↓
Update password user di database
↓
Hapus token dari password_reset_tokens
↓
Redirect ke login dengan success message
↓
User login dengan password baru
```

## 🗄️ Database

### Tabel `password_reset_tokens`
Sudah ada dari migration default Laravel:

```php
Schema::create('password_reset_tokens', function (Blueprint $table) {
    $table->string('email')->primary();
    $table->string('token');                // Hashed token
    $table->timestamp('created_at')->nullable();
});
```

### Flow Data
1. **Generate Token**: Random 64 karakter
2. **Store Token**: Hash dengan `Hash::make()` sebelum simpan
3. **Check Token**: Verify dengan `Hash::check()`
4. **Expiry**: Check `created_at` + 60 menit
5. **Delete Token**: Hapus setelah password berhasil direset

## 📧 Email Configuration

### Setup Email (Development)

Untuk development, edit `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@pixelnest.com"
MAIL_FROM_NAME="PixelNest"
```

### Using Mailpit (Recommended untuk Testing)

Mailpit sudah include dengan Laravel Herd/Valet:
1. Buka browser: `http://localhost:8025`
2. Semua email akan tampil di sini
3. Tidak perlu setup SMTP real

### Alternative: Mailtrap (Free)

1. Daftar di https://mailtrap.io
2. Buat inbox baru
3. Copy credentials ke `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

### Production: Gmail SMTP

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@pixelnest.com"
MAIL_FROM_NAME="PixelNest"
```

**Note**: Gunakan App Password, bukan password Gmail biasa.

## 🧪 Testing

### Manual Test

1. **Test Forgot Password:**
   ```
   1. Buka /login
   2. Klik "Forgot password?"
   3. Input email yang terdaftar
   4. Klik "Send Reset Link"
   5. Check email (Mailpit/Mailtrap)
   6. Klik link di email
   ```

2. **Test Reset Password:**
   ```
   1. Dari email, klik reset link
   2. Input password baru (min 8 karakter)
   3. Konfirmasi password
   4. Klik "Reset Password"
   5. Harus redirect ke login dengan success message
   6. Login dengan password baru
   ```

3. **Test Validasi:**
   - Email tidak terdaftar → Error message
   - Token expired (>60 menit) → Error message
   - Token invalid → Error message
   - Password tidak match → Error message
   - Password < 8 karakter → Error message

## 🚀 Routes yang Tersedia

| Method | URL | Controller Method | Deskripsi |
|--------|-----|-------------------|-----------|
| GET | `/forgot-password` | `showLinkRequestForm()` | Form forgot password |
| POST | `/forgot-password` | `sendResetLinkEmail()` | Kirim reset link |
| GET | `/password/reset/{token}` | `showResetForm()` | Form reset password |
| POST | `/password/reset` | `reset()` | Proses reset |

## 🔒 Security Features

1. **Token Hashing**: Token di-hash sebelum disimpan di database
2. **Token Expiry**: Link expired setelah 60 menit
3. **One-time Use**: Token dihapus setelah digunakan
4. **Email Validation**: Check email ada di database
5. **Password Validation**: Min 8 karakter, harus match konfirmasi
6. **Old Token Cleanup**: Token lama dihapus saat generate token baru

## ⚠️ Troubleshooting

### Email tidak terkirim
- Check konfigurasi MAIL di `.env`
- Jalankan: `php artisan config:clear`
- Check log: `storage/logs/laravel.log`
- Pastikan Mailpit/Mailtrap running

### Link tidak berfungsi
- Check APP_URL di `.env` sudah benar
- Check token masih valid (belum expired)
- Check email parameter di URL

### Error "Token expired"
- Token hanya berlaku 60 menit
- Request reset link baru

### Error "Invalid token"
- Jangan edit URL reset link
- Request reset link baru

## 📝 Customization

### Ubah Token Expiry

Edit di `ForgotPasswordController.php`:
```php
// Default 60 minutes
if (Carbon::parse($passwordReset->created_at)->addMinutes(60)->isPast()) {
    
// Ubah ke 120 minutes
if (Carbon::parse($passwordReset->created_at)->addMinutes(120)->isPast()) {
```

### Ubah Email Template

Edit file `resources/views/emails/reset-password.blade.php`

### Ubah Password Rules

Edit di `ForgotPasswordController.php`:
```php
$request->validate([
    'password' => 'required|string|min:8|confirmed',
    
    // Tambah rules lain:
    // 'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/',
]);
```

## ✨ Features

- ✅ Modern UI dengan animasi
- ✅ Responsive design
- ✅ Error handling lengkap
- ✅ Success/error messages
- ✅ Email dengan design professional
- ✅ Security best practices
- ✅ Token expiry system
- ✅ Database integration
- ✅ Password validation

---

**Ready to use!** 🎉

User sekarang bisa reset password mereka sendiri dengan flow yang aman dan user-friendly.
