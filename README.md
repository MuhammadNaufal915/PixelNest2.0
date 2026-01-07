# PixelNest - Design Marketplace Platform

A modern marketplace platform for buying and selling creative designs (logos, posters, artwork) built with Laravel. Features dual user roles, shopping cart, payment gateway integration, and order management.

## Features

### For Users
- 🎨 Browse and purchase creative artworks
- 📤 Upload and sell your own designs
- 🛒 Shopping cart system
- 💳 Secure payment with Midtrans
- 📦 Order history and file downloads
- 👤 Personal dashboard with statistics

### For Admins
- ✅ Approve/reject uploaded artworks
- 📊 Complete dashboard with analytics
- 🗂️ Manage categories
- 📋 View all orders and transactions
- 👥 User management capabilities

## Tech Stack

- **Framework**: Laravel 10
- **Database**: MySQL
- **Payment**: Midtrans (Snap)
- **Frontend**: Blade Templates with modern CSS
- **File Storage**: Laravel Storage

## Installation

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Laragon (recommended for Windows)

### Setup Steps

1. **Clone & Navigate**
   ```bash
   cd c:\laragon\www\PixelNest
   ```

2. **Install Dependencies**
   ```bash
   composer install
   composer require midtrans/midtrans-php
   ```

3. **Environment Configuration**
   ```bash
   copy .env.example .env
   ```

   Update `.env` file:
   ```env
   APP_NAME=PixelNest
   APP_URL=http://pixelnest.test
   
   DB_DATABASE=pixelnest
   DB_USERNAME=root
   DB_PASSWORD=
   
   # Midtrans Sandbox Credentials
   MIDTRANS_SERVER_KEY=your-server-key-here
   MIDTRANS_CLIENT_KEY=your-client-key-here
   MIDTRANS_IS_PRODUCTION=false
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Create Database**
   - Create database named `pixelnest` in MySQL

6. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

8. **Start Development Server**
   ```bash
   php artisan serve
   ```

   Visit: `http://localhost:8000`

## Default Credentials

**Admin Account:**
- Email: `admin@pixelnest.com`
- Password: `password`

**Test User Account:**
- Register your own at `/register`

## Midtrans Setup

1. Register at [Midtrans Sandbox](https://dashboard.sandbox.midtrans.com/)
2. Get your Server Key and Client Key
3. Add to `.env` file
4. For production, change `MIDTRANS_IS_PRODUCTION=true` and use production keys

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # Admin panel controllers
│   │   ├── Auth/           # Authentication
│   │   └── User/           # User area controllers
│   └── Middleware/
│       └── AdminMiddleware.php
├── Models/
│   ├── User.php
│   ├── Artwork.php
│   ├── Category.php
│   ├── Cart.php
│   ├── Order.php
│   └── ...
resources/
├── views/
│   ├── admin/             # Admin panel views
│   ├── auth/              # Login/Register
│   ├── user/              # User dashboard
│   ├── artworks/          # Artwork pages
│   ├── cart/              # Shopping cart
│   └── layouts/           # Base templates
database/
├── migrations/            # Database structure
└── seeders/              # Sample data
```

## Usage Guide

### As a User:
1. Register an account
2. Browse artworks on homepage
3. Add items to cart
4. Checkout and complete payment via Midtrans
5. Download purchased files from order history
6. Upload your own artworks (requires admin approval)

### As an Admin:
1. Login with admin credentials
2. Access admin dashboard at `/admin/dashboard`
3. Review and approve/reject user uploads
4. Manage categories
5. View all orders and transactions

## API Routes

### Public
- `GET /` - Homepage with artworks
- `GET /artworks/{id}` - Artwork detail

### Authentication Required
- `GET /user/dashboard` - User dashboard
- `GET /user/artworks` - Manage user's artworks
- `POST /cart/add/{artwork}` - Add to cart
- `POST /checkout/process` - Create order
- `GET /payment/{order}` - Payment page

### Admin Only
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/artworks` - Manage all artworks
- `POST /admin/artworks/{id}/approve` - Approve artwork
- `GET /admin/orders` - View all orders

## Database Schema

### Main Tables
- `users` - User accounts with roles
- `categories` - Artwork categories
- `artworks` - Design listings
- `carts` & `cart_items` - Shopping cart
- `orders` & `order_items` - Transactions

## Payment Flow

1. User adds items to cart
2. Proceeds to checkout
3. Order is created with "pending" status
4. Midtrans Snap popup appears
5. User completes payment
6. Webhook updates order status to "paid"
7. User can download files

## File Upload

- **Preview Images**: Stored in `storage/app/public/artworks/images/`
- **Download Files**: Stored in `storage/app/public/artworks/files/`
- **Max Sizes**: 5MB for images, 50MB for files

## Security Features

- CSRF protection on all forms
- Authentication middleware
- Role-based access control
- Secure file downloads (only for paid orders)
- Input validation and sanitization

## Contributing

This is a custom project. For modifications:
1. Follow Laravel best practices
2. Test all changes thoroughly
3. Update documentation as needed

## License

Proprietary - All rights reserved

## Support

For issues or questions, contact the development team.

---

**Built with ❤️ using Laravel**
