@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Data Barang</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('items.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $item->name) }}"
                           placeholder="Masukkan nama barang"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="hpj" class="form-label">HPJ (Harga Pokok Jual) <span class="text-danger">*</span></label>
                            <input type="number"
                                   name="hpj"
                                   id="hpj"
                                   class="form-control @error('hpj') is-invalid @enderror"
                                   value="{{ old('hpj', $item->hpj) }}"
                                   placeholder="Masukkan HPJ"
                                   min="0"
                                   step="0.01"
                                   required>
                            @error('hpj')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="hpb" class="form-label">HPB (Harga Pokok Beli) <span class="text-danger">*</span></label>
                            <input type="number"
                                   name="hpb"
                                   id="hpb"
                                   class="form-control @error('hpb') is-invalid @enderror"
                                   value="{{ old('hpb', $item->hpb) }}"
                                   placeholder="Masukkan HPB"
                                   min="0"
                                   step="0.01"
                                   required>
                            @error('hpb')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="hpb" class="form-label">HPF (Harga Pokok Fee) <span class="text-danger">*</span></label>
                            <input type="number"
                                   name="hpf"
                                   id="hpf"
                                   class="form-control @error('hpf') is-invalid @enderror"
                                   value="{{ old('hpb', $item->hpf) }}"
                                   placeholder="Masukkan HPF"
                                   min="0"
                                   step="0.01"
                                   required>
                            @error('hpb')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Update Barang
                    </button>
                    <a href="{{ route('items.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
