# Galeri Wisata

Aplikasi web untuk menampilkan destinasi, artikel, promosi, dan galeri wisata. Pengunjung yang sudah masuk dapat melihat konten, dan admin dapat mengelola data serta mengunduh laporan.

## Fitur

- Daftar akun, masuk, dan keluar
- Destinasi wisata
- Artikel wisata
- Promosi
- Galeri foto, video, dan virtual tour
- Dasbor admin, kelola konten, dan unduh laporan

## Menjalankan aplikasi

Aplikasi ini berjalan di PHP (Laravel) dengan database. GitHub hanya menyimpan kode sumbernya. Halaman `github.io` tidak menjalankan PHP, jadi yang tampil di sana adalah penjelasan proyek ini.

1. Pasang dependency: `composer install` lalu `npm install`
2. Salin `.env.example` menjadi `.env`
3. Buat kunci aplikasi: `php artisan key:generate`
4. Siapkan database: `php artisan migrate`
5. Bangun tampilan: `npm run build`
6. Buka lewat Laragon, misalnya `http://galeri-wisata.test`

## Uji

```bash
php artisan test
```
