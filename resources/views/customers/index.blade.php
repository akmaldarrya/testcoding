<!-- resources/views/customers/index.blade.php -->
@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Customers</h1>
    <p class="mb-4">Daftar customer yang terdaftar di sistem.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="{{ route('customers.index') }}" method="GET">
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" name="search" placeholder="Search by name or email" value="{{ request()->input('search') }}">
                    </div>
                    <div class="col">
                        <select name="location" class="form-control">
                            <option value="">All Locations</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc }}" {{ request()->input('location') == $loc ? 'selected' : '' }}>
                                    {{ $loc }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select name="category" class="form-control">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request()->input('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary mt-4" type="submit">Filter</button>
                    </div>
                </div>
            </form>
            <a href="{{ route('customers.create') }}" class="btn btn-primary mt-2">Add Customer</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Location</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->location }}</td>
                            <td>{{ $customer->category }}</td>
                            <td>
                                <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No customers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
