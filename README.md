# 🍵 Sistem Pemesanan Warkop

Sistem pemesanan online untuk warung kopi (warkop) yang dibangun menggunakan Laravel. Aplikasi ini memungkinkan pelanggan untuk memesan menu makanan dan minuman secara online dengan sistem pembayaran terintegrasi.

## 📋 Fitur Utama

- ✅ Manajemen produk (menu makanan dan minuman)
- ✅ Sistem pemesanan online
- ✅ Manajemen pesanan dengan status tracking
- ✅ Integrasi pembayaran Midtrans
- ✅ Dashboard admin untuk monitoring
- ✅ Responsive design dengan Tailwind CSS

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 10.x
- **Frontend**: Blade Templates, Tailwind CSS, Vite
- **Database**: MySQL
- **Payment Gateway**: Midtrans
- **Authentication**: Laravel Sanctum

## 📁 Struktur Folder
pemesanan-warkop/
├── app/                          # Core aplikasi Laravel
│   ├── Http/Controllers/         # Controllers untuk handle request
│   ├── Models/                   # Eloquent models
│   │   ├── User.php             # Model user/admin
│   │   ├── Product.php          # Model produk menu
│   │   ├── Order.php            # Model pesanan
│   │   ├── OrderItem.php        # Model item pesanan
│   │   └── Menu.php             # Model menu tambahan
│   ├── Providers/               # Service providers
│   └── View/Components/         # Blade components
├── database/                     # Database related files
│   ├── migrations/              # Database migrations
│   └── seeders/                 # Database seeders
│       ├── UserSeeder.php       # Seeder untuk user admin
│       ├── ProductSeeder.php    # Seeder untuk produk menu
│       ├── OrderSeeder.php      # Seeder untuk contoh pesanan
│       └── OrderItemSeeder.php  # Seeder untuk item pesanan
├── resources/                    # Frontend resources
│   ├── views/                   # Blade templates
│   │   ├── home.blade.php       # Halaman utama/menu
│   │   ├── checkout.blade.php   # Halaman checkout
│   │   ├── payment.blade.php    # Halaman pembayaran
│   │   └── chart.blade.php      # Dashboard/laporan
│   ├── css/                     # Stylesheets
│   └── js/                      # JavaScript files
├── routes/                       # Route definitions
│   ├── web.php                  # Web routes
│   └── api.php                  # API routes
├── config/                       # Configuration files
│   ├── midtrans.php             # Konfigurasi Midtrans
│   └── database.php             # Konfigurasi database
└── public/                       # Public assets
├── img/                     # Images
└── index.php                # Entry point


## 🚀 Cara Menjalankan Project

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/MariaDB

### 1. Clone Repository
```bash
git clone <repository-url>
cd pemesanan-warkop
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pemesanan_warkop
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Midtrans Configuration
Tambahkan konfigurasi Midtrans di `.env`:
```env
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
```

### 6. Database Migration & Seeding
```bash
# Jalankan migration
php artisan migrate:fresh

# Jalankan seeder untuk data awal
php artisan db:seed
```

### 7. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 8. Jalankan Server
```bash
# Development server
php artisan serve

# Akses aplikasi di: http://localhost:8000
```

## 📊 Database Schema

### Tabel Users
- `id` - Primary key
- `name` - Nama user
- `email` - Email user
- `password` - Password (hashed)

### Tabel Products
- `id` - Primary key
- `name` - Nama produk
- `image` - URL gambar produk
- `price` - Harga produk
- `category` - Kategori (coffee, non_coffee, makanan, cemilan)

### Tabel Orders
- `id` - Primary key
- `order_id` - ID pesanan unik
- `customer_name` - Nama pelanggan
- `customer_meja` - Nomor meja
- `customer_phone` - Nomor telepon
- `notes` - Catatan pesanan
- `total_price` - Total harga
- `status` - Status pesanan (Pending, Selesai)
- `payment_method` - Metode pembayaran

### Tabel Order Items
- `id` - Primary key
- `order_id` - Foreign key ke orders
- `product_name` - Nama produk
- `quantity` - Jumlah
- `price` - Harga satuan
- `subtotal` - Subtotal (price × quantity)

## 🎯 Fungsi Utama

### 1. Manajemen Produk
- **Model**: `Product.php`
- **Fungsi**: Mengelola menu makanan dan minuman
- **Kategori**: Coffee, Non-Coffee, Makanan, Cemilan

### 2. Sistem Pemesanan
- **Model**: `Order.php`, `OrderItem.php`
- **Fungsi**: Mengelola pesanan pelanggan
- **Fitur**: Multi-item order, customer info, table assignment

### 3. Payment Integration
- **Config**: `config/midtrans.php`
- **Fungsi**: Integrasi dengan Midtrans payment gateway
- **Support**: Credit card, bank transfer, e-wallet

### 4. Dashboard & Reporting
- **View**: `chart.blade.php`
- **Fungsi**: Monitoring pesanan dan laporan penjualan

## 🔧 Perintah Artisan Berguna

```bash
# Reset database dengan data fresh
php artisan migrate:fresh --seed

# Membuat controller baru
php artisan make:controller NamaController

# Membuat model dengan migration
php artisan make:model NamaModel -m

# Membuat seeder
php artisan make:seeder NamaSeeder

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📱 Deployment

### Vercel Deployment
Project ini sudah dikonfigurasi untuk deployment di Vercel:
- File `vercel.json` - Konfigurasi Vercel
- Folder `api/` - Entry point untuk Vercel

### Production Setup
1. Set environment variables di hosting
2. Jalankan `composer install --optimize-autoloader --no-dev`
3. Jalankan `npm run build`
4. Set proper file permissions
5. Configure web server (Apache/Nginx)

## 🤝 Contributing

1. Fork repository
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 License

Project ini menggunakan [MIT License](https://opensource.org/licenses/MIT).

## 📞 Support

Jika ada pertanyaan atau issue, silakan buat issue di repository ini atau hubungi developer.

---

**Dibuat dengan ❤️ untuk kemudahan pemesanan di warkop kesayangan Anda!**