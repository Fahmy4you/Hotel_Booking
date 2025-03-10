@extends('layouts/dashboard/main')

@section('container')
    <!-- Header -->
    <div class="flex justify-between items-center mb-4 mt-5">
      <h1 class="text-2xl font-semibold text-gray-800">Data Booking's Rooms</h1>
    </div>

    @if (session()->has('succes'))
      <div class="bg-green-300/40 rounded-md mb-3 py-2 px-3">{{session('succes')}}</div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto rounded-md w-[90%]">
      <table class="w-full border border-gray-300 text-left">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2 border-b border-gray-300 text-center">No</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">Start</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">End</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">Days</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">User Name</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">Room Name</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">Price</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bookings as $booking)             
          <tr class="hover:bg-gray-100">
            <td class="px-4 py-2 border-b border-gray-300 text-center">{{ $loop->iteration }}</td>
            <td class="px-4 py-2 border-b border-gray-300 text-center">{{ $booking->start_date }}</td>
            <td class="px-4 py-2 border-b border-gray-300 text-center">{{ $booking->end_date }}</td>
            <td class="px-4 py-2 border-b border-gray-300 text-center">{{ $booking->total_days }} Days</td>
            <td class="px-4 py-2 border-b border-gray-300 text-center">{{ $booking->user->name }}</td>
            <td class="px-4 py-2 border-b border-gray-300 text-center">
              <a href="{{ route('bookings.edit', $booking->room_id )}}" class="text-blue-600">
                {{ $booking->room->room }}
              </a>
            
            </td>
            <td class="px-4 py-2 border-b border-gray-300 text-center">Rp. {{ number_format($booking->price, 0, ',', '.') }}</td>
            <td class="px-4 py-2 border-b border-gray-300">
              <form action="{{ route('bookings.destroy', $booking->id) }}" method="post">
                @method('delete')
                @csrf
                <input type="hidden" name="status" value="cancel admin">
                <a href="{{ route('bookings.cetakReservasi', $booking->id)}}" class="text-blue-500 ml-2">Cetak Reservasi</a>
                <button type="submit" onclick="myconfirm(event, 'Are you sure ?')" class="text-red-500 ml-2">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

@endsection