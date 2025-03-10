@extends('layouts/dashboard/main')

@section('container')
<div class="max-w-md mx-auto mt-10 p-5 bg-white shadow-lg rounded-lg border border-gray-200">
    <!-- Logo -->
    <div class="flex justify-center mb-5">
        <img src="{{ asset('image/landing_page/logo.png') }}" alt="Logo" class="w-20 h-20 object-contain">
    </div>

    <!-- Booking Struct -->
    <div class="border-t-4 border-dashed border-gray-400 py-4">
        <h2 class="text-lg font-semibold text-gray-800 text-center">Booking Receipt</h2>
        <div class="mt-4 space-y-2 text-sm text-gray-700">
            <div class="flex justify-between">
                <span class="font-medium">Booking ID:</span>
                <span>{{ $booking->id }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Name:</span>
                <span>{{ $booking->user->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Date Start :</span>
                <span>{{ $booking->start_date }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Date End :</span>
                <span>{{ $booking->end_date }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Days :</span>
                <span>{{ $booking->total_days }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Room :</span>
                <span>{{ $booking->room->room }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Category Room :</span>
                <span>{{ $booking->room->category->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Amount :</span>
                <span>Rp. {{ number_format($booking->price, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Strip Booking -->
    <div class="relative mt-5">
        <div class="h-1 w-full bg-gray-300"></div>
        <div class="absolute -top-3 left-1/4 w-6 h-6 bg-white border border-gray-300 rounded-full"></div>
        <div class="absolute -top-3 right-1/4 w-6 h-6 bg-white border border-gray-300 rounded-full"></div>
    </div>

    <!-- Confirmation Button -->
    
</div>


@endsection 