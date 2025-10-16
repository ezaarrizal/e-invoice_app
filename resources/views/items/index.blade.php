@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fw-bold text-2xl">Daftar Barang</h2>
        <a href="{{ route('items.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Barang
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
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
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>Nama Barang</th>
                            <th class="text-end" style="width: 140px;">HPJ</th>
                            <th class="text-end" style="width: 140px;">HPB</th>
                            <th class="text-end" style="width: 140px;">HPF</th>
                            <th class="text-center" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $index => $item)
                            <tr>
                                <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $item->name }}</td>
                                <td class="text-end">
                                    <span class="">Rp {{ number_format($item->hpj, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-end">
                                    <span class="">Rp {{ number_format($item->hpb, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-end">
                                    <span class="">Rp {{ number_format($item->hpf, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('items.edit', $item->id) }}"
                                           class="btn btn-sm btn-warning"
                                           title="Edit Barang">
                                            Edit
                                        </a>
                                    </div>
                                    <form action="{{ route('items.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline ms-1"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Hapus Barang">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Belum ada data barang. Silakan tambah barang baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination (jika ada) -->
    @if(method_exists($items, 'links'))
        <div class="mt-4">
            {{ $items->links() }}
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

    .badge {
        font-weight: 600;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }
</style>
@endsection
