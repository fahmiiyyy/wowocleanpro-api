# WowoClean Pro API

Backend API untuk aplikasi WowoClean Pro yang dikembangkan menggunakan Laravel. Project ini dibuat untuk memenuhi tugas Ujian Akhir Praktikum Pemrograman Web dengan implementasi Database Integration, JWT Authentication, Role Authorization, API Gateway, Swagger Documentation, dan API Versioning.

## Informasi Mahasiswa

* Nama : Fahmi Muhammad Fayid Dhinanta
* NIM : 245150700111018
* Program Studi : Teknologi Informasi
* Angkatan : 2024
* Kelas : TIS C

## Teknologi yang Digunakan

* Laravel 12
* MySQL
* JWT Authentication
* L5 Swagger
* Axios
* API Gateway Pattern

## Fitur Utama

### Database Integration

* Penyimpanan data kontainer ke database MySQL
* Penyimpanan data tracking log ke database MySQL
* Relasi Container dan Tracking Log
* Migrasi database menggunakan Laravel Migration

### Container Management

* Menampilkan seluruh data kontainer
* Menambahkan kontainer baru
* Mengubah status kontainer menjadi Archived
* Menghapus data kontainer
* Pencarian dan filter data kontainer

### Tracking Log

* Menampilkan riwayat perjalanan kontainer
* Relasi satu kontainer memiliki banyak tracking log

### JWT Authentication

* Login pengguna
* Melihat profil pengguna
* Logout pengguna
* Token-based authentication menggunakan JWT

### Role Authorization

* Role Admin
* Role User atau Operator Lapangan
* Pembatasan akses endpoint berdasarkan role

### API Gateway

* Seluruh akses client menggunakan endpoint gateway
* Middleware autentikasi pada gateway
* Middleware role authorization pada gateway

### API Documentation

* Dokumentasi API menggunakan Swagger
* Endpoint dapat diuji langsung melalui Swagger UI
* Dokumentasi tersedia pada:

```text
/api/documentation
```

### API Versioning

Seluruh endpoint menggunakan URI Versioning:

```text
/api/v1/login
/api/v1/profile
/api/v1/logout

/api/v1/gateway/containers
/api/v1/gateway/containers/search
/api/v1/gateway/containers/{id}/logs
/api/v1/gateway/containers/{id}/archive
```

## Cara Menjalankan Project

### Clone Repository

```bash
git clone https://github.com/fahmiiyyy/wowocleanpro-api.git
```

### Install Dependency

```bash
composer install
```

### Copy Environment

```bash
cp .env.example .env
```

### Generate Key

```bash
php artisan key:generate
```

### Generate JWT Secret

```bash
php artisan jwt:secret
```

### Migrasi Database

```bash
php artisan migrate
```

### Jalankan Server

```bash
php artisan serve
```

## Author

Fahmi Muhammad Fayid Dhinanta
245150700111018
Teknologi Informasi 2024 - TIS C
