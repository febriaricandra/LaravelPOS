@extends('layouts.karyawan')

@section('title', 'Point Of Sale - PT Minamas TC')

@section('content')
    @include('sweetalert::alert')

    @if (session('Success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container-fluid px-4">
        <h1 class="mt-4">Point of Sale</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Point of sale</li>
        </ol>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Whoops!</strong> There were some problems with your input.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


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
                        Order
                    </div>
                    <form class="" id="formOrder" action="{{ route('karyawan.pos.checkout') }}" method="POST">
                        @csrf
                        <input class="d-none" name="harga_total" id="total">
                        <input class="d-none" name="bayar" id="bayar">
                        <input class="d-none" name="kembalian" id="kembalian">
                        <input class="d-none" name="submitOrder" id="submitOrder">
                        <input class="d-none" name="status" id="inputStatus">
                        <button class="card-body btn bg-primary w-100" id="order">
                            <h5>Bayar</h5>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row my-4">
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
                                        <td colspan="4" class="text-center">
                                            <a href="{{ route('karyawan.pos.index') }}"
                                            class="btn">Data tidak ditemukan</a>
                                        </td>
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
                            <input type="number" id="amount" class="form-control mb-2" placeholder="Amount Paid">
                            <select class="custom-select-sm form-control my-2" id="status" name="status">
                                <option class="" id="status" value="">Pilih status</option>
                                @foreach ($status as $item)
                                    <option class="" id="status" value="{{ $item->id }}">{{ $item->status }}
                                    </option>
                                @endforEach
                            </select>
                            <button id="checkoutButton" class="btn btn-primary">Checkout</button>
                            <button id="clearButton" class="btn btn-danger">Clear</button>
                            <button id="printReceipt" class="btn btn-success">Receipt</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var cart = JSON.parse(localStorage.getItem("cart")) || [];

            //open print dialog
            $("#printReceipt").click(function() {
                updateCart();
                //create receipt template 
            var receipt = "<div class='text-center'>";
            receipt += "<h3>Receipt</h3>";
            receipt += "<h5>PT. Sumber Langgeng Sejahtera</h5>";
            receipt += "<p>Jl. Raya Cikarang - Cibarusah No. 27, Cikarang Selatan, Bekasi</p>";
            receipt += "<p>Phone: 021-897-1234</p>";
            receipt += "<p>Date: " + new Date().toLocaleDateString() + "</p>";
            receipt += "<p>==========================================</p>";
            receipt += "<table class='table table-striped'>";
            receipt += "<thead>";
            receipt += "<tr>";
            receipt += "<th>Item</th>";
            receipt += "<th>Qty</th>";
            receipt += "<th>Price</th>";
            receipt += "<th>Subtotal</th>";
            receipt += "</tr>";
            receipt += "</thead>";
            receipt += "<tbody>";
            cart.forEach(function(item) {
                receipt += "<tr>";
                receipt += "<td>" + item.name + "</td>";
                receipt += "<td>" + item.quantity + "</td>";
                receipt += "<td>" + formatRupiah(item.price) + "</td>";
                receipt += "<td>" + formatRupiah(item.price * item.quantity) + "</td>";
                receipt += "</tr>";
            });
            receipt += "</tbody>";
            receipt += "</table>";
            receipt += "<p>==========================================</p>";
            receipt += "<h5>Total: " + formatRupiah(localStorage.getItem("cartTotal")) + "</h5>";
            receipt += "<h5>Amount Paid: " + $("#amount").val() + "</h5>";
            receipt += "<h5>Kembalian: " + formatRupiah($("#amount").val() - localStorage.getItem("cartTotal")) +
                "</h5>";
            receipt += "<p>==========================================</p>";
            receipt += "<p>Thank you for shopping with us!</p>";
            receipt += "</div>";
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = receipt;
                window.print();
                document.body.innerHTML = originalContents;
                location.reload();
            });

            function updateCart() {
                $("#cartBody").empty();
                var total = 0;

                cart.forEach(function(item) {
                    var subtotal = item.price * item.quantity;
                    total += subtotal;
                    localStorage.setItem("cartTotal", total);

                    var row = "<tr>";
                    row += "<td>" + item.name + "</td>";
                    row += "<td>" + formatRupiah(item.price) + "</td>";
                    row += "<td><input type='number' class='quantity-input' value='" + item.quantity +
                        "' data-id='" + item.id + "' min='1' max='" + item.stok + "'></td>";
                    row += "<td>" + formatRupiah(subtotal) + "</td>";
                    row += "<td><button class='btn btn-danger remove-from-cart' data-id='" + item.id +
                        "'>Delete</button></td>";
                    row += "</tr>";


                    $("#cartBody").append(row);
                });

                if (cart.length == 0) {
                    $("#cartBody").append("<tr><td colspan='5' class='text-center'>Tidak ada data</td></tr>");
                    localStorage.setItem("cartTotal", 0);
                    //update amount and change to 0
                    $("#amountPaid").text(formatRupiah(0));
                    $("#changeDue").text(formatRupiah(0));
                    $("#kembalian").val(0);
                    $("#bayar").val(0);
                    $("#checkoutButton").prop("disabled", true);
                    $("#order").prop("disabled", true);
                } else {
                    $("#checkoutButton").prop("disabled", false);
                    $("#order").prop("disabled", false);
                }
                //update total
                $("#cartTotal").text(formatRupiah(localStorage.getItem("cartTotal")));
                $("#total").val(localStorage.getItem("cartTotal"));
                $("#changeDue").text(formatRupiah(localStorage.getItem("kembalian")));
                $("#amountPaid").text(formatRupiah(localStorage.getItem("bayar")));
                $("#bayar").val(localStorage.getItem("bayar"));
                $("#kembalian").val(localStorage.getItem("kembalian"));
                $("#submitOrder").val(JSON.stringify(cart));
            }

            function formatRupiah(angka) {
                var numberString = angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return "Rp " + numberString;
            }


            $(".add-to-cart").on("click", function() {
                var id = $(this).data("id");
                var existingItem = cart.find(item => item.id === id);

                if (existingItem) {
                    existingItem.quantity++;
                    existingItem.subtotal = existingItem.price * existingItem.quantity;
                    if(existingItem.quantity > existingItem.stok){
                        alert("Stok tidak mencukupi");
                        existingItem.quantity--;
                        existingItem.subtotal = existingItem.price * existingItem.quantity;
                    }
                } else {
                    var name = $(this).closest("tr").find("td:eq(0)").text();
                    var price = parseFloat($(this).closest("tr").find("td:eq(1)").text().replace(
                        /[^0-9.-]+/g, ""));
                    var stok = parseInt($(this).closest("tr").find("td:eq(2)").text());
                    cart.push({
                        id: id,
                        name: name,
                        price: price,
                        stok: stok,
                        quantity: 1,
                        subtotal: price
                    });
                }
                localStorage.setItem("cart", JSON.stringify(cart));
                updateCart();
            });
            $(document).on("click", ".remove-from-cart", function() {
                var id = $(this).data("id");
                var index = cart.findIndex(item => item.id === id);
                if (index !== -1) {
                    //delete cart from array
                    cart.splice(index, 1);
                    localStorage.setItem("cart", JSON.stringify(cart));
                    updateCart();
                    localStorage.setItem("cartTotal", 0);
                    localStorage.setItem("bayar", 0);
                    localStorage.setItem("kembalian", 0);
                }
            });

            $(document).on("change", ".quantity-input", function() {
                var id = $(this).data("id");
                var quantity = parseInt($(this).val());

                var item = cart.find(item => item.id === id);
                if (item) {
                    if (quantity <= 0) {
                        var index = cart.findIndex(item => item.id === id);
                        if (index !== -1) {
                            cart.splice(index, 1);
                        }
                    } else if (quantity <= item.stok) {
                        item.quantity = quantity;
                        item.subtotal = item.price * item.quantity;
                    }
                    updateCart();
                    localStorage.setItem("cart", JSON.stringify(cart));
                }
            });

            //calculate change when #amount submit
            $(document).on("click", "#checkoutButton", function() {
                var amount = parseFloat($("#amount").val().replace(/[^0-9.-]+/g, ""));
                var total = localStorage.getItem("cartTotal");
                var change = amount - total;
                if (cart.length > 0) {
                    if (amount < total) {
                        alert("Uang tidak cukup");
                    } else {
                        console.log(change);
                        var amountPaid = localStorage.setItem("bayar", amount);
                        var changeDue = localStorage.setItem("kembalian", change);
                        $("#changeDue").text(formatRupiah(localStorage.getItem("kembalian")));
                        $("#amountPaid").text(formatRupiah(localStorage.getItem("bayar")));
                        $("#bayar").val(amount);
                        $("#kembalian").val(change);
                        $("#submitOrder").val(JSON.stringify(cart));
                    }
                } else {
                    alert("Keranjang kosong");
                }
                //if input amount is empty
                if (isNaN(amount)) {
                    $("#changeDue").text(0);
                    $("#amountPaid").text(0);
                    $("#bayar").val(null);
                    $("#kembalian").val(null);
                    $("#submitOrder").val(null);
                }
            });

            $(document).on("click", "#clearButton", function() {
                localStorage.removeItem("cart");
                localStorage.removeItem("cartTotal");
                localStorage.removeItem("bayar");
                localStorage.removeItem("kembalian");
                cart = [];
                $("#submitOrder").val(null);
                updateCart();
            })

            //if status selected, then fill value of inputStatus
            $(document).on("change", "#status", function() {
                var status = $(this).val();
                $("#inputStatus").val(status);
            });

            // Initialize the cart on page load
            updateCart();
        });
    </script>
@endsection
