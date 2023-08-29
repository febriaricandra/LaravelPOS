@extends('layouts.layout')

@section('title', 'Halaman Barang - PT Minamas TC')

@section('content')
    <main>
        <div class="container-fluid px-4">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                    <span class="d-block">{{ session('success') }}</span>
                </div>
            @endif

            <h1 class="mt-4">Data Barang</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Barang</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-list"></i> Data barang
                </div>
                <div class="card-body">
                    @php
                        $user = Auth::user();
                    @endphp

                    @if ($user->role == 'admin')
                        <a href="{{ route('admin.barang.create') }}" class="btn btn-success mb-3">
                            <i class="fas fa-plus"></i> Tambah barang
                        </a>
                    @else
                        <a href="{{ route('karyawan.barang.create') }}" class="btn btn-success mb-3">
                            <i class="fas fa-plus"></i> Tambah barang
                        </a>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        @if($user->role == 'admin')
                                        <td>{{ $item->harga_beli }}</td>
                                        @else
                                        <td>-</td>
                                        @endif
                                        <td>{{ $item->harga_jual }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>
                                            <a href="" class="btn btn-primary">Edit</a>
                                            <form action="" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @if ($barang->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        @if ($barang->currentPage() !== 1)
                            <a href="{{ $barang->previousPageUrl() }}">Previous</a>
                        @endif
                        <a href="{{ $barang->nextPageUrl() }}">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
