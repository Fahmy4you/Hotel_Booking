@extends('layouts/dashboard/main')

@section('container')

<h1 class="text-2xl font-bold text-gray-800 mb-4">Update My Profile</h1>
    <form action="{{ route('myprofilepost') }}" method="POST" class="w-[90%]" enctype="multipart/form-data">
        @method('put')
        @csrf

      <input type="hidden" name="hapusProfile" id="hapusProfile" value="false">
      <!-- Input Nama -->
      <div class="mb-4">
        <label for="name" class="block mb-1 text-gray-700 font-medium">Name User</label>
        <input type="text" id="name" name="name" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder=" Name..." value="{{ old('name', $user->name) }}"/>
        @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="email" class="mt-5 mb-1 block text-gray-700 font-medium">Email</label>
        <input type="email" id="email" name="email" class="w-full outline-none transition duration-300 outline-[1px] mt-2 p-2 border-gray-300 rounded-md shadow-sm focus:outline-blue-500 focus:ouline-blue-500" placeholder="Email..." value="{{ old('email', $user->email) }}"/>
        @error('email')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="fileInput" class="mt-5 mb-1 block text-gray-700 font-medium">Profile</label>
        <input type="file" id="fileInput" name="profile" class="p-2 mx-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring focus:ring-blue-300" value="{{ old('profile', $user->profile) }}">
    
        @error('profile')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <!-- Preview Image -->
        <div class="preview-container mt-2" id="previewContainer">
          <img id="previewImage" class="w-[200px] h-[200px] shadow-xl rounded-md" src="{{ asset('storage/image/profile/'.$user->profile) }}" default-image="{{ asset('storage/image/profile/default.jpg') }}" alt="Preview Gambar" mode="edit" path>
      </div>
      <button class="hapusProfile mt-2 py-2 px-3 border-none bg-red-400 rounded-md text-white font-semibold">Delete Profile</button>
      </div>

      <!-- Tombol Submit -->
      <button type="submit" class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">
        Edit Data
      </button>
    </form>
@endsection