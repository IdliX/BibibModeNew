@extends('layouts.app_modern')

@section('content')
<div class="row">
    <h3>Data Order</h3>
    
    <!-- Search Form -->
    <div class="col-md-2"> <!-- Adjust the column size as needed -->
        <form method="GET" action="{{ route('order.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search orders..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>

    <table id="scroll-horizontal-datatable" class="table table-striped w-100 nowrap">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Kode Tracking</th>
                <th>Tanggal Order</th>
                <th>Batas Waktu</th>
                <th>Status</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data['orders'] as $order)
            <tr>
                <td>{{ $order->name }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->tracking_number }}</td>
                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($order->pickup_schedule)->format('Y-m-d') }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ number_format($order->total_price, 2) }}</td>
                <td>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $order->order_id }}">
                        Detail
                    </button>
                    <a href="{{ route('order.edit', $order->order_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('order.destroy', $order->order_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Hapus</button>
                    </form>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop{{ $order->order_id }}" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Detail Order</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nama Customer:</strong> {{ $order->name }}</p>
                                    <p><strong>Alamat:</strong> {{ $order->address }}</p>
                                    <p><strong>No Telepon:</strong> {{ $order->phone }}</p>
                                    <p><strong>Email :</strong> {{ $order->email }}</p>
                                    <p><strong>Tanggal Order:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</p>
                                    <p><strong>Batas Waktu:</strong> {{ \Carbon\Carbon::parse($order->pickup_schedule)->format('Y-m-d') }}</p>
                                    <p><strong>Total:</strong> {{ number_format($order->total_price, 2) }}</p>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Lingkar Dada</th>
                                                    <th>Lingkar Pinggang</th>
                                                    <th>Lingkar Pinggul</th>
                                                    <th>Panjang Lengan</th>
                                                    <th>Panjang Badan</th>
                                                    <th>Lebar Bahu</th>
                                                    <th>Harga</th>
                                                    <th>Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->customerDetails as $detail)
                                                    <tr>
                                                        <td>{{ $detail->nama }}</td>
                                                        <td>{{ $detail->lingkar_dada }}</td>
                                                        <td>{{ $detail->lingkar_pinggang }}</td>
                                                        <td>{{ $detail->lingkar_pinggul }}</td>
                                                        <td>{{ $detail->panjang_lengan }}</td>
                                                        <td>{{ $detail->panjang_badan }}</td>
                                                        <td>{{ $detail->lebar_bahu }}</td>
                                                        <td>{{ $detail->harga }}</td>
                                                        <td>{{ $detail->catatan }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Understood</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $data['orders']->appends(request()->query())->links() }}
    </div>
</div>
@endsection