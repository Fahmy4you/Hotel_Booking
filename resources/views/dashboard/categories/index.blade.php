@extends('layouts/dashboard/main')

@section('container')
    <!-- Header -->
    <div class="flex justify-between items-center mb-4 mt-5">
      <h1 class="text-2xl font-semibold text-gray-800">Data Category Rooms</h1>
      <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
        Create Data
      </a>
    </div>

    @if (session()->has('succes'))
      <div class="bg-green-300/40 rounded-md mb-3 py-2 px-3">{{session('succes')}}</div>
    @endif
    
    @if (session()->has('error'))
      <div class="bg-red-400/40 rounded-md mb-3 py-2 px-3">{{session('error')}}</div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto rounded-md">
      <table class="w-full border border-gray-300 text-left">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2 border-b border-gray-300 text-center">No</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">Category Room</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">Category Class</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">Rooms</th>
            <th class="px-4 py-2 border-b border-gray-300 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
          <tr class="hover:bg-gray-100">
            <td class="px-4 py-2 border-b border-gray-300 text-center">{{ $loop->iteration }}</td>
            <td class="px-4 py-2 border-b border-gray-300 text-center">{{ $category->name }}</td>
            <td class="px-4 py-2 border-b border-gray-300 text-center">{{ $category->class_category }}</td>
            <td class="px-4 py-2 border-b border-gray-300 text-center">{{ $category->room->count() }}</td>
            <td class="px-4 py-2 border-b border-gray-300 justify-center flex">
              <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500">Edit</a>
              <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" onclick="myconfirm(event, 'Are you sure ?')" class="text-red-500 ml-2">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

@endsection