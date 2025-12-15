# Panduan Deploy Laravel ke Vercel

## File yang sudah dibuat:

### 1. ✅ `api/index.php`
- Entry point untuk Vercel
- Mengarahkan semua request ke Laravel

### 2. ✅ `.env.production`
- Konfigurasi environment untuk production
- Perlu update dengan APP_KEY dan APP_URL

### 3. ✅ `vercel.json` (sudah ada)
- Konfigurasi Vercel dengan runtime PHP

### 4. ✅ `composer.json` (sudah update)
- Menambahkan build script untuk Vercel

### 5. ✅ `.vercelignore`
- File/folder yang diabaikan saat deploy

---

## Langkah-langkah Deploy:

### 1. Persiapan Lokal
```bash
# Pastikan semua dependency terinstall
composer install
npm install
npm run build
```

### 2. Update Environment Variables
Edit `.env.production` dan sesuaikan:
- **APP_KEY**: Generate dengan `php artisan key:generate`, kemudian copy ke .env.production
- **APP_URL**: Ganti dengan URL Vercel Anda (format: https://nama-app.vercel.app)
- **Database**: Konfigurasi database produksi (PostgreSQL/MySQL hosted)

### 3. Setup di Vercel

#### Option A: CLI (Recommended)
```bash
npm i -g vercel
vercel login
vercel --prod
```

#### Option B: GitHub Integration
1. Push code ke GitHub
2. Connect repo di https://vercel.com/new
3. Set Environment Variables di Project Settings

### 4. Environment Variables di Vercel
Buka Project Settings → Environment Variables, tambahkan:
```
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.vercel.app
DB_CONNECTION=pgsql
DB_HOST=your-db-host
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password
LOG_CHANNEL=stderr
SESSION_DRIVER=cookie
CACHE_DRIVER=array
QUEUE_CONNECTION=sync
```

### 5. Database Setup
Untuk database, ada beberapa pilihan:
- **Vercel PostgreSQL** (Beta, recommended)
- **Railway.app** (PostgreSQL/MySQL)
- **PlanetScale** (MySQL)
- **Heroku Postgres**

Setelah setup database, update ENV di Vercel.

---

## Troubleshooting

### Error: "No application key provided"
```bash
php artisan key:generate
# Copy nilai APP_KEY dari .env
# Paste ke .env.production dan Vercel Environment Variables
```

### Error: "Class not found"
Pastikan:
- ✅ Cache dihapus: `/bootstrap/cache` kosong
- ✅ Run migrations: `php artisan migrate --force`
- ✅ Composer autoload: `composer dump-autoload`

### File upload tidak bekerja
Update `storage/app/public` permissions di .env:
```
FILESYSTEM_DISK=public
```

---

## Struktur File untuk Deploy

```
dlh-app/
├── api/
│   └── index.php          ✅ Entry point Vercel
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── vendor/
├── .env.production        ✅ Production env
├── .vercelignore          ✅ Ignore files
├── vercel.json            ✅ Vercel config
├── composer.json          ✅ Updated
├── package.json
└── vite.config.js
```

---

## Catatan Penting

⚠️ **Stateless Environment**
- Vercel bersifat stateless, tidak cocok untuk menyimpan file upload
- Gunakan cloud storage: AWS S3, Google Cloud Storage, atau Cloudinary
- Cache driver gunakan: `array` atau Redis (cloud-hosted)

⚠️ **Session**
- Gunakan `cookie` driver untuk session
- Jangan gunakan `file` driver

⚠️ **Cron Jobs**
- Laravel scheduler tidak berjalan otomatis
- Gunakan Vercel Cron Jobs atau layanan eksternal (EasyCron, AWS EventBridge)

✅ **Best Practices**
- Selalu test lokal sebelum deploy
- Monitor logs di Vercel dashboard
- Backup database sebelum deploy pertama kali
