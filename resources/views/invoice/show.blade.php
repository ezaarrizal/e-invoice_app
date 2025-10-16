@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 fw-bold">Detail Invoice #{{ $invoice->invoice_number }}</h2>
            <p class="text-muted mb-0">Informasi lengkap invoice</p>
        </div>
        <div>
            <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <a href="{{ route('invoices.download', $invoice->id) }}" class="btn btn-danger">
                <i class="bi bi-file-pdf me-1"></i> Download PDF
            </a>
        </div>
    </div>

    <!-- Invoice Info Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Invoice</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="text-muted small mb-1">Customer</label>
                    <p class="mb-0 fw-semibold fs-5">{{ $invoice->customer_name }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="text-muted small mb-1">Tanggal Invoice</label>
                    <p class="mb-0 fw-semibold">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="text-muted small mb-1">Jenis Invoice</label>
                    <p class="mb-0">
                        <span class="badge fs-6
                            @if($invoice->type == 'HPJ') bg-info
                            @elseif($invoice->type == 'HPF') bg-success
                            @elseif($invoice->type == 'HPB') bg-warning text-dark
                            @else bg-secondary
                            @endif">
                            {{ $invoice->type }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Items Table Card -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i>Daftar Barang</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;" class="text-center">No</th>
                            <th>Nama Barang</th>
                            <th class="text-center" style="width: 120px;">Kuantitas</th>
                            <th class="text-end" style="width: 180px;">Harga Satuan</th>
                            <th class="text-end" style="width: 200px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoice->items as $index => $item)
                            <tr>
                                <td class="text-center text-muted">{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $item->item->name }}</td>
                                <td class="text-center">
                                    <span class="badge bg-secondary">{{ $item->quantity }}</span>
                                </td>
                                <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="text-end fw-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Tidak ada item dalam invoice ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="table-light border-top-2">
                        <tr>
                            <td colspan="4" class="text-end fw-bold fs-5 py-3">Total:</td>
                            <td class="text-end fw-bold fs-5 text-primary py-3">
                                Rp {{ number_format($invoice->total, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Action Buttons (Mobile Friendly) -->
    <div class="d-flex flex-column flex-sm-row gap-2 mt-4 d-sm-none">
        <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary flex-fill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
        <a href="{{ route('invoices.download', $invoice->id) }}" class="btn btn-danger flex-fill">
            <i class="bi bi-file-pdf me-1"></i> Download PDF
        </a>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .card-header {
        border-bottom: 2px solid rgba(0, 0, 0, 0.1);
        padding: 1rem 1.5rem;
    }

    .table th {
        font-weight: 600;
        font-size: 0.875rem;
        letter-spacing: 0.5px;
        padding: 1rem 0.75rem;
    }

    .table td {
        padding: 1rem 0.75rem;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .border-top-2 {
        border-top-width: 2px !important;
    }

    label.small {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
</style>
@endsection
