@extends('layouts.karyawan')

@section('title', 'Form Barang - PT Minamas TC')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Barang</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('karyawan.barang.index') }}">Barang</a></li>
                <li class="breadcrumb-item active">Tambah Barang</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-plus"></i> Tambah Barang
                </div>
                <div class="card-body">
                    <form action="{{ route('karyawan.barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="name" name="nama_barang" required>
                            @error('nama_barang')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga jual" class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" id="harga jual" name="harga_jual" required>
                            @error('harga_jual')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" required>
                            @error('stok')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="editor" name="keterangan"> </textarea>
                            @error('keterangan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Tambah Barang</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
