<div class="p-4">
    <input type="text" wire:model.debounce.500ms="search" 
           class="w-full px-4 py-2 border rounded shadow-md focus:ring focus:ring-blue-300"
           placeholder="Search entries...">

    <div class="overflow-x-auto mt-4">
        <table class="w-full border border-gray-300 text-sm table-auto">
            <thead class="bg-gray-100 text-black">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Date Received</th>
                    <th class="border border-gray-300 px-4 py-2">Branch</th>
                    <th class="border border-gray-300 px-4 py-2">Description</th>
                    <th class="border border-gray-300 px-4 py-2">Quantity</th>
                    <th class="border border-gray-300 px-4 py-2">Amount</th>
                    <th class="border border-gray-300 px-4 py-2">Total</th>
                    <th class="border border-gray-300 px-4 py-2">Date Release</th>
                    <th class="border border-gray-300 px-4 py-2">Received By</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entries as $entry)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $entry->date_received }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $entry->branch }}</td>
                        <td class="border border-gray-300 px-4 py-2 break-words">{{ $entry->description }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $entry->quantity }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($entry->amount, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ number_format($entry->total, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $entry->date_release }}</td>
                        <td class="border border-gray-300 px-4 py-2 break-words">{{ $entry->received_by }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <button onclick="openModal({{ json_encode($entry) }})" class="text-blue-600">Edit</button>
                            <form action="{{ route('entries.destroy', $entry) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $entries->links() }}
    </div>
</div>
