@extends('layouts.admin')


@section('title', 'Halaman Utama - PT Gajah Mungkur')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-header">
                        <h5>Total Pendapatan</h5>
                    </div>
                    <div class="card-body">
                        <h5 id="revenue">{{ $revenue }}</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('admin.order.index')}}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-header">
                        <h5>Total Barang</h5>
                    </div>
                    <div class="card-body">
                        <h5>{{ $barang }}</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('admin.barang.index')}}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-header">
                        <h5>Karyawan</h5>
                    </div>
                    <div class="card-body">
                        <h5>{{ $karyawan }}</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('admin.karyawan.index')}}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-header">
                        <h5>Utang</h5>
                    </div>
                    <div class="card-body">
                        <h5>{{ $utang }}</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('admin.utang.index')}}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Diagram Garis
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Diagram Batang
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Pendapatan
            </div>
            <div class="card-body">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px">
                    <thead>
                        <tr>
                            <th>Total Order</th>
                            <th>Bulan</th>
                            <th>Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($revenuePerMonth as $item)
                            <tr>
                                <td>{{ $item->orders }}</td>
                                <td>{{ __('months.' . $item->month) }} {{ $item->year }}</td>
                                <td id="pendapatan">{{ $item->revenue }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        var dataset = @json($revenuePerMonth);
        var ctx = document.getElementById('myAreaChart').getContext('2d');
        var data = {
            labels: [], // Label bulan atau tahun
            datasets: [{
                label: 'Pendapatan',
                data: [], // Data pendapatan
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna area di bawah garis
                borderColor: 'rgba(75, 192, 192, 1)', // Warna garis
                borderWidth: 1 // Lebar garis
            }]
        };

        var dataBar = {
            labels: [], // label bulan atau tahun
            datasets: [{
                label: 'Jumlah Order',
                data: [], // Data pendapatan
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna area di bawah garis
                borderColor: 'rgba(75, 192, 192, 1)', // Warna garis
                borderWidth: 1 // Lebar garis
            }]
        }

        dataset.forEach(function(item) {
            data.labels.push(item.month + ' / ' + item.year);
            data.datasets[0].data.push(item.revenue);
            data.datasets[0].data.reverse();
            data.labels.reverse();
        });

        dataset.forEach(function(item) {
            dataBar.labels.push(item.month + ' / ' + item.year);
            dataBar.datasets[0].data.push(item.orders);
            dataBar.datasets[0].data.reverse();
            dataBar.labels.reverse();
        });

        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        var myBarChart = new Chart(document.getElementById('myBarChart').getContext('2d'), {
            type: 'bar',
            data: dataBar,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        var pendapatan = document.querySelectorAll('#pendapatan');
        var revenue = document.querySelectorAll('#revenue');
        pendapatan.forEach(function(item) {
            item.textContent = 'Rp. ' + item.textContent.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
        revenue.forEach(function(item) {
            item.textContent = 'Rp. ' + item.textContent.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    </script>
@endsection
