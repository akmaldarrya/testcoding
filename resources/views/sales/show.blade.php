@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Sale Details</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sale Details</h6>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $sale->id }}</p>
            <p><strong>Tanggal Penjualan:</strong> {{ $sale->tanggal_penjualan }}</p>
            <p><strong>Customer:</strong> {{ $sale->customer->name }}</p>
            <p><strong>Jumlah Barang:</strong> {{ $sale->jumlah_barang }}</p>
            <p><strong>Total Harga:</strong> {{ $sale->total_harga }}</p>
        </div>
    </div>
</div>
@endsection
