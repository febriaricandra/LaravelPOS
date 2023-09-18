@extends('layouts.admin')
@section('title', 'Halaman Utang - PT Minamas TC')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Utang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Utang</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-list"></i> Data Utang
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nomor Invoice</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Kasir</th>
                                <th>Tanggal Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($utang as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->harga_total }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.utang.show', $item->id) }}"
                                            class="btn btn-success">Detail</a>
                                        <a href="{{ route('admin.utang.edit', $item->id) }}"
                                            class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($utang->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
