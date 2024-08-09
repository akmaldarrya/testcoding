@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Sales</h1>
    <p class="mb-4">Daftar penjualan yang terdaftar di sistem.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <a href="{{ route('sales.create') }}" class="btn btn-primary">Add Sale</a>
            <a href="{{ route('sales.report') }}" class="btn btn-secondary">Generate Report</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Penjualan</th>
                            <th>Customer</th>
                            <th>Jumlah Barang</th>
                            <th>Total Harga</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->tanggal_penjualan }}</td>
                            <td>{{ $sale->customer->name }}</td>
                            <td>{{ $sale->jumlah_barang }}</td>
                            <td>{{ $sale->total_harga }}</td>
                            <td>
                                <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
