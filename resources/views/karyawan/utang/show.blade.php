@extends('layouts.karyawan')

@section('title', 'Halaman Detail Order - PT Gajah Mungkur')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Utang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('karyawan.utang.index') }}">Utang</a></li>
            <li class="breadcrumb-item active">Detail Utang</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-list"></i> Detail Utang
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nomor Invoice</th>
                                <th>Nama Barang</th>
                                <th>Harga Jual</th>
                                <th>Jumlah</th>
                                <th>subtotal</th>
                                <th>Tanggal Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($utang as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->harga_jual }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->subtotal }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
