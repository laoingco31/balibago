@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Entry</h1>

    <div>
        <form action="{{ route('entries.update', $entry) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">Date Received:</label>
                    <input type="date" name="date_received" class="form-control" value="{{ $entry->date_received }}" required>
                </div>
                <div>
                    <label class="block font-semibold">Branch:</label>
                    <input type="text" name="branch" class="form-control" value="{{ $entry->branch }}" required>
                </div>
                <div class="col-span-2">
                    <label class="block font-semibold">Description:</label>
                    <textarea name="description" class="form-control" required>{{ $entry->description }}</textarea>
                </div>
                <div>
                    <label class="block font-semibold">Quantity:</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $entry->quantity }}" required>
                </div>
                <div>
                    <label class="block font-semibold">Amount:</label>
                    <input type="number" step="0.01" name="amount" class="form-control" value="{{ $entry->amount }}" required>
                </div>
                <div>
                    <label class="block font-semibold">Total:</label>
                    <input type="number" step="0.01" name="total" class="form-control" value="{{ $entry->total }}" required>
                </div>
                <div>
                    <label class="block font-semibold">Date Release:</label>
                    <input type="date" name="date_release" class="form-control" value="{{ $entry->date_release }}">
                </div>
                <div>
                    <label class="block font-semibold">Received By:</label>
                    <input type="text" name="received_by" class="form-control" value="{{ $entry->received_by }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Update Entry</button>
        </form>
    </div>
</div>
@endsection