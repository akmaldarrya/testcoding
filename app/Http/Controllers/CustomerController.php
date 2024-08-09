<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource with optional search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    // app/Http/Controllers/CustomerController.php
    public function index(Request $request)
    {
        $query = $request->input('search');
        $location = $request->input('location');
        $category = $request->input('category');
    
        $customers = Customer::when($query, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($location, function($query, $location) {
                return $query->where('location', $location);
            })
            ->when($category, function($query, $category) {
                return $query->where('category', $category);
            })
            ->paginate(10);
    
        // Get distinct locations and categories for dropdown options
        $locations = Customer::pluck('location')->unique()->filter()->values();
        $categories = Customer::pluck('category')->unique()->filter()->values();
    
        return view('customers.index', compact('customers', 'locations', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:customers',
                'phone' => 'required|string|max:20',
                'address' => 'nullable|string',
                'location' => 'nullable|string',
                'category' => 'nullable|string',
            ]);

            Customer::create($validatedData);

            return redirect()->route('customers.index')->with('success', 'Customer added successfully.');
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\View\View
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\View\View
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\RedirectResponse
     */
        public function update(Request $request, Customer $customer)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:customers,email,' . $customer->id,
                'phone' => 'required|string|max:20',
                'address' => 'nullable|string',
                'location' => 'nullable|string',
                'category' => 'nullable|string',
            ]);

            $customer->update($validatedData);

            return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Customer $customer)
    {
        // Delete the customer record
        $customer->delete();

        // Redirect to the customers index with a success message
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
