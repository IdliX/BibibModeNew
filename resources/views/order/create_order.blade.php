@extends('layouts.app_modern')

@section('content')
<div class="row">
    <h3>Tambah Order Baru</h3>

    <div id="alert-container"></div>

    <div class="col-md-3">
        <form method="POST" id="orderForm">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Customer</label>
                <input type="text" class="form-control" id="name" name="name" required>
                <div class="invalid-feedback" id="name-error"></div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                <div class="invalid-feedback" id="address-error"></div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">No Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" required 
                    pattern="[0-9]{10,15}" title="Nomor telepon harus 10-15 digit">
                <div class="invalid-feedback" id="phone-error"></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback" id="email-error"></div>
            </div>
            <div class="mb-3">
                <label for="order_date" class="form-label">Tanggal Order</label>
                <input type="date" class="form-control" id="order_date" name="order_date" 
                    value="{{ date('Y-m-d') }}" required>
                <div class="invalid-feedback" id="order_date-error"></div>
            </div>
            <div class="mb-3">
                <label for="pickup_date" class="form-label">Batas Waktu</label>
                <input type="date" class="form-control" id="pickup_date" name="pickup_date" required 
                    min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                <div class="invalid-feedback" id="pickup_date-error"></div>
            </div>
            <div class="mb-3">
                <label for="total_price" class="form-label">Total</label>
                <input type="number" class="form-control" id="total_price" name="total_price" 
                    step="0.01" min="0" readonly>
                <div class="invalid-feedback" id="total_price-error"></div>
            </div>
            <button type="submit" class="btn btn-primary" id="submitBtn">Tambah Order</button>
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
                    <tr>
                        <td><input type="text" name="name[]" class="form-control" required></td>
                        <td><input type="number" step="0.01" name="chest_circumference[]" class="form-control measurement" min="0"></td>
                        <td><input type="number" step="0.01" name="waist_circumference[]" class="form-control measurement" min="0"></td>
                        <td><input type="number" step="0.01" name="hip_circumference[]" class="form-control measurement" min="0"></td>
                        <td><input type="number" step="0.01" name="sleeve_length[]" class="form-control measurement" min="0"></td>
                        <td><input type="number" step="0.01" name="body_length[]" class="form-control measurement" min="0"></td>
                        <td><input type="number" step="0.01" name="shoulder_width[]" class="form-control measurement" min="0"></td>
                        <td><input type="number" step="0.01" name="price[]" class="form-control price-input" min="0" required></td>
                        <td><textarea name="notes[]" class="form-control"></textarea></td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteCustomerRow(this)">Hapus</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-secondary" onclick="addCustomerRow()">Tambah Pelanggan</button>
    </div>
</div>

<script>
    function addCustomerRow() {
        const tbody = document.querySelector('#customer-details-table tbody');
        const firstRow = tbody.querySelector('tr');
        const newRow = firstRow.cloneNode(true);
        
        // Clear all input values in the new row
        newRow.querySelectorAll('input, textarea').forEach(input => {
            input.value = '';
        });
        
        tbody.appendChild(newRow);
        calculateTotal();
    }

    function deleteCustomerRow(button) {
        const tbody = document.querySelector('#customer-details-table tbody');
        if (tbody.querySelectorAll('tr').length > 1) {
            button.closest('tr').remove();
            calculateTotal();
        } else {
            alert('Minimal harus ada satu pelanggan!');
        }
    }

    function calculateTotal() {
        var total = 0;
        var priceInputs = document.querySelectorAll('.price-input');
        priceInputs.forEach(function(input) {
            var value = parseFloat(input.value);
            if (!isNaN(value)) {
                total += value;
            }
        });
        document.getElementById('total_price').value = total.toFixed(2);
    }

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
                return false;
            }

            let hasMeasurement = false;
            measurements.forEach(input => {
                if (input.value) hasMeasurement = true;
            });

            if (!hasMeasurement) {
                valid = false;
                showAlert('error', `Pelanggan #${index + 1}: Minimal satu ukuran harus diisi!`);
                return false;
            }
        });

        return valid;
    }

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

    function clearErrors() {
        document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    }

    function handleErrors(errors) {
        clearErrors();
        Object.keys(errors).forEach(key => {
            const element = document.getElementById(key);
            const errorElement = document.getElementById(key + '-error');
            if (element && errorElement) {
                element.classList.add('is-invalid');
                errorElement.textContent = errors[key][0];
            }
        });
    }

    // Form submission handler
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateForm()) {
            return;
        }

        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';

        // Get all customer rows
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

        // Prepare form data
        const formData = {
            name: document.getElementById('name').value,
            address: document.getElementById('address').value,
            phone: document.getElementById('phone').value,
            email: document.getElementById('email').value,
            order_date: document.getElementById('order_date').value,
            pickup_date: document.getElementById('pickup_date').value,
            total_price: document.getElementById('total_price').value,
            customerdetails: customerDetails,
            _token: document.querySelector('input[name="_token"]').value
        };

        // Send AJAX request
        fetch('{{ route('order.store') }}', {
            method: 'POST',
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
            showAlert('error', 'Terjadi kesalahan saat menyimpan order: ' + (error.message || 'Unknown error'));
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Tambah Order';
        });
    });

    // Set minimum date for pickup_date on load
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        document.getElementById('pickup_date').min = tomorrow.toISOString().split('T')[0];
    });

    // Auto-calculate total when price changes
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('price-input')) {
            calculateTotal();
        }
    });
</script>
@endsection