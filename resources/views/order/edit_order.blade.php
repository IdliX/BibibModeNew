@extends('layouts.app_modern')

@section('content')
<div class="row">
    <h3>Edit Order</h3>

    <div id="alert-container"></div>

    <div class="col-md-3">
        <form method="POST" id="orderForm" action="{{ route('order.update', ['order' => $order->order_id]) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Customer</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $order->name }}" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" id="address" name="address" rows="3" required>{{ $order->address }}</textarea>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">No Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $order->phone }}" required pattern="[0-9]{10,15}" title="Nomor telepon harus 10-15 digit">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $order->email }}" required>
            </div>
            <div class="mb-3">
                <label for="order_date" class="form-label">Tanggal Order</label>
                <input type="date" class="form-control" id="order_date" name="order_date" value="{{ $order->order_date->format('Y-m-d') }}" required>
            </div>
            <div class="mb-3">
                <label for="pickup_schedule" class="form-label">Batas Waktu</label>
                <input type="date" class="form-control" id="pickup_schedule" name="pickup_schedule" value="{{ $order->pickup_schedule->format('Y-m-d') }}" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status-client" name="status" required>
                    <option value="PESANAN_DITERIMA" {{ $order->status == 'PESANAN_DITERIMA' ? 'selected' : '' }}>Pesanan Diterima</option>
                    <option value="POLA_DIBUAT" {{ $order->status == 'POLA_DIBUAT' ? 'selected' : '' }}>Pola Dibuat</option>
                    <option value="PROSES_POTONG" {{ $order->status == 'PROSES_POTONG' ? 'selected' : '' }}>Proses Potong</option>
                    <option value="PROSES_JAHIT" {{ $order->status == 'PROSES_JAHIT' ? 'selected' : '' }}>Proses Jahit</option>
                    <option value="QUALITY_CONTROL" {{ $order->status == 'QUALITY_CONTROL' ? 'selected' : '' }}>Quality Control</option>
                    <option value="SELESAI" {{ $order->status == 'SELESAI' ? 'selected' : '' }}>Selesai</option>
                    <option value="SIAP_DIAMBIL" {{ $order->status == 'SIAP_DIAMBIL' ? 'selected' : '' }}>Siap Diambil</option>
                    </select>
            </div>
            <div class="mb-3">
                <label for="total_price" class="form-label">Total</label>
                <input type="number" class="form-control" id="total_price" name="total_price" 
                    step="0.01" min="0" readonly value="{{ $order->total_price }}">
                <div class="invalid-feedback" id="total_price-error"></div>
            </div>
            <button type="submit" class="btn btn-primary" id="submitBtn">Simpan Perubahan</button>
        </form>
    </div>

    <div class="col-md-9">
        <h4>Detail Ukuran Pelanggan</h4>
        <div class="table-responsive">
            <table class="table table-bordered" id="customer-details-table">
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($order->customerDetails as $detail)
                    <tr>
                        <td><input type="text" name="name[]" class="form-control" value="{{ $detail->nama }}" required></td>
                        <td><input type="number" step="0.01" name="chest_circumference[]" class="form-control measurement" value="{{ $detail->lingkar_dada }}" min="0"></td>
                        <td><input type="number" step="0.01" name="waist_circumference[]" class="form-control measurement" value="{{ $detail->lingkar_pinggang }}" min="0"></td>
                        <td><input type="number" step="0.01" name="hip_circumference[]" class="form-control measurement" value="{{ $detail->lingkar_pinggul }}" min="0"></td>
                        <td><input type="number" step="0.01" name="sleeve_length[]" class="form-control measurement" value="{{ $detail->panjang_lengan }}" min="0"></td>
                        <td><input type="number" step="0.01" name="body_length[]" class="form-control measurement" value="{{ $detail->panjang_badan }}" min="0"></td>
                        <td><input type="number" step="0.01" name="shoulder_width[]" class="form-control measurement" value="{{ $detail->lebar_bahu }}" min="0"></td>
                        <td><input type="number" step="0.01" name="price[]" class="form-control price-input" value="{{ $detail->harga }}" min="0" required></td>
                        <td><textarea name="notes[]" class="form-control">{{ $detail->catatan }}</textarea></td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteCustomerRow(this)">Hapus</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-secondary" onclick="addCustomerRow()">Tambah Pelanggan</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk menambahkan baris pelanggan baru
    function addCustomerRow() {
        const tbody = document.querySelector('#customer-details-table tbody');
        const firstRow = tbody.querySelector('tr');
        if (!firstRow) return;

        const newRow = firstRow.cloneNode(true);

        // Bersihkan semua nilai input di baris baru
        newRow.querySelectorAll('input, textarea').forEach(input => {
            input.value = '';
        });

        tbody.appendChild(newRow);
        calculateTotal();
    }

    // Fungsi untuk menghapus baris pelanggan
    function deleteCustomerRow(button) {
        const tbody = document.querySelector('#customer-details-table tbody');
        const rows = tbody.querySelectorAll('tr');
        if (rows.length > 1) {
            button.closest('tr').remove();
            calculateTotal();
        } else {
            alert('Minimal harus ada satu pelanggan!');
        }
    }

    // Fungsi untuk menghitung total harga
    function calculateTotal() {
        let total = 0;
        const priceInputs = document.querySelectorAll('.price-input');
        priceInputs.forEach(input => {
            const value = parseFloat(input.value);
            if (!isNaN(value)) {
                total += value;
            }
        });

        const totalPriceInput = document.getElementById('total_price');
        if (totalPriceInput) {
            totalPriceInput.value = total.toFixed(2);
        }
    }

    // Fungsi untuk memvalidasi formulir sebelum pengiriman
    function validateForm() {
        const tbody = document.querySelector('#customer-details-table tbody');
        const rows = tbody.querySelectorAll('tr');
        let valid = true;

        rows.forEach((row, index) => {
            const name = row.querySelector('input[name="name[]"]').value;
            const price = row.querySelector('input[name="price[]"]').value;
            const measurements = row.querySelectorAll('.measurement');

            if (!name || !price) {
                valid = false;
                showAlert('error', `Pelanggan #${index + 1}: Nama dan Harga harus diisi!`);
                return;
            }

            let hasMeasurement = false;
            measurements.forEach(input => {
                if (input.value.trim()) {
                    hasMeasurement = true;
                }
            });

            if (!hasMeasurement) {
                valid = false;
                showAlert('error', `Pelanggan #${index + 1}: Minimal satu ukuran harus diisi!`);
                return;
            }
        });

        return valid;
    }

    // Fungsi untuk menampilkan pesan alert
    function showAlert(type, message) {
        const alertContainer = document.getElementById('alert-container');
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        alertContainer.innerHTML = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
    }

    // Fungsi untuk membersihkan error
    function clearErrors() {
        document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    }

    // Fungsi untuk menangani error
    function handleErrors(errors) {
        clearErrors();
        Object.keys(errors).forEach(key => {
            const element = document.getElementById(key);
            const errorElement = document.getElementById(`${key}-error`);
            if (element && errorElement) {
                element.classList.add('is-invalid');
                errorElement.textContent = errors[key][0];
            }
        });
    }

    // Handler pengiriman formulir
    document.getElementById('orderForm').addEventListener('submit', function (e) {
        e.preventDefault();

        if (!validateForm()) {
            return;
        }

        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';

        // Ambil semua data pelanggan
        const customerDetails = [];
        document.querySelectorAll('#customer-details-table tbody tr').forEach(row => {
            customerDetails.push({
                name: row.querySelector('input[name="name[]"]').value,
                chest_circumference: row.querySelector('input[name="chest_circumference[]"]').value,
                waist_circumference: row.querySelector('input[name="waist_circumference[]"]').value,
                hip_circumference: row.querySelector('input[name="hip_circumference[]"]').value,
                sleeve_length: row.querySelector('input[name="sleeve_length[]"]').value,
                body_length: row.querySelector('input[name="body_length[]"]').value,
                shoulder_width: row.querySelector('input[name="shoulder_width[]"]').value,
                price: row.querySelector('input[name="price[]"]').value,
                notes: row.querySelector('textarea[name="notes[]"]').value
            });
        });

        // Siapkan data untuk dikirim
        const formData = {
            name: document.getElementById('name')?.value,
            address: document.getElementById('address')?.value,
            phone: document.getElementById('phone')?.value,
            email: document.getElementById('email')?.value,
            order_date: document.getElementById('order_date')?.value,
            pickup_schedule: document.getElementById('pickup_schedule')?.value,
            status: document.getElementById('status-client')?.value,
            total_price: document.getElementById('total_price')?.value,
            customerdetails: customerDetails,
            _token: document.querySelector('input[name="_token"]').value
        };

        // Kirim permintaan AJAX
        fetch(`{{ route('order.update', ['order' => $order->order_id]) }}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(formData)
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(json => Promise.reject(json));
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                } else {
                    if (data.errors) {
                        handleErrors(data.errors);
                    }
                    showAlert('error', data.message || 'Terjadi kesalahan saat menyimpan order.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', `Terjadi kesalahan: ${error.message || 'Unknown error'}`);
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Simpan Perubahan';
            });
    });

    // Atur minimum tanggal untuk pickup_schedule
    const pickupInput = document.getElementById('pickup_schedule');
    if (pickupInput) {
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        pickupInput.min = tomorrow.toISOString().split('T')[0];
    }

    // Perbarui total harga secara otomatis ketika input harga berubah
    document.addEventListener('input', function (e) {
        if (e.target.classList.contains('price-input')) {
            calculateTotal();
        }
    });

    // Tambahkan event listener untuk tombol tambah pelanggan
    document.querySelector('button.btn-secondary').addEventListener('click', addCustomerRow);
});
</script>
@endsection