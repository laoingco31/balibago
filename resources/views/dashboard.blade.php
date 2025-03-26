@extends('layouts.app')

@section('header')
@endsection

@section('content')
{{-- Real-Time Clock --}}
<div class="text-center text-lg font-semibold text-red-700 mt-2"
     x-data="{ time: '' }"
     x-init="setInterval(() => {
         let now = new Date();
         let hours = now.getHours();
         let minutes = now.getMinutes();
         let seconds = now.getSeconds();
         let ampm = hours >= 12 ? 'PM' : 'AM';
         hours = hours % 12 || 12;
         minutes = minutes < 10 ? '0' + minutes : minutes;
         seconds = seconds < 10 ? '0' + seconds : seconds;
         time = `${hours}:${minutes}:${seconds} ${ampm}`;
     }, 1000)">
    ⏰ <span x-text="time" class="font-bold text-blue-600"></span>
</div>

<div class="animate-fade-in p-4">
    <div class="max-w-7xl mx-auto">
        <p class="text-black text-lg font-medium text-center sm:text-left">Welcome to your dashboard!</p>

        {{-- Display Pending Entries --}}
        <h3 class="text-xl font-semibold text-yellow-600 mt-4 text-center sm:text-left">Pending Entries</h3>

        @if($pendingEntries->isEmpty())
            <p class="text-gray-500 mt-2 text-center sm:text-left">No pending entries.</p>
        @else
            <div class="overflow-x-auto mt-4 bg-white shadow-md rounded-lg">
                <table class="w-full min-w-max border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-black text-sm sm:text-base">
                            <th class="border p-3">Date Received</th>
                            <th class="border p-3">Branch</th>
                            <th class="border p-3">Description</th>
                            <th class="border p-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingEntries as $entry)
                            <tr class="bg-gray-100 text-black transition-all duration-300 hover:bg-yellow-200 text-xs sm:text-sm">
                                <td class="border p-3 whitespace-nowrap">{{ $entry->date_received }}</td>
                                <td class="border p-3">{{ $entry->branch }}</td>
                                <td class="border p-3">{{ $entry->description }}</td>
                                <td class="border p-3 text-yellow-600 font-bold">Pending</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection
