@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold text-2xl">Daftar Invoice</h2>
        <a href="{{ route('invoices.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Buat Invoice Baru
        </a>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Table Card -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" style="width: 60px;">Nomor Invoice</th>
                            <th>Customer Name</th>
                            <th style="width: 140px;">Tanggal Invoice</th>
                            <th class="text-center" style="width: 80px;">Jenis</th>
                            <th class="text-end" style="width: 150px;">Total</th>
                            <th class="text-center" style="width: 280px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices as $invoice)
                            <tr>
                                <td class="text-center fw-semibold">{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->customer_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</td>
                                <td class="text-center">
                                    <span class="badge
                                        @if($invoice->type == 'HPJ') bg-info
                                        @elseif($invoice->type == 'HPF') bg-success
                                        @elseif($invoice->type == 'HPB') bg-warning text-dark
                                        @else bg-secondary
                                        @endif">
                                        {{ $invoice->type }}
                                    </span>
                                </td>
                                <td class="text-end fw-semibold">Rp {{ number_format($invoice->total, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('invoices.show', $invoice->id) }}"
                                           class="btn btn-sm btn-info"
                                           title="Lihat Detail">
                                            Lihat
                                        </a>
                                        <a href="{{ route('invoices.edit', $invoice->id) }}"
                                           class="btn btn-sm btn-warning"
                                           title="Edit Invoice">
                                            Edit
                                        </a>
                                    </div>
                                    <form action="{{ route('invoices.destroy', $invoice->id) }}"
                                          method="POST"
                                          class="d-inline ms-1"
                                          onsubmit="return confirm('Yakin ingin menghapus invoice ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Hapus Invoice">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Belum ada data invoice
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination (jika ada) -->
    @if(method_exists($invoices, 'links'))
        <div class="mt-4">
            {{ $invoices->links() }}
        </div>
    @endif
</div>

<style>
    .table th {
        font-weight: 600;
        font-size: 0.875rem;
        letter-spacing: 0.5px;
        padding: 1rem 0.75rem;
    }

    .table td {
        padding: 0.875rem 0.75rem;
        vertical-align: middle;
    }

    .btn-group .btn {
        border-radius: 0;
    }

    .btn-group .btn:first-child {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }

    .btn-group .btn:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }

    .card {
        border: none;
        border-radius: 0.5rem;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
</style>
@endsection
