@extends('layouts.app')
@section('title', 'Edit User')

@section('content')
<div class="max-w-lg mx-auto bg-white rounded-xl shadow-md p-6">
    <a href="{{ route('customers.index') }}"
       class="inline-block bg-slate-500 hover:bg-slate-600 text-white text-sm px-3 py-1.5 rounded-md mb-4">← Back</a>

    <h1 class="text-2xl font-bold text-slate-800 mb-6">Edit User</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $customer->name) }}"
                   class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Email address</label>
            <input type="email" name="email" value="{{ old('email', $customer->email) }}"
                   class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
            <input type="password" name="password" placeholder="Password"
                   class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            <p class="text-xs text-slate-400 mt-1">Leave blank to keep current password</p>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="subscribe" id="subscribe" {{ $customer->subscribe ? 'checked' : '' }} class="w-4 h-4">
            <label for="subscribe" class="text-sm text-slate-600">Check me out</label>
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-lg transition">
            Update
        </button>
    </form>
</div>
@endsection