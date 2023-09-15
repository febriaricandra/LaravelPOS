@extends('layouts.admin')

@section('title', 'Halaman Karyawan - PT Minamas TC')

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
        <h1 class="mt-4">Data Karyawan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Karyawan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-list"></i> Karyawan
            </div>
            <div class="card-body">
                <a href="{{ route('admin.karyawan.create') }}" class="btn btn-success mb-3">
                    <i class="fas fa-plus"></i> Tambah Karyawan
                </a>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawan as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>
                                        <form action="{{ route('admin.karyawan.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
