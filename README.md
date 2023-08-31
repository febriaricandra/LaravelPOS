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




## Jquery

```
@extends('layouts.karyawan')

@section('title', 'Point Of Sale - PT Minamas TC')

@section('content')
    <h1>Point of Sale</h1>

    <div>
        <select id="barangDropdown">
            <option value="" disabled selected>Pilih barang</option>
            @foreach ($barang as $item)
                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
            @endforeach
        </select>
        <button id="addButton">Tambahkan</button>
    </div>

    <table id="barang-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
        <div>
            <label>Total Pembayaran: </label>
            <span id="totalPembayaran">0</span>
        </div>
    </table>
    <script>
        $(document).ready(function() {
            const availableBarangs = @json($barang);
            console.log(availableBarangs);
            const barangDropdown = $('#barangDropdown');
            const addButton = $('#addButton');
            const barangTable = $('#barang-table tbody');
            const totalPembayaran = $('#totalPembayaran');

            let total = 0;

            barangDropdown.on('change', function() {
                const barangId = $(this).val();
                const barang = availableBarangs.find(barang => barang.id == barangId);
                if (barang) {
                    addButton.prop('disabled', false);
                } else {
                    addButton.prop('disabled', true);
                }
            });

            addButton.on('click', function() {
                const barangId = barangDropdown.val();
                const barang = availableBarangs.find(barang => barang.id == barangId);
                if (barang) {
                    const row = `
                        <tr>
                            <td>${barang.id}</td>
                            <td>${barang.nama_barang}</td>
                            <td>${barang.harga_jual}</td>
                            <td>${barang.stok}</td>
                            <td><input type="number" class="qty" value="1" min="1" max="${barang.stok}"></td>
                        </tr>
                    `;
                    barangTable.append(row);
                    total += barang.harga_jual;
                    totalPembayaran.text(total);
                }
            });

            barangTable.on('change', '.qty', function() {
                const qty = $(this).val();
                const hargaJual = $(this).closest('tr').find('td:nth-child(3)').text();
                const subtotal = qty * hargaJual;
                $(this).closest('tr').find('td:nth-child(5)').text(subtotal);
            });

            barangTable.on('click', '.delete', function() {
                const subtotal = $(this).closest('tr').find('td:nth-child(5)').text();
                total -= subtotal;
                totalPembayaran.text(total);
                $(this).closest('tr').remove();
            });

        });
    </script>
@endsection
```