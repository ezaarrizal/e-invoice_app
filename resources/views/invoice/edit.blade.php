@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Invoice</h2>

    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" value="{{ $invoice->customer_name }}" required>
        </div>

        <div class="mb-3">
            <label for="invoice_date" class="form-label">Invoice Date</label>
            <input type="date" name="invoice_date" class="form-control" value="{{ $invoice->invoice_date }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Jenis Invoice</label>
            <select name="type" id="type" class="form-select" required>
                <option value="HPJ" {{ $invoice->type == 'HPJ' ? 'selected' : '' }}>HPJ (Harga Pokok Jual)</option>
                <option value="HPB" {{ $invoice->type == 'HPB' ? 'selected' : '' }}>HPB (Harga Pokok Beli)</option>
                <option value="HPF" {{ $invoice->type == 'HPF' ? 'selected' : '' }}>HPF (Harga Pokok Fee)</option>
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
            <tbody>
                @foreach ($invoice->items as $index => $invItem)
                    <tr>
                        <td>
                            <select name="items[{{ $index }}][item_id]" class="form-select item-select" required>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}"
                                        data-hpj="{{ $item->hpj }}"
                                        data-hpb="{{ $item->hpb }}"
                                        data-hpf="{{ $item->hpf }}"
                                        {{ $invItem->item_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="items[{{ $index }}][quantity]" class="form-control quantity" min="1" value="{{ $invItem->quantity }}" required></td>
                        <td><input type="number" name="items[{{ $index }}][price]" class="form-control price" readonly value="{{ $invItem->price }}"></td>
                        <td><input type="number" name="items[{{ $index }}][subtotal]" class="form-control subtotal" readonly value="{{ $invItem->subtotal }}"></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="button" id="addRow" class="btn btn-secondary mb-3">+ Tambah Barang</button>

        <div class="mb-3">
            <label for="total" class="form-label fw-bold">Total</label>
            <input type="number" name="total" id="total" class="form-control" value="{{ $invoice->total }}" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Update Invoice</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const tableBody = document.querySelector('#itemsTable tbody');
    let rowIndex = document.querySelectorAll('#itemsTable tbody tr').length;

    const itemsData = @json($items);

    // ✅ Template row baru
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

    // ✅ Hitung subtotal dan total
    function updateSubtotal(row) {
        const qty = parseFloat(row.querySelector('.quantity').value) || 0;
        const price = parseFloat(row.querySelector('.price').value) || 0;
        const subtotal = qty * price;
        row.querySelector('.subtotal').value = subtotal.toFixed(2);
        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(sub => total += parseFloat(sub.value) || 0);
        document.getElementById('total').value = total.toFixed(2);
    }

    // ✅ Update harga sesuai tipe invoice
    function updatePrices() {
        const type = typeSelect.value;
        document.querySelectorAll('.item-select').forEach(select => {
            const option = select.options[select.selectedIndex];
            const row = select.closest('tr');
            if (option && option.value) {
                const price = type === 'HPJ' ? option.dataset.hpj :
                              type === 'HPB' ? option.dataset.hpb :
                              type === 'HPF' ? option.dataset.hpf : 0;
                row.querySelector('.price').value = price;
                updateSubtotal(row);
            }
        });
    }

    // ✅ Event tambah barang
    document.getElementById('addRow').addEventListener('click', function() {
        const newRow = createNewRow();
        tableBody.appendChild(newRow);
        updatePrices(); // agar harga langsung diset
    });

    // ✅ Delegasi event agar tombol X dan select aktif pada elemen baru
    tableBody.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
            updateTotal();
        }
    });

    tableBody.addEventListener('change', function(e) {
        const row = e.target.closest('tr');
        if (e.target.classList.contains('item-select')) {
            const option = e.target.options[e.target.selectedIndex];
            const type = typeSelect.value;
            const price = type === 'HPJ' ? option.dataset.hpj :
                          type === 'HPB' ? option.dataset.hpb :
                          type === 'HPF' ? option.dataset.hpf : 0;
            row.querySelector('.price').value = price;
            updateSubtotal(row);
        }
        if (e.target.classList.contains('quantity')) {
            updateSubtotal(row);
        }
    });

    // ✅ Event ubah tipe invoice
    typeSelect.addEventListener('change', updatePrices);

    // Pastikan total awal dihitung
    updateTotal();
});
</script>

@endsection
