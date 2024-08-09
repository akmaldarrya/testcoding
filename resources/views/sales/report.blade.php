@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Laporan Penjualan</h1>
    <p class="mb-4">Laporan penjualan berdasarkan periode waktu dan customer tertentu.</p>

    <form action="{{ route('sales.report') }}" method="GET">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="end_date">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="customer_id">Customer</label>
                        <select id="customer_id" name="customer_id" class="form-control">
                            <option value="">Semua Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Generate Report</button>
            </div>
        </div>
    </form>

    @if(isset($sales))
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Penjualan</th>
                            <th>Customer</th>
                            <th>Jumlah Barang</th>
                            <th>Total Harga</th>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
