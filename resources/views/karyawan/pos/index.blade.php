@extends('layouts.karyawan')

@section('title', 'Point Of Sale - PT Minamas TC')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Point of Sale</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Point of sale</li>
        </ol>


        <div class="row text-white">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-primary">
                    <div class="card-header">
                        Total
                    </div>
                    <div class="card-body">
                        <h5 id="cartTotal">-</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-primary">
                    <div class="card-header">
                        Jumlah Bayar
                    </div>
                    <div class="card-body">
                        <h5 id="amountPaid">-</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-primary">
                    <div class="card-header">
                        Kembalian
                    </div>
                    <div class="card-body">
                        <h5 id="changeDue">-</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-primary">
                    <div class="card-header">
                        Mode
                    </div>
                    <div class="card-body">
                        <h5 id="">Karyawan</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 p-2">
                <div class="">
                    <form action="/karyawan/pos/search" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchInput" name="search"
                                placeholder="Search...">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barang as $item)
                                    <tr>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->harga_jual }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>
                                            <button class="btn btn-primary add-to-cart"
                                                data-id="{{ $item->id }}">Add</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {{ $barang->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 card p-2">
                <div class="card-header">
                    <i class="fas fa-caret-right"></i> Keranjang
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped" id="cartTable">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="cartBody">
                            <!-- Cart items will be dynamically added here -->
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="number" id="amountPaid" class="form-control mb-2" placeholder="Amount Paid">
                            <button id="checkoutButton" class="btn btn-primary">Bayar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var cart = [];

            $(".add-to-cart").on("click", function() {
                var id = $(this).data("id");
                var existingItem = cart.find(item => item.id === id);

                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    var name = $(this).closest("tr").find("td:eq(0)").text();
                    var price = $(this).closest("tr").find("td:eq(1)").text();
                    cart.push({
                        id: id,
                        name: name,
                        price: price,
                        quantity: 1
                    });
                }

                updateCart();
            });

            function updateCart() {
                $("#cartBody").empty();
                var total = 0;

                cart.forEach(function(item) {
                    var subtotal = item.price * item.quantity;
                    total += subtotal;

                    var row = "<tr>";
                    row += "<td>" + item.name + "</td>";
                    row += "<td>" + item.price + "</td>";
                    row += "<td><input type='number' class='quantity-input' value='" + item.quantity +
                        "' data-id='" + item.id + "'></td>";
                    row += "<td>" + subtotal + "</td>";
                    row += "<td><button class='btn btn-danger remove-from-cart' data-id='" + item.id +
                        "'>Delete</button></td>";
                    row += "</tr>";

                    $("#cartBody").append(row);
                });

                $("#cartTotal").text(total);
            }

            $(document).on("click", ".remove-from-cart", function() {
                var id = $(this).data("id");
                var index = cart.findIndex(item => item.id === id);

                if (index !== -1) {
                    cart.splice(index, 1);
                    updateCart();
                }
            });

            $(document).on("change", ".quantity-input", function() {
                var id = $(this).data("id");
                var quantity = parseInt($(this).val());

                var item = cart.find(item => item.id === id);
                if (item) {
                    item.quantity = quantity;
                    updateCart();
                }
            });

            $("#checkoutButton").on("click", function() {
                var amountPaid = parseFloat($("#amountPaid").val());
                // Perform checkout logic here
            });
        });
    </script>
@endsection
