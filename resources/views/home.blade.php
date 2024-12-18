@extends('layouts.app_modern')

@section('content')

    <h2>Order Dalam Bulan Ini</h2>
    <div class="row">
        <div class="col-xxl-4 col-sm-6">
            <div class="card widget-flat text-bg-pink">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-shopping-basket-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Total Order</h6>
                    <h2 class="my-2">{{ $totalOrders }}</h2>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-4 col-sm-6">
            <div class="card widget-flat text-bg-purple">
                <div class="card-body">
                    <div class="float-end">
                    <i class="ri-shopping-basket-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Total Proses</h6>
                    <h2 class="my-2">{{ $totalProses }}</h2>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-4 col-sm-6">
            <div class="card widget-flat text-bg-info">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-shopping-basket-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Total Selesai</h6>
                    <h2 class="my-2">{{ $totalSelesai }}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        <div class="col-xxl-4 col-sm-6">
            <div class="card widget-flat text-bg-info">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-shopping-basket-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Total Pendapatan</h6>
                    <h2 class="my-2">Rp. {{ number_format($totalPendapatanBulanIni, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div> <!-- end col-->
    </div>

    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Pendapatan Bulanan</h5>
                    <canvas id="revenueChart" width="400px" height="200px"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('revenueChart').getContext('2d');
        var revenueData = @json($revenueData);
        var labels = Object.keys(revenueData);
        var data = Object.values(revenueData);
    
        var revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan Bulanan',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endsection