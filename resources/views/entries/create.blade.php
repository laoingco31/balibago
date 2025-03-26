@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Add New Entry</h1>

    <div class="">
        <form action="{{ route('entries.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                
                {{-- Date Received --}}
                <div>
                    <label class="block text-gray-700 font-semibold">Date Received:</label>
                    <input type="date" name="date_received" 
                        class="w-full bg-white text-black border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300" 
                        required>
                    @error('date_received')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Branch --}}
                <div>
                    <label class="block text-gray-700 font-semibold">Branch:</label>
                    <input type="text" name="branch" 
                        class="w-full bg-white text-black border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300" 
                        required>
                    @error('branch')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="col-span-full">
                    <label class="block text-gray-700 font-semibold">Description:</label>
                    <textarea name="description" 
                        class="w-full bg-white text-black border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300" 
                        required></textarea>
                    @error('description')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Quantity --}}
                <div>
                    <label class="block text-gray-700 font-semibold">Quantity:</label>
                    <input type="number" name="quantity" 
                        class="w-full bg-white text-black border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300" 
                        required>
                    @error('quantity')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Amount --}}
                <div>
                    <label class="block text-gray-700 font-semibold">Amount:</label>
                    <input type="number" step="0.01" name="amount" 
                        class="w-full bg-white text-black border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300" 
                        required>
                    @error('amount')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Total --}}
                <div>
                    <label class="block text-gray-700 font-semibold">Total:</label>
                    <input type="number" step="0.01" name="total" 
                        class="w-full bg-white text-black border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300" 
                        required>
                    @error('total')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Date Release --}}
                <div>
                    <label class="block text-gray-700 font-semibold">Date Release:</label>
                    <input type="date" name="date_release" 
                        class="w-full bg-white text-black border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300">
                    @error('date_release')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Received By --}}
                <div class="col-span-full">
                    <label class="block text-gray-700 font-semibold">Received By:</label>
                    <input type="text" name="received_by" value="Pending" readonly
                        class="w-full bg-gray-200 text-black border border-gray-300 rounded-md p-2 focus:ring focus:ring-blue-300">
                    @error('received_by')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Buttons --}}
            <div class="mt-6 flex gap-2">
                <button type="submit" 
                    class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                    Save Entry
                </button>
                <a href="{{ route('entries.index') }}" 
                    class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
