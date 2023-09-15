@extends('layouts.admin')

@section('title', 'Form Barang - PT Minamas TC')

@section('content')
    @include('sweetalert::alert')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Karyawan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.karyawan.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tambah Karyawan</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-plus"></i> Tambah Karyawan
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.karyawan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="harga jual" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Tambah Karyawan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
