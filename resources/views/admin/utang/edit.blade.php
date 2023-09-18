@extends('layouts.admin')

@section('title', 'Edit Barang - PT Minamas TC')

@section('content')
@include('sweetalert::alert')
<div>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Utang</h1>
        <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('admin.utang.index') }}">Utang</a></li>
            <li class="breadcrumb-item active">Edit Utang</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-plus"></i> Edit Barang
            </div>
            <div class="card-body">
                <form action="{{route('admin.utang.update', $utang->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nomor Invoice</label>
                        <input type="text" class="form-control" id="name" name="nama_utang" value="{{$utang->id}}" disabled>
                        @error('nama_utang')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select name="status" id="" class="form-select">
                            @foreach ($status as $item)
                                <option value="{{$item->id}}">{{$item->status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button onclick="alert('Update Utang')" type="submit" class="btn btn-success">Update Utang</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection