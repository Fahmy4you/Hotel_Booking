@extends('layouts/dashboard/main')

@section('container')
<h3 class="text-xl mb-5 font-bold">Welcome {{ auth()->user()->name }}, {{ auth()->user()->role->name }}</h3>    

@can('admin')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
        <div class="flex justify-between mb-6">
            <div>
                <div class="text-2xl font-semibold mb-1">{{ $bookingCount }}</div>
                <div class="text-sm font-medium text-gray-400">Total Orders</div>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
        <div class="flex justify-between mb-4">
            <div>
                <div class="flex items-center mb-1">
                    <div class="text-2xl font-semibold">{{ $userCount }}</div>
                </div>
                <div class="text-sm font-medium text-gray-400">Total Visitors</div>
            </div>
        </div>
    </div>
    
</div>
@endcan

<h3 class="text-xl font-semibold text-gray-800 mb-5">Your Booking's Rooms</h3>
@if (session()->has('succes'))
    <div class="bg-green-300/40 rounded-md mb-3 py-2 px-3">{{session('succes')}}</div>
@endif
<div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:gap-10">
    @foreach ($bookings as $booking)
        <div class="max-w-sm mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Gambar -->
            <img
            class="w-full h-48 object-cover"
            src="{{ asset('storage/image/kamar/'.$booking->room->image) }}"
            alt="Deskripsi Gambar"
            />
        
            <!-- Konten -->
            <div class="p-4">
            <!-- Judul -->
            <h2 class="text-lg font-bold text-gray-800">{{ $booking->room->room }}</h2>
        
            <!-- Kategori -->
            <p class="text-sm text-gray-500 mt-1">{{ $booking->room->category->name }}</p>

            <p class="text-sm text-gray-500 mt-3">Start : {{ $booking->start_date }}</p>
            <p class="text-sm text-gray-500 mt-1">End : {{ $booking->end_date }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $booking->total_days }} Days</p>
        
            <!-- Harga -->
            <p class="text-xl font-semibold text-green-500 mt-2">Rp {{ number_format($booking->price, 0, ',', '.') }}</p>
        
            <!-- Tombol Booking -->
                <form action="{{ route('bookings.destroy', $booking->id) }}" method="post" class="flex gap-x-3 justify-end">
                    @method('delete')
                    @csrf
                    <input type="hidden" name="status" value="cancel">
                    <a href="{{ route('bookings.cetakReservasi', $booking->id)}}" class="text-sm mt-4 bg-blue-500 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Cetak Reservasi</a>
                    <button type="submit" onclick="myconfirm(event, 'Are you sure ?')" class="text-sm mt-4 bg-red-500 text-white font-medium py-2 px-4 rounded-lg hover:bg-red-600 transition duration-200">Batal Booking</button>
              </form>
            </div>
        </div>
    @endforeach
    
</div>

@endsection