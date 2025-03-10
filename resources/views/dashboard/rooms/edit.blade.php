@extends('layouts/dashboard/main')

@section('container')

<h1 class="text-2xl font-bold text-gray-800 mb-4">Edit Data Rooms</h1>
    <form action="{{ route('rooms.update', $room->id) }}" method="POST" class="w-[90%]" enctype="multipart/form-data">
        @method('put')
        @csrf
      <!-- Input Nama -->
      <div class="mb-4">
        <label for="room" class="block mb-1 text-gray-700 font-medium">Name Room</label>
        <input type="text" id="room" name="room" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="Room name..." value="{{ old('room', $room->room) }}"/>
        @error('room')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="price" class="mt-5 mb-1 block text-gray-700 font-medium">Price</label>
        <input type="number" id="price" name="price" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="Price..." value="{{ old('price', $room->price) }}"/>
        @error('price')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="category_id" class="mt-5 mb-1 block text-gray-700 font-medium">Category Room</label>
        <select name="category_id" id="category_id" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none w-full">
          @foreach ($categories as $category)  
            @if (old('category_id', $room->category->id) == $category->id) {}
              <option selected value="{{ $category->id }}">{{ $category->name }}</option>
              @else 
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif  
          @endforeach   
        </select>
        @error('category')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="fileInput" class="mt-5 mb-1 block text-gray-700 font-medium">Thumbnail Room</label>
        <input type="file" id="fileInput" name="image" class="p-2 mx-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring focus:ring-blue-300" value="{{ old('image') }}">
    
        @error('image')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <!-- Preview Image -->
        <div class="mt-4">
            <p class="text-sm text-gray-500 hidden" id="previewText">No image selected.</p>
            <img id="previewImage" src="{{ asset('storage/image/kamar/' . $room->image) }}" alt="Image Preview"
                class="w-full max-h-64 object-cover rounded-lg border border-gray-200" mode="edit">
        </div>
      </div>

      <!-- Tombol Submit -->
      <button type="submit" class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">
        Edit Data
      </button>
    </form>
@endsection