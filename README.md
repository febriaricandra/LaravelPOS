# Point Of Sales System

## Description

This is a simple point of sales system for a small business. It is built with Laravel 10 and SBAdmin template.

### How to run the project

1. Clone this repository
2. Open the project in your IDE
3. Run `composer install`
4. Copy .env.example to .env
5. setup your database in .env
6. Run `php artisan key:generate`
7. Run `php artisan migrate`
8. Run `php artisan db:seed --class=CreateUsersSeeder` to create admin user
9. Run `php artisan db:seed --class=BarangSeeder` to create barang
10. Run `php artisan db:seed --class=StatusSeeder` to create status
11. Run `php artisan serve`


## Features

- Authentication
- CRUD Barang
- Point of Sales
- CRUD User

## Dependencies

- Laravel 10
- SBAdmin Template
- Laravel IdGenerator



## References

- [Laravel](https://laravel.com/)
- [SBAdmin](https://startbootstrap.com/template/sb-admin)
- [Laravel IdGenerator](https://github.com/haruncpi/laravel-id-generator)
- [ChartJS](https://www.chartjs.org/)
- [Bootstrap](https://getbootstrap.com/)

## Screenshots

--- Login Page ---
![Login Page](/screenshot/Login.png)

--- Admin ---
![Admin Dashboard](/screenshot/admin/admin%20Halaman%20Utama%20-%20PT%20Minamas%20TC.png)
![Halaman Barang](/screenshot/admin/admin%20Halaman%20Barang%20-%20PT%20Minamas%20TC.png)
![Halaman Order](/screenshot/admin/admin%20Halaman%20Order%20-%20PT%20Minamas%20TC.png)
![Halaman Utang](/screenshot//admin/admin%20Halaman%20Utang%20-%20PT%20Minamas%20TC.png)
![Halaman Karyawan](/screenshot/admin/admin%20Halaman%20Karyawan%20-%20PT%20Minamas%20TC.png)

--- Karyawan ---
![Karyawan Dashboard](/screenshot/karyawan/Halaman%20Utama%20-%20PT%20Minamas%20TC.png)
![Halaman Barang](/screenshot/karyawan/Halaman%20Barang%20-%20PT%20Minamas%20TC.png)
![Halaman Order](/screenshot/karyawan/Halaman%20Order%20-%20PT%20Minamas%20TC.png)
![Halaman Utang](/screenshot/karyawan/Halaman%20Utang%20-%20PT%20Minamas%20TC.png)
![Halaman Point Of Sale](/screenshot/karyawan/Point%20Of%20Sale%20-%20PT%20Minamas%20TC.png)
