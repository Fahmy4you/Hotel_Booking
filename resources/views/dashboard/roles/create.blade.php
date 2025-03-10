@extends('layouts/dashboard/main')

@section('container')

<h1 class="text-2xl font-bold text-gray-800 mb-4">Create Data Category Rooms</h1>
    <form action="{{ route('roles.store') }}" method="POST" class="w-[90%]">
        @csrf
      <!-- Input Nama -->
      <div class="mb-4">
        <label for="name" class="block mb-1 text-gray-700 font-medium">Name Role</label>
        <input type="text" id="name" name="name" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="Role name..." value="{{ old('name') }}"/>
        @error('name')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Tombol Submit -->
      <button type="submit" class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">
        Add Data
      </button>
    </form>
@endsection