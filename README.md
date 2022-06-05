# SI-Berprestasi

## Requirement
Dependencies:
```
- PHP Version 7.4
```

## Instalasi
Clone repository:
```
git clone https://github.com/rizalgemilangputra/SI-Berprestasi.git
cd SI-Berprestasi
```

buat konfigurasi `.env`
```
cp .env.example .env
```
Edit `.env` file. Ubah koneksi database dan lainnya.

setelah itu, install package:
```
composer install
```

dan jalankan perintah:
```
php artisan migrate
php artisan db:seeder
```

## Menjalankan
Development:
```
# start Laravel
php artisan serve
```
Akses aplikasi:
```
Url         : http://127.0.0.1:8000/
Email       : kesiswaan@gmail.com
Password    : kesiswaan@2022
```
