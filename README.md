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
10. Run `php artisan serve`


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

## Screenshots

