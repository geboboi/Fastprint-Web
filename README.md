# Fastprint-Web

<a id="readme-top"></a>


<br />
<div align="center">

  <h3 align="center">FastPrint Product Management System</h3>

  <p align="center">
    Sistem manajemen produk terintegrasi dengan API FastPrint untuk Junior Programmer Test
  </p>
</div>

<details>
  <summary>Daftar Isi</summary>
  <ol>
    <li>
      <a href="#tentang-proyek">Tentang Proyek</a>
      <ul>
        <li><a href="#fitur-utama">Fitur Utama</a></li>
        <li><a href="#teknologi-yang-digunakan">Teknologi yang Digunakan</a></li>
      </ul>
    </li>
    <li>
      <a href="#memulai">Getting Started</a>
      <ul>
        <li><a href="#instalasi">Instalasi</a></li>
      </ul>
    </li>
    <li><a href="#penggunaan">Penggunaan</a></li>
    <li><a href="#struktur-database">Struktur Database</a></li>
    <li><a href="#api-reference">API Reference</a></li>
    <li><a href="#screenshot">Screenshot</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#kontribusi">Kontribusi</a></li>
    <li><a href="#lisensi">Lisensi</a></li>
    <li><a href="#kontak">Kontak</a></li>
    <li><a href="#ucapan-terima-kasih">Ucapan Terima Kasih</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->
## Tentang Proyek

Sistem Manajemen Produk FastPrint adalah aplikasi web yang dibangun sebagai bagian dari tes Junior Programmer. Aplikasi ini mengintegrasikan data produk dari API FastPrint ke dalam database lokal dan menyediakan antarmuka CRUD (Create, Read, Update, Delete) yang lengkap untuk mengelola data produk.

### Fitur Utama

- ✅ **Integrasi API FastPrint** - Mengambil data produk secara otomatis dari API eksternal
- ✅ **Manajemen Produk Lengkap** - CRUD (Create, Read, Update, Delete) untuk data produk
- ✅ **Filter Produk** - Menampilkan produk berdasarkan status "Bisa Dijual"
- ✅ **Validasi Form** - Validasi input untuk nama produk dan harga
- ✅ **Konfirmasi Hapus** - Alert konfirmasi sebelum menghapus data
- ✅ **Pagination** - Menampilkan data produk dengan pagination (10 item per halaman)
- ✅ **Relasi Database** - Implementasi relasi antar tabel (Produk, Kategori, Status)
- ✅ **UI Modern** - Menggunakan Tailwind CSS untuk tampilan yang responsif dan modern
- ✅ **Progress Bar** - Progress indicator saat mengambil data dari API

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Teknologi yang Digunakan

