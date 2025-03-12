@extends('layouts/home')

@section('container')
<section id="room" class="py-16">
    <div class="mx-auto max-w-7xl px-8 md:px-6">
        <!-- heading text -->
        <div class="mb-5 sm:mb-10 flex items-center justify-between">
            <div class="">
                <span class="font-medium text-blue-500">Our List Room's</span>
                <h1 class="text-2xl font-bold text-slate-700 sm:text-3xl">The rooms in our hotel</h1>
            </div>
            <form action="" method="GET" class="flex gap-x-3">
                <div class="relative flex-grow">
                    <input type="text" name="search" placeholder="Search Room..." class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"/>
                    <i class="ri-search-line absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                  </div>
                  
                  <!-- Select Option for Category -->
                  <select name="category" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="" {{ request()->has('category') && request()->query('category') ? 'selected':'' }}>All Category</option>
                      @foreach ($categories as $category)  
                        @if (request()->query('category') == $category->id)
                          <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                          @else 
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif  
                      @endforeach
                  </select>
                  
                  <!-- Search Button -->
                  <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md flex items-center gap-2 hover:bg-blue-600 transition">
                    <i class="ri-search-line"></i>
                    Cari
                  </button>
            </form>
        </div>
        <!-- wrapper -->
        @if ($rooms->isEmpty())
            <div class="text-center text-xl text-gray-500 mt-5">
               {{ $message ?? 'Tidak ada data kamar tersedia.' }}
            </div>
        @else
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:gap-10">
            @foreach ($rooms as $room)
              <div class="max-w-sm mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                  <!-- Gambar -->
                  <img
                  class="w-full h-48 object-cover"
                  src="{{ asset('storage/image/kamar/'.$room->image) }}"
                  alt="Deskripsi Gambar"
                  />
              
                  <!-- Konten -->
                  <div class="p-4">
                  <!-- Judul -->
                  <h2 class="text-lg font-bold text-gray-800">{{ $room->room }}</h2>
              
                  <!-- Kategori -->
                  <p class="text-sm text-gray-500 mt-1">{{ $room->category->name }}</p>
              
                  <!-- Harga -->
                  <p class="text-xl font-semibold text-green-500 mt-2">Rp {{ number_format($room->price, 0, ',', '.') }}</p>
              
                  <!-- Tombol Booking -->
                  <a href="{{ route('bookings.edit', $room->id) }}" class="flex justify-center mt-4 w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
                      Booking Sekarang
                  </a>
                  </div>
              </div>
            @endforeach
          @endif
        </div>
    </div>
</section>
@endsection