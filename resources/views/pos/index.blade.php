@extends('layouts.karyawan')

@section('title', 'Point Of Sale - PT Minamas TC')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Point of Sales</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
                <a href="{{ route('karyawan.dashboard.index') }}">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active">Point of Sales</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Point of Sales
            </div>
            <div class="card-body">
                <div class="d-flex flex-column">
                    <div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Recipient's username"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">
                                <i class="fas fa-plus"></i>
                            </span>
                        </div>
                    </div>
                    <div>
                        <table id="datatablesSimple">
                        </table>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="align-items-center">
                            <div class="d-flex flex-row">
                                <p>total pembayaran:</p>
                                <p>Rp 24,000</p>
                            </div>
                            <div class="d-flex flex-row">
                                <p>pembayaran:</p>
                                <span>
                                    <input type="text" class="form-control" placeholder="pembayaran"
                                        aria-label="pembayaran" aria-describedby="basic-addon2">
                                </span>
                            </div>
                            <div class="d-flex flex-row">
                                <p>kembalian:</p>
                                <p>Rp 24,000</p>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Bayar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
