<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::where('user_id', auth()->id())->latest()->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:6',
            'subscribe' => 'nullable|boolean',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'subscribe' => $request->has('subscribe'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('customers.index')->with('success', 'User added successfully');
    }

    public function edit(Customer $customer)
    {
        abort_if($customer->user_id !== auth()->id(), 403);

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        abort_if($customer->user_id !== auth()->id(), 403);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'password' => 'nullable|string|min:6',
            'subscribe' => 'nullable|boolean',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subscribe' => $request->has('subscribe'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $customer->update($data);

        return redirect()->route('customers.index')->with('success', 'User updated successfully');
    }

    public function destroy(Customer $customer)
    {
        abort_if($customer->user_id !== auth()->id(), 403);

        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'User deleted successfully');
    }
}