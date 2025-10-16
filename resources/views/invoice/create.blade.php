@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Buat Invoice Baru</h2>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="invoice_date" class="form-label">Invoice Date</label>
            <input type="date" name="invoice_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Jenis Invoice</label>
            <select name="type" id="type" class="form-select" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="HPJ">HPJ (Harga Pokok Jual)</option>
                <option value="HPB">HPB (Harga Pokok Beli)</option>
                <option value="HPF">HPF (Harga Pokok Fee)</option>
            </select>
        </div>

        <hr>
        <h5>Daftar Barang</h5>

        <table class="table" id="itemsTable">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Kuantitas</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <button type="button" id="addRow" class="btn btn-secondary mb-3">+ Tambah Barang</button>

        <div class="mb-3">
            <label for="total" class="form-label fw-bold">Total</label>
            <input type="number" name="total" id="total" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Invoice</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const tableBody = document.querySelector('#itemsTable tbody');
    const itemsData = @json($items);
    let rowIndex = 0;

    function createNewRow() {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select name="items[${rowIndex}][item_id]" class="form-select item-select" required>
                    <option value="">-- Pilih Barang --</option>
                    ${itemsData.map(item => `
                        <option value="${item.id}"
                            data-hpj="${item.hpj}"
                            data-hpb="${item.hpb}"
                            data-hpf="${item.hpf}">
                            ${item.name}
                        </option>
                    `).join('')}
                </select>
            </td>
            <td><input type="number" name="items[${rowIndex}][quantity]" class="form-control quantity" min="1" value="1" required></td>
            <td><input type="number" name="items[${rowIndex}][price]" class="form-control price" readonly value="0"></td>
            <td><input type="number" name="items[${rowIndex}][subtotal]" class="form-control subtotal" readonly value="0"></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
        `;
        rowIndex++;
        return row;
    }

    function updateSubtotal(row) {
        const qty = parseFloat(row.querySelector('.quantity').value) || 0;
        const price = parseFloat(row.querySelector('.price').value) || 0;
        row.querySelector('.subtotal').value = (qty * price).toFixed(2);
        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(sub => {
            total += parseFloat(sub.value) || 0;
        });
        document.getElementById('total').value = total.toFixed(2);
    }

    function updatePrices() {
        const type = typeSelect.value;
        if (!type) return;

        document.querySelectorAll('.item-select').forEach(select => {
            const row = select.closest('tr');
            const option = select.options[select.selectedIndex];
            if (option && option.value) {
                const price = parseFloat(option.dataset[type.toLowerCase()]) || 0;
                row.querySelector('.price').value = price;
                updateSubtotal(row);
            }
        });
    }

    typeSelect.addEventListener('change', updatePrices);

    tableBody.addEventListener('change', e => {
        const row = e.target.closest('tr');
        if (!row) return;

        if (e.target.classList.contains('item-select')) {
            const type = typeSelect.value;
            if (!type) {
                alert('Silakan pilih jenis invoice terlebih dahulu');
                e.target.value = '';
                return;
            }

            const option = e.target.options[e.target.selectedIndex];
            const price = parseFloat(option.dataset[type.toLowerCase()]) || 0;
            row.querySelector('.price').value = price;
            updateSubtotal(row);
        }

        if (e.target.classList.contains('quantity')) {
            updateSubtotal(row);
        }
    });

    document.getElementById('addRow').addEventListener('click', function() {
        const newRow = createNewRow();
        tableBody.appendChild(newRow);
        updatePrices();
    });

    tableBody.addEventListener('click', e => {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
            updateTotal();
        }
    });

    tableBody.appendChild(createNewRow());
});
</script>
@endsection
