@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-3">
        <a href="{{ route('entries.create') }}" class="bg-blue-500 text-white px-3 py-1 rounded">+ Add New Entry</a>
    </div>

    <h1 class="text-lg font-semibold mb-3">Entries List</h1>
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 text-sm">
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
                    <th class="border border-gray-300 px-4 py-2 no-print">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entries as $entry)
                <tr id="entry-{{ $entry->id }}" class="text-center">
                    <td class="border border-gray-300 px-4 py-2">{{ $entry->date_received }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $entry->branch }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $entry->description }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $entry->quantity }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ number_format($entry->amount, 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ number_format($entry->total, 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $entry->date_release }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $entry->received_by }}</td>
                    <td class="border border-gray-300 px-4 py-2 space-x-1 no-print">
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
</div>



<!-- Printable Business Form -->
<div id="printForm" class="hidden p-6 border border-gray-300 w-96 mx-auto bg-white text-black">
    <div class="text-center mb-4">
        <h2 class="text-xl font-bold">Company Name</h2>
        <p class="text-sm">Company Address | Contact Info</p>
        <hr class="my-2 border-gray-400">
        <h3 class="text-lg font-semibold">Entry Details</h3>
    </div>
    <div class="text-sm">
        <p><strong>Date Received:</strong> <span id="print_date_received"></span></p>
        <p><strong>Branch:</strong> <span id="print_branch"></span></p>
        <p><strong>Description:</strong> <span id="print_description"></span></p>
        <p><strong>Quantity:</strong> <span id="print_quantity"></span></p>
        <p><strong>Amount:</strong> <span id="print_amount"></span></p>
        <p><strong>Total:</strong> <span id="print_total"></span></p>
        <p><strong>Date Release:</strong> <span id="print_date_release"></span></p>
        <p><strong>Received By:</strong> <span id="print_received_by"></span></p>
    </div>
    <div class="mt-6 text-center">
        <p class="text-sm">Authorized Signature: ______________________</p>
    </div>
</div>

<script>
  function printEntry(entryId) {
    let entry = document.getElementById('entry-' + entryId);
    
    document.getElementById('print_date_received').innerText = entry.children[0].innerText;
    document.getElementById('print_branch').innerText = entry.children[1].innerText;
    document.getElementById('print_description').innerText = entry.children[2].innerText;
    document.getElementById('print_quantity').innerText = entry.children[3].innerText;
    document.getElementById('print_amount').innerText = entry.children[4].innerText;
    document.getElementById('print_total').innerText = entry.children[5].innerText;
    document.getElementById('print_date_release').innerText = entry.children[6].innerText;
    document.getElementById('print_received_by').innerText = entry.children[7].innerText;

    let printForm = document.getElementById('printForm');
    printForm.classList.remove('hidden');

    setTimeout(() => {
        window.print();
        printForm.classList.add('hidden');
    }, 200);
}
</script>






<!-- Modal -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity duration-300">
    <div id="editModalContent" class="bg-white p-6 rounded-lg shadow-lg w-80 transform scale-95 opacity-0 transition-all duration-300 border border-gray-200">
        
        <!-- Modal Header -->
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Update Entry</h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-red-500 transition">✖</button>
        </div>

        <!-- Modal Form -->
        <form id="editForm" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" id="entry_id" name="entry_id">

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Date Release</label>
                <input type="date" id="date_release" name="date_release" class="w-full p-2 border rounded text-black font-bold bg-white focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Received By</label>
                <input type="text" id="received_by" name="received_by" class="w-full p-2 border rounded text-black font-bold bg-white focus:ring-2 focus:ring-blue-400 focus:outline-none transition">
            </div>

            <div class="flex justify-end gap-2 mt-4">
            <button type="button" onclick="closeModal()" 
    class="px-4 py-2 bg-red-600 text-black font-semibold text-lg rounded shadow-md hover:bg-red-700 hover:shadow-lg transition-all duration-200 ease-in-out">
    Cancel
</button>

<button type="submit" 
    class="px-4 py-2 bg-blue-600 text-black font-semibold text-lg rounded shadow-md hover:bg-blue-700 hover:shadow-lg transition-all duration-200 ease-in-out">
    Save
</button>

            </div>
        </form>
    </div>
</div>

<script>
    function openModal(entry) {
        document.getElementById('date_release').value = entry.date_release;
        document.getElementById('received_by').value = entry.received_by;
        document.getElementById('entry_id').value = entry.id;

        let editForm = document.getElementById('editForm');
        editForm.action = "/entries/" + entry.id; // Fix the form action

        let modal = document.getElementById('editModal');
        let modalContent = document.getElementById('editModalContent');

        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeModal() {
        let modal = document.getElementById('editModal');
        let modalContent = document.getElementById('editModalContent');

        modalContent.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => {
            modal.classList.remove('opacity-100');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }, 100);
    }
</script>
@endsection
