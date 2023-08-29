@extends('layouts.admin')

@section('title', 'Halaman Barang - PT Minamas TC')

@section('content')
    <div class="container-fluid px-4">

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                <span class="d-block">{{ session('status') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                <span class="d-block">{{ session('error') }}</span>
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
                <a href="{{ route('admin.barang.create') }}" class="btn btn-success mb-3">
                    <i class="fas fa-plus"></i> Tambah barang
                </a>
                <form action="/admin/barang/search" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" name="search" placeholder="Search...">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                
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
                                    <td>{{ $item->harga_beli }}</td>
                                    <td>{{ $item->harga_jual }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <a href="{{route('admin.barang.edit', $item->id)}}" class="btn btn-primary">Edit</a>
                                        <form action="{{route('admin.barang.destroy', $item->id)}}" method="POST" style="display: inline-block;">
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

                    {{ $barang->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
