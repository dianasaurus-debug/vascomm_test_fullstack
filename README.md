<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Cara Run Project

1. Setelah ekstrak project ke .zip, masuk ke direktori project di cmd
2. Ketikkan <b>composer install</b> di cmd, tunggu sampai proses selesai
3. Lalu generate app key dengan menyalin isi file .env.example ke file .env di dalam folder project, lalu ketikkan perintah <b>php artisan key:generate</b>
4. Install semua dependency di package.json dengan <b>npm install</b>, tunggu sampai package terinstall semua
5. Setelah itu, konfigurasikan file .env sesuai pengaturan database anda, nyalakan terlebih dahulu database anda, kemudian migrate semua table di project dengan perintah <b>php artisan migrate</b>
6. Setelah semua dimigrate, lalu isikan beberapa data tabel dengan data di seeder, dengan perintah <b>php artisan db:seed</b>
7. Jika sudah, hidupkan server dengan perintah <b>php artisan serve</b>
8. lalu, compile vue dengan <b>npm run dev</b>
9. Kemudian <i>Project sudah siap digunakan!</i>, untuk login admin akses localhost:8000/admin/login, gunakan akun dengan email : admin@gmail.com dan password : password
10. Untuk login customer akses localhost:8000/admin/login, gunakan akun dengan email : admin@gmail.com dan password : password