* [![Laravel][Laravel.com]][Laravel-url]
* [![MySQL][MySQL.com]][MySQL-url]
* [![TailwindCSS][TailwindCSS.com]][TailwindCSS-url]
* [![PHP][PHP.net]][PHP-url]
* [![Composer][Composer.com]][Composer-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->
## Getting Started

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda.

Pastikan komputer Anda sudah terinstal software berikut:

* **PHP** >= 8.1
  ```sh
  php --version
  ```

* **Composer** (Dependency Manager untuk PHP)
  ```sh
  composer --version
  ```
  
  Jika belum terinstal, download dari [getcomposer.org](https://getcomposer.org/)

* **MySQL** >= 5.7 atau **MariaDB**
  ```sh
  mysql --version
  ```

* **Node.js & NPM** (untuk Tailwind CSS)
  ```sh
  node --version
  npm --version
  ```

### Instalasi

Ikuti langkah-langkah berikut dengan seksama:

1. **Clone Repository**
   ```sh
   git clone https://github.com/geboboi/fastprint-web.git
   cd fastprint-web
   ```

2. **Install Dependencies PHP**
   ```sh
   composer install
   ```

3. **Install Dependencies Node.js**
   ```sh
   npm install
   ```

4. **Copy File Environment**
   ```sh
   cp .env.example .env
   ```

5. **Generate Application Key**
   ```sh
   php artisan key:generate
   ```

6. **Konfigurasi Database**
   
   Buka file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=fastprint_web
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. **Buat Database**
   
   Buka MySQL/phpMyAdmin dan buat database baru:
   ```sql
   CREATE DATABASE fastprint_web;
   ```

8. **Jalankan Migration**
   
   Buat tabel-tabel yang diperlukan:
   ```sh
   php artisan migrate
   ```
   
   Migration akan membuat tabel berikut:
   - `produk` - Tabel untuk menyimpan data produk
   - `kategori` - Tabel untuk menyimpan kategori produk
   - `status` - Tabel untuk menyimpan status produk

9. **Import Data dari API FastPrint**
   
   Jalankan seeder untuk mengambil data dari API:
   ```sh
   php artisan db:seed
   ```
   
   Atau jalankan command secara langsung:
   ```sh
   php artisan produk:fetch
   ```
   
   > **Catatan:** Username API akan berubah setiap hari mengikuti server.
   > Contoh untuk tanggal 29 Januari 2026: `tesprogrammer290126C22`

10. **Compile Assets (Tailwind CSS)**
    ```sh
    npm run dev
    ```
    
    Atau untuk production:
    ```sh
    npm run build
    ```

11. **Jalankan Aplikasi**
    ```sh
    php artisan serve
    ```
    
    Aplikasi akan berjalan di `http://localhost:8000`

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- USAGE -->
## Penggunaan

### Halaman Utama

Setelah instalasi selesai, buka browser dan akses `http://localhost:8000`

Anda akan melihat halaman utama yang menampilkan daftar produk dengan fitur:
- **Filter Status** - Pilih "Bisa Dijual" atau "Semua" produk
- **Pagination** - Navigasi halaman dengan 10 produk per halaman
- **Action Buttons** - Edit dan Hapus untuk setiap produk

### Menambah Produk Baru

1. Klik tombol **"Tambah Produk"** di halaman utama
2. Isi form dengan data berikut:
   - **Nama Produk** (wajib diisi)
   - **Harga** (wajib diisi, hanya angka)
   - **Kategori** (pilih dari dropdown)
   - **Status** (pilih dari dropdown)
3. Klik **"Simpan"**

### Mengedit Produk

1. Klik tombol **"Edit"** pada produk yang ingin diubah
2. Ubah data yang diperlukan
3. Klik **"Update"**

### Menghapus Produk

1. Klik tombol **"Hapus"** pada produk yang ingin dihapus
2. Konfirmasi penghapusan pada dialog alert
3. Produk akan dihapus dari database

### Mengambil Data Terbaru dari API

Untuk memperbarui data produk dari API FastPrint:

```sh
php artisan produk:fetch
```

Command ini akan:
- Login ke API FastPrint dengan kredensial yang sesuai
- Mengambil semua data produk
- Menyimpan/update data ke database lokal
- Menampilkan progress bar selama proses

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- DATABASE STRUCTURE -->
## Struktur Database

### Tabel: `produk`

| Kolom         | Tipe Data    | Keterangan                    |
|---------------|--------------|-------------------------------|
| id_produk     | INT (PK)     | Primary Key                   |
| nama_produk   | VARCHAR(255) | Nama produk                   |
| harga         | INT          | Harga produk (dalam rupiah)   |
| kategori_id   | INT (FK)     | Foreign key ke tabel kategori |
| status_id     | INT (FK)     | Foreign key ke tabel status   |
| created_at    | TIMESTAMP    | Waktu pembuatan               |
| updated_at    | TIMESTAMP    | Waktu update terakhir         |

### Tabel: `kategori`

| Kolom          | Tipe Data    | Keterangan      |
|----------------|--------------|-----------------|
| id_kategori    | INT (PK)     | Primary Key     |
| nama_kategori  | VARCHAR(255) | Nama kategori   |
| created_at     | TIMESTAMP    | Waktu pembuatan |
| updated_at     | TIMESTAMP    | Waktu update    |

### Tabel: `status`

| Kolom       | Tipe Data    | Keterangan      |
|-------------|--------------|-----------------|
| id_status   | INT (PK)     | Primary Key     |
| nama_status | VARCHAR(255) | Nama status     |
| created_at  | TIMESTAMP    | Waktu pembuatan |
| updated_at  | TIMESTAMP    | Waktu update    |

### Relasi Database

```
produk
├── belongsTo kategori (kategori_id -> id_kategori)
└── belongsTo status (status_id -> id_status)
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- API REFERENCE -->
## API Reference

### Endpoint API FastPrint

**URL:** `https://recruitment.fastprint.co.id/tes/api_tes_programmer`

**Method:** `POST`

**Content-Type:** `application/x-www-form-urlencoded`

### Request Parameters

| Parameter | Tipe   | Deskripsi                                  |
|-----------|--------|--------------------------------------------|
| username  | string | Format: `tesprogrammer[DDMMYY]C22`        |
| password  | string | MD5 hash dari `bisacoding-[DD-MM-YY]`     |
| status    | string | Filter status (default: "1")               |

### Contoh Request

```php
// Tanggal: 29-01-2026
$username = 'tesprogrammer290126C22';
$password = md5('bisacoding-29-01-26');

$response = Http::asForm()->post('https://recruitment.fastprint.co.id/tes/api_tes_programmer', [
    'username' => $username,
    'password' => $password,
    'status'   => '1'
]);
```

### Response Format

```json
{
  "error": 0,
  "ket": "Sukses",
  "data": [
    {
      "id_produk": "1",
      "nama_produk": "Contoh Produk",
      "harga": "Rp 50.000",
      "kategori": "Nama Kategori",
      "status": "bisa dijual"
    }
  ]
}
```

### Error Response

```json
{
  "error": 1,
  "ket": "Username atau Password salah"
}
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<p align="right">(<a href="#readme-top">back to top</a>)</p>




<!-- CONTACT -->
## Kontak

Gabriela Sihutomo - gabie.jelita@gmail.com

Project Link: [https://github.com/geboboi/fastprint-web](https://github.com/geboboi/fastprint-web)

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- TROUBLESHOOTING -->
## Troubleshooting

### Error: "SQLSTATE[HY000] [2002] Connection refused"

**Solusi:**
- Pastikan MySQL service sudah berjalan
- Periksa konfigurasi di file `.env` (DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD)

### Error: "Username atau Password salah" saat fetch data

**Solusi:**
- Periksa username di file `GetProduk.php` apakah sudah sesuai dengan tanggal hari ini
- Format username: `tesprogrammer[DDMMYY]C22`
- Contoh: untuk tanggal 29 Januari 2026 → `tesprogrammer290126C22`

### Tailwind CSS tidak bekerja

**Solusi:**
```sh
npm run dev
```
Atau compile untuk production:
```sh
npm run build
```

### Migration error

**Solusi:**
```sh
php artisan migrate:fresh
php artisan db:seed
```

### Port 8000 sudah digunakan

**Solusi:**
Jalankan di port berbeda:
```sh
php artisan serve --port=8080
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>


[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[MySQL.com]: https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white
[MySQL-url]: https://www.mysql.com
[TailwindCSS.com]: https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white
[TailwindCSS-url]: https://tailwindcss.com
[PHP.net]: https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white
[PHP-url]: https://www.php.net
[Composer.com]: https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white
[Composer-url]: https://getcomposer.org
