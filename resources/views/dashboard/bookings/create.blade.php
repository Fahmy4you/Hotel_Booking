@extends('layouts/dashboard/main')

@section('container')

<div class="flex justify-center items-center py-10 flex-col">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Booking Room {{ $room->room }}</h1>
    <div class="w-[80%] mb-8 mx-auto bg-white rounded-lg shadow-md overflow-hidden">
      <!-- Gambar -->
      <img
        class="w-full h-48 object-cover"
        src="{{ asset('storage/image/kamar/'. $room->image) }}"
        alt="Deskripsi Gambar"
      />
    
      <!-- Konten -->
      <div class="p-4">
        <!-- Judul -->
        <h2 class="text-lg font-bold text-gray-800">{{ $room->room }}</h2>
    
        <!-- Kategori -->
        <p class="text-sm text-gray-500 mt-1">{{ $room->category->name }} ({{ $room->category->class_category }})</p>

        {{-- Fasilitas --}}
        <h6 class="mt-4 text-md font-bold">Features In Room</h6>
        @foreach($room->category->fasilitas as $fasilitas)
          <p class="text-sm font-semibold text-gray-500 mt-1">{{ $fasilitas->feature }} : {{ $fasilitas->information }}</p>

        @endforeach
    
        <!-- Harga -->
        <p class="mt-5 text-xl font-semibold text-green-500">Rp. {{ number_format($room->price, 0, ',', '.') }}</p>
      </div>
    </div>


    @if (session()->has('succes'))
      <div class="bg-green-300/40 rounded-md mb-3 py-2 px-3">{{session('succes')}}</div>
    @endif

    <form action="{{ route('bookings.update', $room->id) }}" method="POST" class="w-[80%]">
      @method('put')
      @csrf
      <!-- Input Nama -->
     
      <div class="mb-4">
        <label for="start_date" class="block mb-1 text-gray-700 font-medium">Start Date</label>
        <input type="date" id="start_date" name="start_date" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="Start Date..." value="{{ old('start_date') }}"/>
        @error('start_date')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
      </div>
      <div class="mb-4">
        <label for="end_date" class="block mb-1 text-gray-700 font-medium">End Date</label>
        <input type="date" id="end_date" name="end_date" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="End Date..." value="{{ old('end_date') }}"/>
        @error('end_date')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
      </div>

      <!-- Tombol Submit -->
      <button type="submit" id="buttonBooking" class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">
        Booking Room <span id="harga">Rp. -</span>
      </button>
    </form>

    <h3 class="text-xl font-bold text-gray-800 mt-16 mb-5">Data of the Person Who Booked the Room</h3>
    <div class="overflow-x-auto rounded-md w-[80%]">
      <table class="w-full border border-gray-300 text-left">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2 border-b border-gray-300 text-center">No</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">Start</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">End</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">Days</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">User Name</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">Price</th>
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
            <td class="px-4 py-2 border-b border-gray-300 text-center">Rp. {{ number_format($booking->price, 0, ',', '.') }}</td>
            {{-- <td class="px-4 py-2 border-b border-gray-300 text-center">Rp.{{ number_format($room->price, 0, ',', '.') }}</td> --}}
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const start_date = document.querySelector("#start_date");
      const end_date = document.querySelector("#end_date");
      const buttonBooking = document.querySelector('#buttonBooking');
      const textPrice = document.querySelector('#harga');

      // Tunggu tanggal start_date dan end_date benar jika belum hilangkan button nya dulu
      buttonBooking.style.display = "none";
      
      // Set minimal start_date ke hari ini
      const today = new Date().toISOString().split("T")[0];
      start_date.setAttribute("min", today);

      const getPrice = (startVal, endVal) => {
        fetch( "{{ route('getprice') }}", {
          method: 'POST', // Metode HTTP
          headers: {
              'Content-Type': 'application/json', // Jenis konten yang dikirim
          },
          body: JSON.stringify({
            "_token": "{{ csrf_token() }}",
            "startDate": startVal,
            "endDate" : endVal,
            "roomId": {{ $room->id }}
          })
        })
        .then(response => {
          if (response.status === 419) {
              alert('Session expired. Please refresh the page.');
              location.reload(); // Reload halaman jika token kadaluarsa
          }

          return response.json(); // Konversi response ke JSON
        }) 
        .then(data => {
            data = data.toLocaleString('id-ID'); // Format ke Rupiah
            textPrice.innerText = "Rp. " + data;
            buttonBooking.style.display = "block";
        })
        .catch(error => {
            console.error('Error:', error);
        });

      }
      
      start_date.addEventListener("change", function () {
        // Tunggu tanggal start_date dan end_date benar jika belum hilangkan button nya dulu
        buttonBooking.style.display = "none";

        // cek apakah start_date nya kosong dan end_date nya kosong, serta start_date nya tidak kurang dari hari ini dan juga start date tidak boleh lebih dari end date
        if(start_date.value != "" && end_date.value != "" && (start_date.value >= today) && (start_date.value < end_date.value)) {
          getPrice(start_date.value, end_date.value);
        }
        
        
      });
      
      end_date.addEventListener("change", function () {
        // Tunggu tanggal start_date dan end_date benar jika belum hilangkan button nya dulu
        buttonBooking.style.display = "none";

        // cek apakah start_date nya kosong dan end_date nya kosong, serta start_date nya tidak kurang dari hari ini dan juga start date tidak boleh lebih dari end date
        if(start_date.value != "" && end_date.value != "" && (start_date.value >= today) && (start_date.value < end_date.value)) {
          getPrice(start_date.value, end_date.value);
        }
      });
    });


  </script>
@endsection