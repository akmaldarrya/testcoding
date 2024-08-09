<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Customer;

class SaleController extends Controller
{
    public function report(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        $query = Sale::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_penjualan', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        $sales = $query->with('customer')->get();
        $customers = Customer::all();

        return view('sales.report', compact('sales', 'customers'));
    }

    public function index()
    {
        $sales = Sale::with('customer')->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('sales.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal_penjualan' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'jumlah_barang' => 'required|integer',
            'total_harga' => 'required|numeric',
        ]);

        Sale::create($validatedData);

        return redirect()->route('sales.index')->with('success', 'Sale added successfully.');
    }

    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $customers = Customer::all();
        return view('sales.edit', compact('sale', 'customers'));
    }

    public function update(Request $request, Sale $sale)
    {
        $validatedData = $request->validate([
            'tanggal_penjualan' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'jumlah_barang' => 'required|integer',
            'total_harga' => 'required|numeric',
        ]);

        $sale->update($validatedData);

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}
