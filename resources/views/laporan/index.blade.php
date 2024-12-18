@extends('layouts.app_modern')

@section('content')

<form action="{{ route('laporan.cetak') }}" method="GET">
    <div class="col-md-3">
        <h4>Laporan Penjualan</h4>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="start_date">Dari Tanggal:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mt-3">
        <label for="end_date">Sampai Tanggal:</label>
        <input type="date" name="end_date" id="end_date" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Cetak Laporan</button>
</form>


@endsection