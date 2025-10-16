@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Barang Baru</h2>

    <form action="{{ route('items.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Item Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama Barang" required>
        </div>

        <div class="mb-3">
            <label for="hpj" class="form-label">HPJ (Harga Pokok Jual)</label>
            <input type="number" name="hpj" id="hpj" class="form-control" placeholder="Masukkan HPJ" required>
        </div>

        <div class="mb-3">
            <label for="hpb" class="form-label">HPB (Harga Pokok Beli)</label>
            <input type="number" name="hpb" id="hpb" class="form-control" placeholder="Masukkan HPB" required>
        </div>

        <div class="mb-3">
            <label for="hpb" class="form-label">HPF (Harga Pokok Fee)</label>
            <input type="number" name="hpf" id="hpf" class="form-control" placeholder="Masukkan HPF" required>
        </div>

        <button type="submit" class="btn btn-success">Save Item</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
