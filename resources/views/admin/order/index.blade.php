@extends('layouts.admin')

@section('title', 'Halaman Order - PT Minamas TC')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Order</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Order</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-list"></i> Data Order
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor Invoice</th>
                            <th>Status</th>
                            <th>Tanggal Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.order.show', $item->id) }}" class="btn btn-success">Detail</a>
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