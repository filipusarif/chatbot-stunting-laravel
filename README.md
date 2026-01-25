# 🍼 StuntingCare Web Platform (Laravel + Tailwind)

Platform web **StuntingCare** adalah sistem informasi yang dirancang untuk memberikan edukasi mengenai stunting dan layanan deteksi dini. Web ini berfungsi sebagai *frontend* utama dan panel kontrol admin untuk mengelola konten, pengguna, dan integrasi API ke backend AI.

---

### 🚀 Fitur Utama

#### **Halaman Publik**

* **Landing Page**: Antarmuka modern yang informatif mengenai pencegahan stunting.
* **Deteksi Dini**: Layanan berbasis AI untuk pengecekan risiko stunting (terhubung ke FastAPI).
* **Artikel Edukasi**: Portal informasi kesehatan terpercaya.
* **Chatbot AI**: Asisten pintar yang menjawab pertanyaan seputar stunting secara *real-time*.

#### **Panel Admin**

* **Dashboard Statistik**: Ringkasan jumlah artikel, pengguna, dan status sistem.
* **Manajemen Artikel (CRUD)**: Kelola konten edukasi lengkap dengan fitur unggah gambar.
* **Manajemen Pengguna (CRUD)**: Kelola akun pengguna dan hak akses administrator.
* **API Settings**: Konfigurasi token NVIDIA NIM secara dinamis tanpa perlu mengubah kode sumber.

---

### 🛠️ Tech Stack & Requirements

| Komponen | Teknologi |
| --- | --- |
| **Framework** | Laravel 12.x |
| **Frontend Styling** | Tailwind CSS (Custom Config) |
| **Interactivity** | Alpine.js |
| **Database** | MySQL / MariaDB |
| **PHP Version** | 8.2 atau lebih tinggi |
| **Dependencies** | Laravel Breeze (Starter Kit) |

---

### 📥 Instalasi & Setup

Ikuti langkah-langkah berikut untuk menjalankan proyek di lingkungan lokal Anda:

1. **Clone Repository**
```bash
git clone https://github.com/filipusarif/chatbot-stunting-laravel.git
cd hatbot-stunting-laravel

```


2. **Instal Dependencies**
```bash
composer install

```


3. **Konfigurasi Environment**
Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda:
```bash
cp .env.example .env

```


4. **Generate App Key**
```bash
php artisan key:generate

```


5. **Migrasi Database & Seeder**
Jalankan perintah ini untuk membuat tabel dan akun admin default (`admin@gmail.com`):
```bash
php artisan migrate --seed

```


6. **Hubungkan Storage**
Agar gambar artikel dapat diakses oleh publik:
```bash
php artisan storage:link

```


7. **Konfigurasi FastAPI**
Buka file `.env` dan tambahkan URL backend FastAPI Anda:
```env
FASTAPI_BACKEND_URL=http://localhost:8001

```



---

### 📂 Struktur Proyek

```text
.
├── app/
│   ├── Http/Controllers/   # Logika AdminController & Profile
│   └── Models/             # Model Article, User, & Setting
├── database/
│   ├── migrations/         # Struktur tabel database
│   └── seeders/            # Data awal (Admin & Settings)
├── public/                 # Aset statis dan shortcut storage
├── resources/
│   └── views/
│       ├── admin/          # Tampilan Dashboard, Users, Articles
│       ├── auth/           # Tampilan Login & Register
│       ├── components/     # Komponen Chatbot & UI
│       └── layouts/        # Layout App dengan Sidebar dinamis
└── routes/
    └── web.php             # Definisi rute publik dan admin

```

---

### 🔌 Integrasi Chatbot

Frontend menggunakan JavaScript (Fetch API) untuk berkomunikasi dengan FastAPI. Token NVIDIA diambil secara dinamis dari tabel `settings` di database, sehingga admin dapat memperbarui token langsung dari panel kontrol tanpa menyentuh file `.env`.

---

### 🛠️ Cara Menjalankan

Jalankan server Laravel:

```bash
php artisan serve

```

Akses aplikasi melalui browser di `http://localhost:8000`.

