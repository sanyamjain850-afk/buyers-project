@extends('layouts.app')
@section('title', 'Customers List')

@section('content')
<div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">Customers</h1>
        <a href="{{ route('customers.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
           + Add User
        </a>
    </div>

    {{-- Mobile card view (below sm breakpoint) --}}
    <div class="sm:hidden space-y-3">
        @forelse ($customers as $customer)
        <div class="border border-slate-200 rounded-lg p-4">
            <p class="font-semibold text-slate-800">{{ $customer->name }}</p>
            <p class="text-sm text-slate-500 mb-3 break-all">{{ $customer->email }}</p>
            <div class="flex gap-2">
                <a href="{{ route('customers.edit', $customer->id) }}"
                   class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-2 rounded-md">Edit</a>

                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure?');" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-2 rounded-md">Delete</button>
                </form>
            </div>
        </div>
        @empty
        <p class="py-6 text-center text-slate-400">No users yet.</p>
        @endforelse
    </div>

    {{-- Table view (sm and above) --}}
    <div class="hidden sm:block overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-200 text-slate-600 text-sm uppercase">
                    <th class="py-3 pr-3">Name</th>
                    <th class="py-3 pr-3">Email</th>
                    <th class="py-3 pr-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                <tr class="border-b border-slate-100 hover:bg-slate-50">
                    <td class="py-3 pr-3">{{ $customer->name }}</td>
                    <td class="py-3 pr-3 text-slate-600">{{ $customer->email }}</td>
                    <td class="py-3 pr-3">
                        <div class="flex gap-2">
                            <a href="{{ route('customers.edit', $customer->id) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5 rounded-md">Edit</a>

                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5 rounded-md">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="py-6 text-center text-slate-400">No users yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection